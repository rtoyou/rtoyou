<?php
class ContactController extends CController
{
	public function __construct() {
		parent::__construct();
		
		$this->_view->setMetaTags('keywords', 'apphp framework, static site, apphp');
		$this->_view->setMetaTags('description', 'This is a static web site, consists from the few pages.');
		
		$this->_view->header = '';
		$this->_view->text = '';
		$this->_view->comments = '';
		$this->_view->actionMessage = '';
		$this->_view->activeLink = '';
	}
	
	public function contactusAction(){
        $request = A::app()->getRequest();
		$name	=	$request->getPost('name');
		$email	=	$request->getPost('email');
		$message1=	$request->getPost('message');
		
		$error		=	'error';
		$message	=	'Some error occured !!!';
		$errorCode	=	100;
		$data		=	array();
		
		$result = CWidget::create('CFormValidation', array(
				'fields'=>array(
					'message'=>array('title'=>'Message', 'validation'=>array('required'=>true, 'type'=>'any', 'maxLength'=>1500)),
					'email'=>array('title'=>'Email', 'validation'=>array('required'=>true, 'type'=>'email')),
					'name'=>array('title'=>'Name', 'validation'=>array('required'=>true)),
				),
		));
		
		if($result['error']){
			$message = $result['errorMessage'];
		}else{
			$model	=	new Contact();
			$data	=	$model->saveContactMessage($name, $email, $message1,$_SERVER['REMOTE_ADDR']);
			if($data){
				$error		=	'success';
				$errorCode	=	0;
				$message	=	'Thank You for sharing your message with Us. We\'d love to solve your queries.';
			} else {
				$errorCode	=	104;
				$message	=	'OOPS !! We Missed something in our side.';
			}
		}
		echo ResponseUtil::setResponse($error,$message,$errorCode,$data,'json');
		exit;
		
	}
}
