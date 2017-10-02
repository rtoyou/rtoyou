<?php
class Profile extends CModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getProfile($emailid=null){
        if(!is_null($emailid)){
            $result = $this->_db->select("select * from ".CConfig::get('db.prefix')."user_profile where user_email =:user_email",
                array('user_email'=>$emailid));
            if($result !== false  ) {
                return $result;
            }
            else{
                return false;
            }
        }
        return false;


    }

    public function updateUser($name,$gender,$dob,$about,$country,$twitter,$facebook,$instagram,$contact,$email) {

        $result = $this->_db->update(
            'user_profile',
            array('user_name'=>$name,'user_gender'=>$gender,'user_dob'=>$dob,'user_about'=>$about,'user_location'=>$country,
                'user_contact_number'=>$contact,'facebook_link'=>$facebook,'twitter_link'=>$twitter,
                'user_instagram_profile'=>$instagram),
            'user_email =:email',
            array('email'=>$email)
        );
        if($result !== false) {
            return true;
        } else {
            return false;
        }

    }
    public function ispasswordExist($pwd=null,$mail=null) {
        if(!is_null($pwd) && !is_null($mail)) {
            $result = $this->_db->select("select count(*) as total from ".CConfig::get('db.prefix')."user_profile where
					user_email =:email and user_password=:pwd",
                array('email'=>$mail,'pwd'=>md5($pwd)));
            if($result !== false && $result[0]['total'] == 1 ) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function changePwd($password,$mail) {

        $result = $this->_db->update(
            'user_profile',
            array('user_password'=>md5($password)),
            'user_email =:email',
            array('email'=>$mail)
        );
        if($result !== false) {
            return true;
        } else {
            return false;
        }

    }

    public function updatePicture($id,$file) {

        $result = $this->_db->update(
            'user_profile',
            array('user_image'=>$file),
            'user_id ='.$id);
        if($result !== false) {
            return true;
        } else {
            return false;
        }

    }
    public function updateUserCategoryPreferences($user=NULL,$sequence=NULL) {

        $result = $this->_db->update(
            'user_profile',
            array('user_pref'=>$sequence)
        );
        if($result !== false) {
            return true;
        } else {
            return false;
        }

    }

    public function getUserCategoryPreferences($user=NULL) {

        if(!is_null($user)){
            $result = $this->_db->select("select user_pref from ".CConfig::get('db.prefix')."user_profile where user_id =:user",
                array('user'=>$user));
            if($result !== false  ) {
                return $result;
            }
            else{
                return false;
            }
        }
        return false;

    }
    public function getTotalReviewsUsers($userId= 0){
        if(!is_null($userId)){
            $result = $this->_db->select("select count(*) as totalReview from ".CConfig::get('db.prefix')."reviews where comment_from =:user",
                array('user'=>$user));
            if($result !== false  ) {
                return $result[0]['totalReview'];
            }
            else{
                return 0;
            }
        }
    }

    public function getAllCountryList(){
        $result = $this->_db->select("select * from ".CConfig::get('db.prefix')."countries ORDER BY nameImage ASC ");
        return $result;
    }
     public function saveEmailAddress($userId,$email,$hash) {
	return $this->_db->update('user_profile',array('activation_email_status'=>0,'user_email'=>$email,'activation_email'=>$hash), 'user_id ='.$userId);
   }
}
