<?php

class SignupController extends CController
{
	public function __construct()
	{
		CAuth::handleLoggedIn();
		parent::__construct();

		$this->_view->errorField = '';
		$this->_view->actionMessage = '';

		$this->_view->setMetaTags('title', 'Join Now - Rtoyou');
		$this->_view->setMetaTags('keywords', 'registration,join now, rtoyou user');
		$this->_view->setMetaTags('description', '');

	}

	public function indexAction()
	{
		$this->_view->header = 'RtoYou - SignUp';
		$this->view->active = 'Signup';
		$this->_view->render('signup/index');
	}

	public function insertAction()
	{
		$this->_view->emailid    = $_POST['emailid'];
		$this->_view->password   = $_POST['password'];
		$this->_view->cpassword  = $_POST['cpassword'];
		$this->_view->twitter    = $_POST['twitter'];
		$this->_view->facebook   = $_POST['facebook'];
		$this->_view->google     = $_POST['google'];
		$this->_view->name       = $_POST['name'];
		$this->_view->gender     = $_POST['gender'];
		$this->_view->bday       = $_POST['bday'];
		$msg = '';
		$msgType = '';

			
		if($_POST['register'] == 'submit'){

			// perform login form validation
			$result = CWidget::create('CFormValidation', array(
					'fields'=>array(
							'emailid'=>array('title'=>'emailid', 'validation'=>array('required'=>true, 'type'=>'any')),
							'password'=>array('title'=>'password', 'validation'=>array('required'=>true, 'type'=>'any')),
							'cpassword'=>array('title'=>'confirm password', 'validation'=>array('required'=>true, 'type'=>'any')),
							'name'=>array('title'=>'name', 'validation'=>array('required'=>true, 'type'=>'any')),
							
					),
			));

			if($result['error']){
				$msg = $result['errorMessage'];
				$msgType = 'danger';
				$this->_view->errorField = $result['errorField'];
			}else{
				$model = new Register();
				if($model->isEmailExist($this->_view->emailid)){
					$msg = 'Entered Email Id Is Already Registered.';
					$msgType = 'danger';
					$this->_view->errorField = 'emailid';
				}
				else{
					if(isset($this->_view->bday)){
						$bday=date("Y-m-d",strtotime($this->_view->bday));
					}
					$act_id= HashUtil::getHash();

                    $image = "";
                    if($this->_view->gender == "Male" ){
                        $image = CConfig::get('gender.Male');
                    } else {
                        $image = CConfig::get('gender.Female');

                    }
                    $r = $model->saveUser($this->_view->name, $this->_view->emailid , $this->_view->gender, $bday,null,null,
							$this->_view->google,$this->_view->google,$this->_view->facebook,$this->_view->twitter,$image,
							md5($this->_view->password),$act_id);
							
                    if($r){
						$msg = 'Registered Sucessfully! Email link has been sent to your email.Please verify Email.';
						$msgType = 'success';
						EmailUtil::sendVerificationMail($this->_view->emailid, CConfig::get('baseurl').'index/verify?email='.$this->_view->emailid.'&hash='.$act_id);
						CHttpSession::init()->setFlash('loggedstate', $msg);
                        			$this->redirect('index/index');
					}else{
						$msg = 'Wrong Detail Please re-enter.';
						$msgType = 'danger';
					}
				}
			}
				
			if(!empty($msg)){
				$this->_view->actionMessage = CWidget::create('CMessage', array($msgType, $msg));
			}
		}else {
			$this->_view->actionMessage = CWidget::create('CMessage', array('danger', 'There is some error in registration.'));
		}
		$this->_view->render('signup/index');


	}



}