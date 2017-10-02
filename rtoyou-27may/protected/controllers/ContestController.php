<?php

/**
 * Created by PhpStorm.
 * User: prashant
 * Date: 29/10/16
 * Time: 6:58 PM
 */
Class ContestController extends CController
{
    public function __construct()
    {
        parent::__construct();

        $this->_view->setMetaTags('keywords', 'contest,participate');
        $this->_view->setMetaTags('description', 'This is a static web site, consists from the few pages.');
    }

    public function initparticipationAction()
    {
        $this->_view->error = true;
        $request = new CHttpRequest();
        $contestId = $request->getQuery('c');
        $hash = $request->getQuery('h');
        $verification = $request->getQuery('_ver');

        $contestObj = new Contest();

        if (!$contestObj->isExpiredContestLink($hash, $verification)) {
            $session = CHttpSession::init();
            $session->set('initParticipate', serialize(array('hash' => $hash, 'ver' => $verification, 'cid' => $contestId)));
            $this->redirect('index/index?participate=1');
        } else {
            $message = 'Participation link has been expired!! Still you can participate by clicking on Participate Button.';
        }

        CHttpSession::init()->setFlash('participate', $message);
        if ($this->_view->error) {
            $this->redirect('index/index?error=1');
        }
        $this->redirect('index/index');
    }

    public function participateAction()
    {
        $this->_view->error = true;
        if (CAuth::isLoggedIn()) {
            $remoteIp = $_SERVER['REMOTE_ADDR'];
            $participateDate = date('Y-m-d H:i:s');
            $session = CHttpSession::init();
            $fromEmailLink = true;
	   
	    if($session->isExists('initParticipate')){
          	  $contestValues = unserialize($session->get('initParticipate'));
		  $contestId = $contestValues['cid'];
		  $session->remove('initParticipate');
	    } else {
		  $fromEmailLink = false;
		  $contestId = $_COOKIE['cid'];
            }
            $contestObj = new Contest();
            $participate = $contestObj->participateUser($contestId, CAuth::getLoggedId(), $remoteIp, $participateDate);

            if ($participate === -1) {
                $message = 'You have already a contestant for this contest. Write some Reviews to winning this contest.';
            } else if ($participate) {
            	if($fromEmailLink)
               		 $contestObj->expireParticipateLink($contestValues['hash'], $contestValues['ver']);
                $this->_view->error = false;
                $message = 'You have successfully participated in contest. Write some Reviews to winning this contest.';
            } else {
                $message = 'Some error in participating to the contest.';
            }
            $session->remove('initParticipate');
	    setcookie("cid", "",1,"/");           
            setcookie("participate", "",1,"/");
        } else {
            $message = 'You have to login to perform this action';
        }
        CHttpSession::init()->setFlash('participate', $message);
        if ($this->_view->error) {
            $this->redirect('index/index?error=1');
        }
        $this->redirect('post/index');
    }

    public function skipAction()
    {
        $session = CHttpSession::init();
        $session->remove('initParticipate');
        CHttpSession::init()->setFlash('participate', 'You have opt out for participation.');
        $this->redirect('index/index');
    }

}
