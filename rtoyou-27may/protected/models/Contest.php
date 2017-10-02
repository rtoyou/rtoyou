<?php

class Contest extends CModel
{
    public $contestName;
    public $contestDescription;
    public $contestId;

	public function __construct()
	{
		parent::__construct();
	}

    /**
     * Function will participate the contestant to the specific contest if eligible -
     *
     * return -1 if already participated
     * else return boolean
     *
     * @param int $contestId
     * @param int $userId
     * @return bool
     */

    public function participateUser($contestId=0,$userId=0,$ipAddress='',$date=''){
        $data = $this->_db->select('select count(*) as total from ' . CConfig::get('db.prefix') . 'contestants where contest_id=:contest and user_id=:user ',
            array('contest'=>$contestId,'user'=>$userId));
        if($data[0]['total'] >= 1) {
            return -1;
        } else {
            return $this->_db->insert('contestants', array('participation_date' => $date, 'ip' => $ipAddress, 'contest_id' => $contestId, 'user_id' => $userId));
        }
    }

    /**
     * Check Eligibility for participation of contestant
     *
     * @param int $contestId
     * @param int $userId
     * @return bool
     */

    public function isEligible($contestId=0,$userId=0){
        return false;
    }


    /**
     * Expire the participate link
     *
     * @param string $link
     * @return bool
     */
    public function expireParticipateLink($hashCode = '',$verification =''){
        $return = $this->_db->customExec('update ' . CConfig::get('db.prefix') . 'emails
				set clicked = 1, clicked_on=:datetime where hashCode=:hashCode and verificationCode=:verification ', array('datetime' => date('Y-m-d H:i:s'),
            'hashCode'=>$hashCode,'verification'=>$verification));
        $success = $return ? true : false;
        return $success;
    }

    /**
     * function to test if clicked link is expired
     *
     * @param string $link
     * @return bool
     */
    public function isExpiredContestLink($hashCode = '',$verification =''){
        $data = $this->_db->select('select count(*) as total from ' . CConfig::get('db.prefix') . 'emails where hashCode=:hashCode and verificationCode=:verification and clicked = 1',
            array('hashCode'=>$hashCode,'verification'=>$verification));
        return $data[0]['total'] >= 1 ? true : false;

    }

	public function triggerEmail($email,$hash,$ver,$contest){
		$array = array('email'=>$email,'hashCode'=>$hash,'verificationCode'=>$ver,'contestID'=>$contest,'sent_on'=>date('Y-m-d H:i:s'));
		$this->_db->insert('emails',$array);
		return true;
		
	}
   public function isParticipant($userid) {
	$data = $this->_db->select('select count(*) as total from '.CConfig::get('db.prefix').'contestants where user_id=:user ',array('user'=>$userid));
	return $data[0]['total']>=1 ? true : false;	

   }   
}
