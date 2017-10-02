<?php
class Login extends CModel
{
	public function __construct()
	{
		parent::__construct();
	}

	public function login ($email,$password) {
		$result = $this->_db->select("select * from ".CConfig::get('db.prefix')."user_profile where
				user_email =:email and user_password =:password and user_status=1 " ,
				array('email'=>$email,'password'=>md5($password)));
		if($result !== false || count($result) == 0 ) {
			return $result;
		} else {
			return false;
		}

	}

	public function getUserByGoogle ($googleid,$email) {

		$result = $this->_db->select("select * from ".CConfig::get('db.prefix')."user_profile where
				user_email =:email and user_google_id =:googleid",
				array('email'=>$email,'googleid'=>$googleid));
		if($result !== false || count($result) == 0 ) {
			return $result;
		} else {
			return false;
		}

	}
	public function getUserByFacebook ($facebookid ,$email) {

		$result = $this->_db->select("select * from ".CConfig::get('db.prefix')."user_profile where
				user_facebook_id =:facebookid",
				array('facebookid'=>$facebookid));
		if($result !== false || count($result) == 0 ) {
			return $result;
		} else {
			return false;
		}

	}
	public function getUserByEmail ($email) {
	
		$result = $this->_db->select("select * from ".CConfig::get('db.prefix')."user_profile where
				user_email =:email ",
				array('email'=>$email));
		if($result !== false || count($result) == 0 ) {
			return $result;
		} else {
			return false;
		}
	
	}
	
}
