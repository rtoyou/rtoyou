<?php
class LoginUtil {

	public static function setSession($data){
		$session = CHttpSession::init();
		
		$session->set('loggedId', $data[0]['user_id']);
		$session->set('loggedName', $data[0]['user_name']);
		$session->set('loggedEmail', $data[0]['user_email']);
		$session->set('loggedLastVisit', $data[0]['created_time']);
		$session->set('loggedAvatar', CConfig::get('BaseUrlImage').'/profile/'.$data[0]['user_image']);
		$session->set('loggedRole', $data[0]['user_role']);
        $session->set('userPref',$data[0]['user_pref']);
	}

	public static function setUserAvatar($image){
		$session = CHttpSession::init();
		$session->set('loggedAvatar', CConfig::get('BaseUrlImage').'/profile/'.$image);

	}
	public static function setUserName($name){
		$session = CHttpSession::init();
		$session->set('loggedName', $name);

	}
}
