<?php

/**
 * Created by PhpStorm.
 * User: prashant
 * Date: 8/10/16
 * Time: 3:21 PM
 */

class ReviewUtil
{
    public $_review = NULL;
    public static $validWords = 10;
    public $_params = array();
    public $_words = array();
    private $promotionalWords = array();
    public $spamCategory = NULL;
    public $spamWord = NULL;

    private $domainThreeDigits = array('com', 'biz', 'net', 'org');
    private $domainFourDigits = array('info', 'firm', 'mobi', 'jobs');
    public $errorMsg = "Offensive verbiage identified. Kindly review the content being published.";

    public $_promotionalErrorMessage = "Your Review has some promotional content.";
    public $_inValidWordErrorMessage = "Your Review should be at least 10 words long.";
    public $_repeatWordErrorMessage = "Your Review can not contains three repeat words.";
    public $_contactErrorMessage = "Your Review contains some contact Numbers.";
    public $_urlContainsErrorMessage = "Your Review contains Urls. Kindly remove any urls from the review.";

    function __construct($review)
    {
       // $this->promotionalWords = $this->loadPromotionalWords();
        $this->_review = $review;
    }

    private function loadPromotionalWords() {
        $csv = BASE_DIR . "/protected/configs/promotionals.csv";
        $handle = fopen($csv, 'r');
        while (($data = fgetcsv($handle) ) !== FALSE) {
            if (!empty($data[0]))
                $this->promotionalWords[] = $data[0];
        }
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    /**
     * Length of review
     *
     * @return int
     */
    public function getReviewLength() {
        return (int) strlen($this->_review);
    }

    /**
     *  Number of words
     *
     * @return int
     */
    public function getReviewWords() {
        return (int) str_word_count($this->_review);
    }

    public function getWords(){
        if(!$this->_words) {
            $this->_words = explode(" ",$this->_review);
	    $words = array();
	    foreach ($this->_words as $w) {
		if(!empty($w)){
		    $words[]= $w;
		}
	    }
	    $this->_words = $words;
	}
        return $this->_words;
    }
    /**
     *  Count of letters in each words in a Review
     * @return array
     */
    public function getNumberofLengthOfWords(){
        $words = $this->getWords();
        foreach ($words as $word) {
            $length = strlen($word);
            $this->_params[$length][] = $word;
        }
        return $this->_params;
    }

    /**
     *  1- No. of Words should be at least 10
     *  2- No. of repeat words can not be more than 3
     *  3- No Contact details
     *  4- No Promotional Content
     *  5- No Urls
     *
     * @return bool
     */
    public function isValidReview (){
        $success = true;
	$wordCount = $this->getReviewWords();
	if($wordCount <= self::$validWords) {
            $message = $this->_inValidWordErrorMessage;
            $success = false;
            return array('success'=>$success,'message'=>$message);
        }

        
        $words = $this->getWords();

        for($i=0;$i< count($words) - 2 ;$i++){
            $wordToMatch = $words[$i];
            if (($wordToMatch == $words[$i + 1]) && $words[$i + 1] == $words[$i + 2]) {
                $message = $this->_repeatWordErrorMessage;
                $success = false;
                break;
            }
        }

        if(!$success) {
            return array('success'=>$success,'message'=>$message);
        }
        if($this->hasContactNumber($this->_review)) {
            $message = $this->_contactErrorMessage;
            $success = false;
            return array('success'=>$success,'message'=>$message);
        }

        if($this->havePromotional($this->_review)) {
            $message = $this->_promotionalErrorMessage;
            $success = false;
            return array('success'=>$success,'message'=>$message);
        }

        if(!$this->hasNoUrl()) {
            $message = $this->_urlContainsErrorMessage;
            $success = false;
            return array('success'=>$success,'message'=>$message);
        }

        return array('success'=>$success,'message'=>'Review is a valid Text.');
    }

    /**
     * check if review contains any URL
     *
     * @param null $url
     * @return bool
     */
    private function hasNoUrl() {
        $pattern1 = "/(http:\/\/|)(www.|)([\d\w-]{1,63}\.|)([\d\w-]{2,63}\.|)[A-Z0-9-]{4,30}(\.(a[cdefgilmnoqrstuwxz]|aero|arpa)|(b[abdefghijmnorstvwyz]|biz)|(c[acdfghiklmnorsuvxyz]|cat|com|coop)|d[ejkmoz]|(e[ceghrstu]|edu)|f[ijkmor]|(g[abdefghilmnpqrstuwy]|gov)|h[kmnrtu]|(i[delmnoqrst]|info|int)|(j[emop]|jobs)|k[eghimnprwyz]|l[abcikrstuvy]|(m[acdghklmnopqrstuvwxyz]|mil|mobi|museum)|(n[acefgilopruz]|name|net)|(om|org)|(p[aefghklmnrstwy]|pro)|qa|r[eouw]|s[abcdeghijklmnortvyz]|(t[cdfghjklmnoprtvwz]|travel)|u[agkmsyz]|v[aceginu]|w[fs]|y[etu]|z[amw])/i";
        $pattern2 = "/(http:\/\/|)(www.|)([a-z0-9]([-a-z0-9]*[a-z0-9])?\\.)+((a[cdefgilmnoqrstuwxz]|aero|arpa)|(b[abdefghijmnorstvwyz]|biz)|(c[acdfghiklmnorsuvxyz]|cat|com|coop)|d[ejkmoz]|(e[ceghrstu]|edu)|f[ijkmor]|(g[abdefghilmnpqrstuwy]|gov)|h[kmnrtu]|(i[delmnoqrst]|info|int)|(j[emop]|jobs)|k[eghimnprwyz]|l[abcikrstuvy]|(m[acdghklmnopqrstuvwxyz]|mil|mobi|museum)|(n[acefgilopruz]|name|net)|(om|org)|(p[aefghklmnrstwy]|pro)|qa|r[eouw]|s[abcdeghijklmnortvyz]|(t[cdfghjklmnoprtvwz]|travel)|u[agkmsyz]|v[aceginu]|w[fs]|y[etu]|z[amw])$/i
";
        $pattern3 = "/(http:\/\/|)(www.)([A-Z0-9-\.])/i";

        $reviewWords = $this->getReviewWords();
        if (empty($reviewWords))
            return false;

        foreach ($reviewWords as $word) {
            $split = explode('.', $word);
            if ($split[0] == 'www' || $split[0] == 'http://www' || $split[0] == 'https://www')
                break;

            $extIndex = (count($split) - 1);
            $extension = trim($split[$extIndex]);
            if (strlen($extension) == 2) {
                if (in_array($extension, $this->common_words))
                    break;
            }

            if (strlen($extension) > 3 && !in_array($extension, $this->domainFourDigits))
                return false;
            if (strlen($extension) == 3 && !in_array($extension, $this->domainThreeDigits))
                return false;
            if (strlen($extension) <= 1)
                return false;

            if (preg_match($pattern1, $word, $match) == true)
                return true;
            elseif (preg_match($pattern2, $word, $match) == true)
                return true;
            elseif (preg_match($pattern3, $word, $match) == true)
                return true;
            return false;
        }
        return true;
    }

    /**
     * checks if the content have mobile number or landline number
     * @name hasContactNumber
     * @param <string> $content
     * @return <boolean> true|false
     */
    private function hasContactNumber($review = '') {
        $text = strip_tags($review ? $review : $this->_review);
        //compress the whitespace
        $contentCompress = ereg_replace('[[:space:]]+', '', $text);
	if (preg_match('/(\+)\d{2}(\-)*([0-9])+/i', $contentCompress, $match)) {
            $this->setSpamVariables('contact', $match[1]);
            return true;
        } elseif (preg_match('/(?<!\d)(\d{10,12})(?!\d)/', $contentCompress, $match)) {
            $this->setSpamVariables('contact', $match[1]);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if review contains any promotional
     *
     * @return bool
     */
    private function havePromotional() {
        if (!empty($this->promotionalWords)) {
            foreach ($this->promotionalWords as $phrase) {
                $position = stripos($this->_review, $phrase);
                if ($position !== false) {
                    $this->setSpamVariables('promotional',$phrase);
                    return false;
                    break;
                }
            }
        }
        return false;
    }

    public function setSpamVariables($category, $word = null){
        $this->spamCategory = $category;
        $this->spamWord = $word;
    }

    public static function getReviewShortTitle($review) {
	$r = wordwrap($review, 70, "\n", true);
	
	//$array = explode('<br/>', wordwrap($review['review'], 80, "<br/>", true));
	return substr($r,0 ,strpos($r,"\n"))."...";
    }
     public static function isContactAvailable($detailInformation = array()) {
	$available = false;

        if(!empty($detailInformation['subcat_contact']) || !empty($detailInformation['subcat_url']) || !empty($detailInformation['subcat_author'])) {
		$available = true;
	}
	return $available;
    }
}
