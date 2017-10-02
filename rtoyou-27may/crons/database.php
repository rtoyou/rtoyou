<?php
/**
 * Created by PhpStorm.
 * User: prashant
 * Date: 2/10/16
 * Time: 4:51 PM
 */
/**
 * CDatabase core class file
 *
 * @project ApPHP Framework
 * @author ApPHP <info@apphp.com>
 * @link http://www.apphpframework.com/
 * @copyright Copyright (c) 2012 - 2013 ApPHP Framework
 * @license http://www.apphpframework.com/license/
 *
 * IMPORTANT:
 * -----------
 * PDO::exec() should be used for queries that do not return a resultset, such as a delete statement or 'set'.
 * PDO::query() should be used when you expect a resultset to be returned.
 *
 * PUBLIC:					PROTECTED:					PRIVATE:
 * ----------               ----------                  ----------
 * __construct                                          _errorLog
 * cacheOn                                              _interpolateQuery
 * cacheOff                                             _prepareParams
 * select                                               _enableCache
 * insert
 * update
 * delete
 * lastId
 * customQuery
 * customExec
 * showTables
 * showColumns
 * getVersion
 *
 * STATIC:
 * ---------------------------------------------------------------
 * init                                                 _fatalErrorPageContent
 * getError
 * getErrorMessage
 *
 */

class CDatabase extends PDO
{

    /** @var object */
    private static $_instance;
    /** @var string */
    private $_dbPrefix;
    /** @var string */
    private $_dbDriver;
    /** @var string */
    private $_dbName;
    /** @var bool */
    private $_cache;
    /** @var int */
    private $_cacheLifetime;
    /** @var string */
    private $_cacheDir;
    /**	@var boolean */
    private static $_error;
    /**	@var string */
    private static $_errorMessage;
    /** @var string */
    public static $count = 0;

    /**
     * Class default constructor
     * @param array $params
     */
    public function __construct($params = array())
    {
        // for direct use (e.g. setup module)
        if(!empty($params)){
            $dbDriver = isset($params['dbDriver']) ? $params['dbDriver'] : '';
            $dbHost = isset($params['dbHost']) ? $params['dbHost'] : '';
            $dbName = isset($params['dbName']) ? $params['dbName'] : '';
            $dbUser = isset($params['dbUser']) ? $params['dbUser'] : '';
            $dbPassword = isset($params['dbPassword']) ? $params['dbPassword'] : '';
            $dbCharset = isset($params['dbCharset']) ? $params['dbCharset'] : 'utf8';


            try{
                @parent::__construct($dbDriver.':host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \''.$dbCharset.'\''));
                $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(Exception $e){
		var_dump($e);die;
                self::$_error = true;
                self::$_errorMessage = $e->getMessage();
            }
            $this->_dbDriver = $dbDriver;
            $this->_dbName = $dbName;
            $this->_dbPrefix = '';
        }
    }

    /**
     * Initializes the database class
     * @param array $params
     */
    public static function init($params = array())
    {
        if(self::$_instance == null) self::$_instance = new self($params);
        return self::$_instance;
    }

    /**
     * Performs select query
     * @param string $sql SQL string
     * @param array $array parameters to bind
     * @param constant $fetchMode PDO fetch mode
     * @param string $cacheId cache identificator
     * @return mixed - an array containing all of the result set rows
     * Ex.: Array([0] => Array([id] => 11, [name] => John), ...)
     */
    public function select($sql, $params = array(), $fetchMode = PDO::FETCH_ASSOC, $cacheId = '')
    {
        $sth = $this->prepare($sql);
        $cacheContent = '';
        $error = false;

        try{
            if($this->_cache){
                $param = !empty($cacheId) ? $cacheId : (is_array($params) ? implode('|',$params) : '');
                $cacheContent = CCache::getContent(
                    $this->_cacheDir.md5($sql.$param).'.cch',
                    $this->_cacheLifetime
                );
            }

            if(!$cacheContent){
                if(is_array($params)){
                    foreach($params as $key => $value){
                        list($key, $param) = $this->_prepareParams($key);
                        $sth->bindValue($key, $value, $param);
                    }
                }
                $sth->execute();
                $result = $sth->fetchAll($fetchMode);

               // if($this->_cache) CCache::setContent($result, $this->_cacheDir);
            }else{
                $result = $cacheContent;
            }
        }catch(PDOException $e){
var_dump($e);
            $this->_errorLog('select [database.php, ln.:'.$e->getLine().']', $e->getMessage().' => '.$this->_interpolateQuery($sql, $params));
            $result = false;
            $error = true;
        }catch(Exception $e){
var_dump($e);}

       // CDebug::AddMessage('queries', ++self::$count.'. select | <i>'.A::t('core', 'total').': '.(($result) ? count($result) : '0 (<b>'.($error ? 'error' : 'empty').'</b>)').'</i>', $sql);
        return 
	$result;
    }

    /**
     * Performs insert query
     * @param string $table name of the table to insert into
     * @param array $data associative array
     * @return boolean
     */
    public function insert($table, $data)
    {

        ksort($data);

        $fieldNames = implode('`, `', array_keys($data));
        $fieldValues = ':'.implode(', :', array_keys($data));

        $sql = 'INSERT INTO `'.$this->_dbPrefix.$table.'` (`'.$fieldNames.'`) VALUES ('.$fieldValues.')';
        $sth = $this->prepare($sql);

        if(is_array($data)){
            foreach($data as $key => $value){
                list($key, $param) = $this->_prepareParams($key);
                $sth->bindValue(':'.$key, $value, $param);
            }
        }

        try{
            $sth->execute();
            $result = $this->lastInsertId();
        }catch(PDOException $e){
            var_dump($e);die;
            $this->_errorLog('insert [database.php, ln.:'.$e->getLine().']', $e->getMessage().' => '.$this->_interpolateQuery($sql, $data));
            $result = false;
        }

        return $result;
    }

    /**
     * Performs update query
     * @param string $table name of table to update
     * @param string $data an associative array
     * @param string $where the WHERE clause of query
     * @param array $params
     * @param boolean
     */
    public function update($table, $data, $where = '1', $params = array())
    {
        ksort($data);

        $fieldDetails = NULL;
        if(is_array($data)){
            foreach($data as $key => $value){
                $fieldDetails .= '`'.$key.'` = :'.$key.',';
            }
        }
        $fieldDetails = rtrim($fieldDetails, ',');
        $sql = 'UPDATE `'.$this->_dbPrefix.$table.'` SET '.$fieldDetails.' WHERE '.$where;

        $sth = $this->prepare($sql);
        if(is_array($data)){
            foreach($data as $key => $value){
                list($key, $param) = $this->_prepareParams($key);
                $sth->bindValue(':'.$key, $value, $param);
            }
        }
        if(is_array($params)){
            foreach($params as $key => $value){
                list($key, $param) = $this->_prepareParams($key);
                $sth->bindValue($key, $value, $param);
            }
        }

        try{
            $sth->execute();
            // $result = $sth->rowCount();
            $result = true;
        }catch(PDOException $e){
	var_dump($e);
            // Get trace from parent level
            // $trace = $e->getTrace();
            // echo '<pre>';
            // echo $trace[1]['file'];
            // echo $trace[1]['line'];
            // echo '</pre>';
            $this->_errorLog('update [database.php, ln.:'.$e->getLine().']', $e->getMessage().' => '.$this->_interpolateQuery($sql, $data));
            $result = false;
        }

        return $result;
    }

    /**
     * Performs delete query
     * @param string $table
     * @param string $where the WHERE clause of query
     * @param array $params
     * @return integer affected rows
     */
    public function delete($table, $where = '', $params = array())
    {

        $where_clause = (!empty($where) && !preg_match('/\bwhere\b/i', $where)) ? ' WHERE '.$where : $where;
        $sql = 'DELETE FROM `'.$this->_dbPrefix.$table.'` '.$where_clause;

        $sth = $this->prepare($sql);
        if(is_array($params)){
            foreach($params as $key => $value){
                list($key, $param) = $this->_prepareParams($key);
                $sth->bindValue($key, $value, $param);
            }
        }

        try{
            $sth->execute();
            $result = $sth->rowCount();
        }catch(PDOException $e){
            $this->_errorLog('delete [database.php, ln.:'.$e->getLine().']', $e->getMessage().' => '.$this->_interpolateQuery($sql, $params));
            $result = false;
        }

        return $result;
    }

    /**
     * Returns ID of the last inserted record
     * @return int
     */
    public function lastId()
    {
        return (!empty($this)) ? $this->lastInsertId() : 0;
    }

    /**
     * Performs a standard query
     * @param string $sql
     * @param array $params
     * @param constant $fetchMode PDO fetch mode
     * @return mixed - an array containing all of the result set rows
     */
    public function customQuery($sql, $params = array(), $fetchMode = PDO::FETCH_ASSOC)
    {

        try{
            if(is_array($params) && !empty($params)){
                $sth = $this->prepare($sql);
                foreach($params as $key => $value){
                    list($key, $param) = $this->_prepareParams($key);
                    $sth->bindValue($key, $value, $param);
                }
                $sth->execute();
            }else{
                $sth = $this->query($sql);
            }
            $result = $sth->fetchAll($fetchMode);
        }catch(PDOException $e){
            $this->_errorLog('customQuery [database.php, ln.:'.$e->getLine().']', $e->getMessage().' => '.$sql);
            $result = false;
        }

        return $result;
    }

    /**
     * Performs a standard exec
     * @param string $sql
     * @param array $params
     * @return boolean
     */
    public function customExec($sql, $params = array())
    {

        try{
            if(is_array($params) && !empty($params)){
                $sth = $this->prepare($sql);
                foreach($params as $key => $value){
                    list($key, $param) = $this->_prepareParams($key);
                    $sth->bindValue($key, $value, $param);
                }
                $sth->execute();
                $result = $sth->rowCount();
            }else{
                $result = $this->exec($sql);
            }
        }catch(PDOException $e){
            $this->_errorLog('customExec [database.php, ln.:'.$e->getLine().']', $e->getMessage().' => '.$sql);
            $result = false;
        }

        return $result;
    }

     /**
     * Get error status
     * @return boolean
     */
    public static function getError()
    {
        return self::$_error;
    }

    /**
     * Get error message
     * @return string
     */
    public static function getErrorMessage()
    {
        return self::$_errorMessage;
    }

    /**
     * Writes error log
     * @param string $debugMessage
     * @param string $errorMessage
     */
    private function _errorLog($debugMessage, $errorMessage)
    {
        self::$_error = true;
        self::$_errorMessage = $errorMessage;
        printf('errors', $debugMessage, $errorMessage);
    }

    /**
     * Returns fata error page content
     * @return html code
     */
    private static function _fatalErrorPageContent()
    {
        return '<!DOCTYPE html>
        <html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Database Fatal Error</title>
        <style type="text/css">
            html{background:#f9f9f9}
            body{background:#fff; color:#333; font-family:sans-serif; margin:2em auto; padding:1em 2em 2em; -webkit-border-radius:3px; border-radius:3px; border:1px solid #dfdfdf; max-width:750px; text-align:left;}
            #error-page{margin-top:50px}
            #error-page h2{border-bottom:1px dotted #ccc;}
            #error-page p{font-size:16px; line-height:1.5; margin:2px 0 15px}
            #error-page .code-wrapper{color:#400; background-color:#f1f2f3; padding:5px; border:1px dashed #ddd}
            #error-page code{font-size:15px; font-family:Consolas,Monaco,monospace;}
            a{color:#21759B; text-decoration:none}
            a:hover{color:#D54E21}
            #footer{font-size:14px; margin-top:50px; color:#555;}
        </style>
        </head>
        <body id="error-page">
            <h2>Database connection error!</h2>
            {DESCRIPTION}
            <div class="code-wrapper">
            <code>{CODE}</code>
            </div>
            <div id="footer">
                If you\'re unsure what this error means you should probably contact your host.
                If you still need a help, you can alway visit <a href="http://apphp.net/forum" target="_new">ApPHP Support Forums</a>.
            </div>
        </body>
        </html>';
    }

    /**
     * Replaces any parameter placeholders in a query with the value of that parameter
     * @param string $sql
     * @param array $params
     * @return string
     */
    private function _interpolateQuery($sql, $params = array())
    {
        $keys = array();
        if(!is_array($params)) return $sql;

        // build regular expression for each parameter
        foreach($params as $key => $value){
            if (is_string($key)) {
                $keys[] = '/:'.$key.'/';
            }else{
                $keys[] = '/[?]/';
            }
        }

        return preg_replace($keys, $params, $sql, 1, $count);
    }

    /**
     * Prepares/changes keys and parameters
     * @param $key
     * @return array
     */
    private function _prepareParams($key)
    {
        $param = 0;
        $prefix = substr($key, 0, 2);
        switch($prefix){
            case 'i:':
                $key = str_replace('i:', ':', $key);
                $param = PDO::PARAM_INT;
                break;
            case 'b:':
                $key = str_replace('b:', ':', $key);
                $param = PDO::PARAM_BOOL;
                break;
            case 'f:':
                $key = str_replace('f:', ':', $key);
                $param = PDO::PARAM_STR;
                break;
            case 's:':
                $key = str_replace('s:', ':', $key);
                $param = PDO::PARAM_STR;
                break;
            case 'n:':
                $key = str_replace('n:', ':', $key);
                $param = PDO::PARAM_NULL;
                break;
            default:
                $param = PDO::PARAM_STR;
                break;
        }
        return array($key, $param);
    }
}
