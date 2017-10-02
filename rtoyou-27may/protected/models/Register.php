<?php
class Register extends CModel
{
	public function __construct()
	{
		parent::__construct();
	}

	public function isGoogleUserExist ($googleID = null) {
		if(!is_null($googleID)) {
			$result = $this->_db->select("select count(*) as total from ".CConfig::get('db.prefix')."user_profile where
					user_google_id =:google_id",
					array('google_id'=>$googleID));
			if($result !== false && $result[0]['total'] == 1 ) {
				return true;
			} else {
				return false;
			}
		}
		return false;
	}

	public function isFacebookUserExist ($facebookId = null) {
		if(!is_null($facebookId)) {
			$result = $this->_db->select("select count(*) as total from ".CConfig::get('db.prefix')."user_profile where
					user_facebook_id =:facebook_id",
					array('facebook_id'=>$facebookId));
			if($result !== false && $result[0]['total'] == 1 ) {
				return true;
			} else {
				return false;
			}
		}
		return false;
	}

	public function isEmailExist($email=null) {
		if(!is_null($email)) {
			$result = $this->_db->select("select count(*) as total from ".CConfig::get('db.prefix')."user_profile where
					user_email =:email",
					array('email'=>$email));
			if($result !== false && $result[0]['total'] == 1 ) {
				return true;
			} else {
				return false;
			}
		}
		return false;
	}

	public function saveUser ($name,$email,$gender,$dob,$facebook = null , $google = null , $google_profile = null ,
			$facebook_profile = null , $twitter =null,$instagram=null,$imageUrl,$password=null,$activation=null) {
		$categoryObj = new Category();
		$allCat = $categoryObj->get();
		foreach($allCat as $cat){
			$pref.=$cat['category_id'].",";
		}
		$pref=substr($pref,0,-1);
		$data = array('user_name'=>$name,'user_email'=>$email,'user_gender'=>$gender,'created_date'=>date('Y-m-d H:i:s'),
				'user_image'=>$imageUrl,'user_dob'=>$dob,'facebook_link'=>$facebook_profile,'twitter_link'=>$twitter,
				'user_instagram_profile'=>$instagram,'user_google_profile'=>$google_profile,'user_facebook_id'=>$facebook,
				'user_google_id'=>$google,'user_password'=>$password,'activation_email'=>$activation,'user_pref'=>$pref);
		$result = $this->_db->insert('user_profile',$data);
		if($result !== false) {
			return true;
		} else {
			return false;
		}

	}
	
	public function verifyEmail($mail,$hash) {
	       if(!is_null($mail) && !is_null($hash)) {
			$total	=	$this->_db->select('select count(*) as total from '.CConfig::get('db.prefix').'user_profile
					where user_email=:email and activation_email=:hash',array('email'=>$mail,'hash'=>$hash));
			
			if(intval($total[0]['total']) == 1) {
				$updated	=	$this->_db->update('user_profile',array('user_status'=>1,'activation_email'=>''),' user_email =:email and activation_email=:hash ',array('email'=>$mail,'hash'=>$hash));
				return $updated ? true : false;
			}
			
		} 
		return false;
	}
	
	public function ForgotPassword($mail,$hash){
		if(!is_null($mail) && !is_null($hash)) {
			$updated	=	$this->_db->update('user_profile',array('activation_email'=>$hash),' user_email ="'.$mail.'" and
					activation_email_status = 1 ');
			if($updated){
				$userData = $this->_db->select('select user_name as name from '.CConfig::get('db.prefix').'user_profile
						where user_email=:email',array('email'=>$mail));
				return $userData[0]['name'];
			} else {
				return false;
			}
				
				
		}
		return false;
	}
	
	public function isValidResetPasswordLink($email,$hash){
		if(!is_null($email) && !is_null($hash)) {
			$total	=	$this->_db->select('select count(*) as total from '.CConfig::get('db.prefix').'user_profile
					where user_email=:email and activation_email=:hash',array('email'=>$email,'hash'=>$hash));
			if(intval($total[0]['total']) == 1) {
				$updated	=	$this->_db->update('user_profile',array('activation_email'=>''),' user_email ="'.$email.'" and
						activation_email ="'.$hash.'" ');
				return $updated ? true : false;
			}
				
		}
		return false;
	}
}
