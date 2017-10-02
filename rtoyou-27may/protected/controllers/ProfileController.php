<?php
class ProfileController extends CController
{
	public function __construct()
	{
		parent::__construct();
		CAuth::handleLogin();
		$this->_view->setMetaTags('title', 'Profile');
		$this->_view->setMetaTags('keywords', 'profile');
		$this->_view->setMetaTags('description', 'Personal profile page of rtoyou user.');


	}

	public function indexAction()
	
	{   
		$this->_view->emailid =CAuth::getLoggedEmail();
		
		$model=new Profile();
		$this->_view->detail =$model->getProfile($this->_view->emailid);

		$this->_view->totalReviews = $model->getTotalReviewsUsers(CAuth::getLoggedId());
		$this->_view->countries = $model->getAllCountryList();
		
		$this->_view->header = 'RtoYou - Profile';
		
		$this->_view->render('profile/index');
	}
	
	public function updateAction()
	
	{
		$this->_view->pname      = $_POST['pname'];
		$this->_view->gender     = $_POST['gender'];
		$this->_view->bday       = $_POST['bday'];
		$this->_view->about      = $_POST['about'];
		$this->_view->country    = $_POST['country'];
		$this->_view->twitter    = $_POST['twitter'];
		$this->_view->facebook   = $_POST['facebook'];
		$this->_view->instagram  = $_POST['instagram'];
		$this->_view->contact    = $_POST['contact'];
		
		$msg = '';
		$msgType = '';
		
			
		if($_POST['update'] == 'submit'){
		
			// perform login form validation
			$result = CWidget::create('CFormValidation', array(
					'fields'=>array(
							'pname'=>array('title'=>'pname', 'validation'=>array('required'=>true, 'type'=>'any')),
							//'bday'=>array('title'=>'bday', 'validation'=>array('required'=>true, 'type'=>'any')),
					),
			));
			if($result['error']){
				$msg = $result['errorMessage'];
				$msgType = 'validation';
				$this->_view->errorField = $result['errorField'];
			}else{
				$model = new Profile();
			      // var_dump($this->_view->bday);die;
			        if($this->_view->bday !== "Select DOB"){
					$bday=date("Y-m-d",strtotime($this->_view->bday));
				}

				$check=$model->updateUser($this->_view->pname, $this->_view->gender, $bday, $this->_view->about, 
						$this->_view->country, $this->_view->twitter, $this->_view->facebook, $this->_view->instagram,
						 $this->_view->contact,CAuth::getLoggedEmail());
				if($check === true){	
LoginUtil::setUserName($this->_view->pname);		
				        $msg = 'Updated Sucessfully';
						$msgType = 'success';
		//				CMailer::smtpMailer("mohit.mishra@visionwebtechnologies.com","test", "test", array('from'=>'mishramohit940@gmail.com'));
		
					}else{
						$msg = 'Wrong Detail Please re-enter.';
						$msgType = 'error';
					}
				
			}
				
			if(!empty($msg)){
				$this->_view->actionMessage = CWidget::create('CMessage', array($msgType, $msg));
			}
		}
		
		$this->_view->emailid =CAuth::getLoggedEmail();
		
		$model=new Profile();
		$this->_view->detail =$model->getProfile($this->_view->emailid);
$this->_view->totalReviews = $model->getTotalReviewsUsers(CAuth::getLoggedId());
		$this->_view->countries = $model->getAllCountryList();
		
		$this->_view->render('profile/index');
		
	}
	
	
	
}
