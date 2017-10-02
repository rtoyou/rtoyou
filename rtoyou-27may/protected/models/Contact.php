<?php

class Contact extends CModel
{
	public function __construct()
	{
		parent::__construct();
	}

	public function saveContactMessage($name,$email,$message,$ip){
        $array = array('name'=>$name,'message'=>$message,'email'=>$email,'ip'=>$ip);
        $return = $this->_db->insert('contact', $array);
       // EmailUtil::sendContactEmail();
        return $return;
    }
}
