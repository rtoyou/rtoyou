<?php

/**
 * CRouter core class file
 *
 * @project ApPHP Framework
 * @author ApPHP <info@apphp.com>
 * @link http://www.apphpframework.com/
 * @copyright Copyright (c) 2012 - 2013 ApPHP Framework
 * @license http://www.apphpframework.com/license/
 *
 * USAGE:
 * ----------
 * 1st way - URL    : http://localhost/site/index.php?url=page/contact&param1=aaa&param2=bbb&param3=ccc
 *           CONFIG : 'urlFormat'=>'get' (default)
 *             CALL    : $controller->$action();
 *             GET    : A::app()->getRequest()->getQuery('param1');
 *             FILTER    : manually in code
 * 2st way - URL    : http://localhost/site/page/contact?param1=aaa&param2=bbb&param3=ccc
 *           CONFIG    : 'urlFormat'=>'get' (default)
 *             CALL    : $controller->$action();
 *           GET    : A::app()->getRequest()->getQuery('param1');
 *           FILTER    : manually in code
 * 3st way - URL    : http://localhost/site/page/contact/param1/aaa/param2/bbb/param3/ccc
 *           CONFIG    : 'urlFormat'=>'path' (default)
 *           CALL    : $controller->$action($param1, $param2, $param3);
 *           GET    : actionName($param1 = '', $param2 = '', $param3 = '')
 *           FILTER    : manually in code
 * 4st way - URL    : according to redirection rule
 *                        - simple redirection rule:
 *                      'controller/action/value1/value2' => 'controller/action/param1/value1/param2/value2',
 *                    - advanced redirection rule:
 *                      'index\/page\/id\/(.*[0-9])+' => 'index/page/id/{$0}',
 *                      'index\/page\/(.*[0-9])+' => 'index/page/id/{$0}',
 *                      'index\/page\/(.*[0-9])+\/(.*?)' => 'index/page/id/{$0}',
 *           CONFIG    : 'urlFormat'=>'shortPath' (default)
 *           CALL    : $controller->$action($param1, $param2, $param3);
 *           GET    : actionName($param1 = '', $param2 = '', $param3 = '')
 *           FILTER    : automatically according to define type (not implemented yet)
 *
 *
 *
 *
 * PUBLIC:                    PROTECTED:                    PRIVATE:
 * ----------               ----------                  ----------
 * __construct
 * route
 * getCurrentUrl
 *
 *
 * STATIC:
 * ---------------------------------------------------------------
 * getParams
 *
 */
class CRouter
{
    /**    @var string */
    private $_path;
    /**    @var string */
    private $_controller;
    /**    @var string */
    private $_action;
    /**    @var string */
    private $_module;
    /** @var array */
    private static $_params = array();

    /**
     * @var string
     */
    protected $_base_uri;

    /**
     * @var array
     */
    protected $_routes;

    /**
     * @var array
     */
    protected $_match;


    /**
     * Class constructor
     */
    public function __construct()
    {
        $urlFormat = CConfig::get('urlManager.urlFormat');
        $rules = (array)CConfig::get('urlManager.rules');

        $request = isset($_GET['url']) ? $_GET['url'] : '';

        $this->_base_uri = $request;

        $urlBits = explode("/", $request);
        $urlbitsCount = count($urlBits);


        $ro = array(
            '/' => array('index', 'index'),
            '404' => array('error', 'index'),
            'participate'=>array('contest','initparticipation'),
            'faq' => array('about', 'faq'),
            'terms-and-conditions' => array('about', 'tandc', array()),
            'privacy-policy' => array('about', 'privacy', array()),
            'career' => array('about', 'career', array()),
            'about-us' => array('about', 'index', array()),
            'contact' => array('about', 'contact', array()),
            'home' => array('index', 'index'),
            'login' => array('index', 'login'),
            'joinnow' => array('signup', 'index'),
            'hotels-and-restraunts/:seotitle' => array('detail', 'index'),
            'holiday-and-tours/:seotitle' => array('detail', 'index'),
            'books-and-magazines/:seotitle' => array('detail', 'index'),
            'companies-and-organization/:seotitle' => array('detail', 'index'),
            'social-services-and-ngo/:seotitle' => array('detail', 'index'),
            'books-and-magazines/:seotitle' => array('detail', 'index'),
            'religious/:seotitle' => array('detail', 'index'),
            'internet-organizations/:seotitle' => array('detail', 'index'),
	    'hospital-and-medical/:seotitle'=>array('detail','index'),
            'home-appliances/:seotitle' => array('detail', 'index'),
            'automobiles/:seotitle' => array('detail', 'index'),
            'drinks-and-food/:seotitle' => array('detail', 'index'),
            'music-and-movies/:seotitle' => array('detail', 'index'),
            'events-and-birthday/:seotitle' => array('detail', 'index'),
            'academics/:seotitle' => array('detail', 'index'),
            'personalities/:seotitle' => array('detail', 'index'),
            'beauty-and-spas/:seotitle' => array('detail', 'index'),
            'real-estate/:seotitle' => array('detail', 'index'),
            'hotels-and-restraunts' => array('category', 'list', array('id' => 'hotels-and-restraunts')),
            'holiday-and-tours' => array('category', 'list', array('id' => 'holiday-and-tours')),
            'books-and-magazines' => array('category', 'list', array('id' => 'books-and-magazines')),
            'companies-and-organization' => array('category', 'list', array('id' => 'companies-and-organization')),
            'social-services-and-ngo' => array('category', 'list', array('id' => 'social-services-and-ngo')),
            'religious' => array('category', 'list', array('id' => 'religious')),
            'hospital-and-medical' => array('category', 'list', array('id' => 'hospital-and-medical')),
            'internet-organizations' => array('category', 'list', array('id' => 'internet-organizations')),
            'automobiles' => array('category', 'list', array('id' => 'automobiles')),
            'home-appliances' => array('category', 'list', array('id' => 'home-appliances')),
            'drinks-and-food' => array('category', 'list', array('id' => 'drinks-and-food')),
            'music-and-movies' => array('category', 'list', array('id' => 'music-and-movies')),
            'events-and-birthday' => array('category', 'list', array('id' => 'events-and-birthday')),
            'academics' => array('category', 'list', array('id' => 'academics')),
            'personalities' => array('category', 'list', array('id' => 'personalities')),
            'beauty-and-spas' => array('category', 'list', array('id' => 'beauty-and-spas')),
	     'others' => array('category', 'list', array('id' => 'others')),
            'real-estate' => array('category', 'list', array('id' => 'real-estate'))
        );

        $routesKeys = array_keys($ro);
        $keyfound = false;

        if (array_key_exists($request, $ro)) {

            $this->_controller = ucfirst($ro[$request][0]);
            $this->_action = $ro[$request][1];
	    if(isset( $ro[$request][2])) {
		self::$_params = $ro[$request][2];
            }
            $keyfound = true;

        } else {
            foreach ($routesKeys as $routekey) {
                if ($routekey == "/" || $routekey == "home" || $routekey == "index") continue;
                $routekeysBits = explode("/", $routekey);
                if (count($routekeysBits) < 2) {
                    continue;
                } else {
                    if ($urlBits[0] == $routekeysBits[0]) {
                        $this->_controller = ucfirst($ro[$urlBits[0] . "/" . $routekeysBits[1]][0]);
                        $this->_action = $ro[$urlBits[0] . "/" . $routekeysBits[1]][1];

                        self::$_params = array($routekeysBits[1] => $urlBits[1]);
                        $keyfound = true;
                        break;
                    }
                }

            }
        }
        if (!$keyfound) {
            $standardCheck = true;

            // check if there are special URL rules
            if ($urlFormat == 'shortPath' && is_array($rules)) {
                foreach ($rules as $rule => $val) {
                    $matches = '';
                    //if($rule === $request){
                    //    $request = $val;
                    //	break;
                    //}else
                    if (preg_match_all('{' . $rule . '}i', $request, $matches)) {
                        // template rule compare
                        if (isset($matches[1]) && is_array($matches[1])) {
                            foreach ($matches[1] as $mkey => $mval) {
                                $val = str_ireplace('{$' . $mkey . '}', $mval, $val);
                            }
                            $request = $val;
                            break;
                        }
                    }
                }

                // if not found - use a standard way
                $urlFormat = '';
            }

            if ($standardCheck) {
                $split = explode('/', trim($request, '/'));
                if ($split) {

                    foreach ($split as $index => $part) {
                        if (!$this->_controller) {
                            $this->_controller = ucfirst($part);
                            CDebug::addMessage('params', 'controller', $this->_controller);
                        } else if (!$this->_action) {
                            $this->_action = $part;
                            CDebug::addMessage('params', 'action', $this->_action);
                        } else {
                            if (!self::$_params || end(self::$_params) !== null) {
                                self::$_params[$part] = null;
                            } else {
                                $arrayArg = array_keys(self::$_params);
                                self::$_params[end($arrayArg)] = $part;
                            }
                            CDebug::addMessage('params', 'params', print_r(self::$_params, true));
                        }
                    }
                }
            }
        }

        if (!$this->_controller) {
            $defaultController = CConfig::get('defaultController');
            $this->_controller = !empty($defaultController) ? CFilter::sanitize('alphanumeric', $defaultController) : 'Index';
        }
        if (!$this->_action) {
            $defaultAction = CConfig::get('defaultAction');
            $this->_action = !empty($defaultAction) ? CFilter::sanitize('alphanumeric', $defaultAction) : 'index';
        }

    }

    public function getRoutes()
    {
        return array('/:category/:subcategory/' => array('category', 'list'));

    }

    protected function _setMatch($match, $result = null)
    {
        if ($match === null) {
            $this->_match = array(null, null);
            return $this;
        }

        // extra params related to the match
        if (!isset($match[2])) {
            $this->_match = $this->_alterMatch($match);
            return $this;
        }

        $params = $match[2];
        foreach ($params as $key => $param) {

            if (!is_int($key)) {
                $this->_params[$key] = $param;
                continue;
            }

            // if the key is an integer that means this is a regex param
            // only add it if it is part of the regex matches
            if (isset($result[$key])) {
                $this->_params[$param] = $result[$key];
                continue;
            }
        }

        $this->_match = $this->_alterMatch($match);
        return $this;
    }

    /**
     * checks to see if controller or action params are present
     * if so those overwrite the current controller and action
     *
     * @param array $match
     * @return array $match
     */
    protected function _alterMatch(array $match)
    {
        // special case where you can set controller or action dynamically
        if (isset($this->_params['CONTROLLER'])) {
            $match[0] = str_replace('-', '_', $this->_params['CONTROLLER']);
            unset($this->_params['CONTROLLER']);
        }

        if (isset($this->_params['ACTION'])) {
            $match[1] = str_replace('-', '_', $this->_params['ACTION']);
            unset($this->_params['ACTION']);
        }

        return $match;
    }

    /**
     * gets the matching controller / action by processing the routes
     *
     * @return array (looks like: array('controller_name', 'action_name'))
     */
    protected function _getMatch()
    {
        // match is already set, return that
        if ($this->_match !== null) {
            return $this->_match;
        }

        // get the base url
        $base_uri = $this->_base_uri == '/' ? $this->_base_uri : rtrim($this->_base_uri, '/');

        // optimization for the homepage so we don't have to hit the routes
        if ($base_uri === '/' && !$this->_subdomain) {
            $this->_match = array('home', 'index');
            return $this->_match;
        }

        $routes = $this->getRoutes();

        // direct match optimization
        if (isset($routes[$base_uri])) {
            $this->_setMatch($routes[$base_uri]);
            return $this->_match;
        }

        // get all of the keys in the routes file
        $route_keys = array_keys($routes);
        $len = count($route_keys);

        // loop through all of the routes and check for a match
        $match = false;
        for ($i = 0; $i < $len; ++$i) {
            $result = $this->_matches($route_keys[$i], $base_uri);
            if ($result) {
                $match = true;

                // stop after the first match!
                break;
            }
        }

        if ($match) {
            $this->_setMatch($routes[$route_keys[$i]], $result);
            return $this->_match;
        }

        $this->_setMatch(null);
        return $this->_match;
    }

    /**
     * checks if parts of the requested uri match a route uri
     *
     * @param string $route_uri /profile/:user_id
     * @param string $base_uri /profile/25
     * @return bool
     */
    protected function _matches($route_uri, $base_uri)
    {
        if (isset($route_uri[1]) && $route_uri[0] . $route_uri[1] == 'r:') {
            return $this->_matchesRegex($route_uri, $base_uri);
        }

        $route_bits = explode('/', $route_uri);
        $url_bits = explode('/', $base_uri);

        $route_bit_count = count($route_bits);

        // if the urls don't have the same number of parts then this is not a match
        if ($route_bit_count !== count($url_bits)) {
            return false;
        }

        $params = array();
        for ($i = 1; $i < $route_bit_count; ++$i) {

            // if the first character of this part of the route is a ':' that means this is a parameter
            // let's store it and continue
            $first_char = isset($route_bits[$i][0]) ? $route_bits[$i][0] : null;

            // regular old vars
            if ($first_char == ':' || $first_char == '*') {
                $param = substr($route_bits[$i], 1);
                $params[$param] = $url_bits[$i];
                continue;
            }

            // numeric values
            if ($first_char == '#' && is_numeric($url_bits[$i])) {
                $param = substr($route_bits[$i], 1);
                $params[$param] = $url_bits[$i];
                continue;
            }

            // alpha values
            if ($first_char == '@' && preg_match('/^[a-zA-Z]+$/', $url_bits[$i]) > 0) {
                $param = substr($route_bits[$i], 1);
                $params[$param] = $url_bits[$i];
                continue;
            }

            // if any part of the urls don't match then return false immediately
            if ($route_bits[$i] != $url_bits[$i]) {
                return false;
            }
        }

        $this->_params = $params;
        return true;
    }

    /**
     * checks if this route matches a regex route
     *
     * @param string $route_uri
     * @param string $base_uri
     * @return mixed array on success false on failure
     */
    protected function _matchesRegex($route_uri, $base_uri)
    {
        $route_uri = substr($route_uri, 2);

        // allow / or \/
        $route_uri = str_replace(array('/', '\\\\'), array('\/', '\\'), $route_uri);
        $match_count = preg_match('/' . $route_uri . '/i', $base_uri, $matches);
        return $match_count > 0 ? $matches : false;
    }

    /**
     * Router
     */
    public function route()
    {

        $appDir = APPHP_PATH . DS . 'protected' . DS . 'controllers' . DS;
        $file = $this->_controller . 'Controller.php';

        if (is_file($appDir . $file)) {
            $class = $this->_controller . 'Controller';
        } else {
            $comDir = APPHP_PATH . DS . 'protected' . DS . A::app()->mapAppModule($this->_controller) . 'controllers' . DS;
            if (is_file($comDir . $file)) {
                $class = $this->_controller . 'Controller';
            } else {
                $class = 'ErrorController';
                A::app()->setResponseCode('404');
                CDebug::addMessage('errors', 'controller', A::t('core', 'Router: unable to resolve the request "{controller}".', array('{controller}' => $this->_controller)));
            }
        }
        A::app()->view->setController($this->_controller);
        $controller = new $class();

        if (is_callable(array($controller, $this->_action . 'Action'))) {

            $action = $this->_action . 'Action';
        } else if ($class != 'ErrorController') {
            // for non-logged users and classes where errorAction was not redeclared - force using standard 404 error controller
            $reflector = new ReflectionMethod($class, 'errorAction');
            if (!CAuth::isLoggedIn() && $reflector->getDeclaringClass()->getName() == 'CController') {
                $controller = new ErrorController();
                $action = 'indexAction';
            } else {
                $action = 'errorAction';
            }
            CDebug::addMessage('errors', 'action', A::t('core', 'The system is unable to find the requested action "{action}".', array('{action}' => $this->_action)));
        } else {
            $action = 'indexAction';
        }

        A::app()->view->setAction($this->_action);

        // call controller::action + pass parameters
        call_user_func_array(array($controller, $action), self::getParams());

        CDebug::addMessage('params', 'run_controller', $class);
        CDebug::addMessage('params', 'run_action', $action);
    }

    /**
     * Returns current URL
     * @return string
     */
    public function getCurrentUrl()
    {
        $path = A::app()->getRequest()->getBaseUrl();
        $path .= strtolower(A::app()->view->getController()) . '/';
        $path .= A::app()->view->getAction();

        $params = self::getParams();
        foreach ($params as $key => $val) {
            $path .= '/' . $key . '/' . $val;
        }

        return $path;
    }

    /**
     * Get array of parameters
     * @return array
     */
    public static function getParams()
    {
        return self::$_params;
    }

}
