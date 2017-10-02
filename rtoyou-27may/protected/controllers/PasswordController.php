<?php
class PasswordController extends CController
{
	public function __construct()
	{
		parent::__construct();


		$this->_view->setMetaTags('title', 'Sample application - Static Site : Index');
		$this->_view->setMetaTags('keywords', 'apphp framework, static site, apphp');
		$this->_view->setMetaTags('description', 'This is a static web site, consists from the few pages.');


	}

	public function indexAction()

	{
			
		$this->_view->render('password/index');
	}

	public function changepwdAction()

	{
		$this->_view->oldpassword   = $_POST['oldpassword'];
		$this->_view->password   = $_POST['password'];
		$this->_view->cpassword  = $_POST['cpassword'];
		$msg = '';
		$msgType = '';

			
		if($_POST['change'] == 'submit'){
			$result = CWidget::create('CFormValidation', array(
					'fields'=>array(
							'oldpassword'=>array('title'=>'oldpassword', 'validation'=>array('required'=>true, 'type'=>'any')),
							'password'=>array('title'=>'password', 'validation'=>array('required'=>true, 'type'=>'any')),
							'cpassword'=>array('title'=>'cpassword', 'validation'=>array('required'=>true, 'type'=>'any')),
								
					),
			));

			if($result['error']){
				$msg = $result['errorMessage'];
				$msgType = 'danger';
				$this->_view->errorField = $result['errorField'];
			}else{
				$model = new Profile();
				if($model->ispasswordExist($this->_view->oldpassword,CAuth::getLoggedEmail())){
					$changed = $model->changePwd($this->_view->password,CAuth::getLoggedEmail());
					if($this->_view->password === $this->_view->oldpassword ) {
						$msg = 'New password can not be same as your last password.';
						$msgType = 'danger';
					}else if($changed){
						$msg = 'Password Changed Sucessfully';
						$msgType = 'success';

						CHttpSession::init()->setFlash('loggedstate', $msg);
						$this->redirect('index/index');

					}else{
						$msg = 'Wrong Detail Please re-enter.';
						$msgType = 'danger';
					}

				}
				else{
						
					$msg = 'Entered Old Password Is Not Correct';
					$msgType = 'danger';
					$this->_view->errorField = 'oldpassword';
				}


			}
				
			if(!empty($msg)){
				$this->_view->actionMessage = CWidget::create('CMessage', array($msgType, $msg));
			}
		}
		$this->_view->render('password/index');


	}




}
