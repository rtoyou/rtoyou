<?php

class ReviewController extends CController
{
	public function __construct()
	{
		parent::__construct();

		$this->_view->setMetaTags('title', 'RtoYou - Add Review on your favourites');
		$this->_view->setMetaTags('keywords', 'review , reviews , add reviews , add review , category , hotel , restraunts ');
		$this->_view->setMetaTags('description', 'This is a static web site, consists from the few pages.');


	}

	public function stateAction()
	{
	    $error		=	'error';
		$message	=	'Some error occured !!!';
		$errorCode	=	100;
		$data		=	array();
		$cRequest = A::app()->getRequest();

		$this->_view->reviewid = $cRequest->getPost('review');
		$this->_view->type = $cRequest->getPost('type');

		if(CAuth::isLoggedIn()){
			if(!isset($this->_view->reviewid) || !isset($this->_view->reviewid)) {

				$model = new Review();
				$data = $model->setState($this->_view->type,$this->_view->reviewid,CAuth::getLoggedId());

				if(is_array($data) && !$data['success']){
                    $message 	= 'you have already '.$data['type'].' this review.';
                    $data  = "Error";
                }else if($data) {
					$error	=	'success';
					$errorCode	=	0;
					$message	=	'successfully updated.';
				}
			} else {
				$message 	= 'Some parameters missing to perform this action!!!';
				$errorCode	=  101;
			}
		} else {
			$message = 'You have to login to perform this action';
		}
		echo ResponseUtil::setResponse($error,$message,$errorCode,$data,'json');
		exit;
	}

	public function favoriteAction()
	{
		$error		=	'error';
		$message	=	'Some error occured !!!';
		$errorCode	=	100;
		$data		=	array();
		$cRequest = A::app()->getRequest();
	
		$this->_view->subcat = $cRequest->getPost('subcat');
		$this->_view->counter = $cRequest->getPost('counter');
	
		if(CAuth::isLoggedIn()){
			if(!isset($this->_view->subcat)) {
	
				$model = new Review();
				$data = $model->setFavorite($this->_view->subcat,$this->_view->counter ,CAuth::getLoggedId(),$_SERVER['REMOTE_ADDR']);
	
				if($data) {
					$error	=	'success';
					$errorCode	=	0;
					$message	=	'successfully favorited.';
				} else {
				    $errorCode	=  101;
				    $message 	= 'you have already favourited.';
				}
			} else {
				$message 	= 'Some parameters missing to perform this action!!!';
				$errorCode	=  101;
			}
		} else {
			$message = 'You have to login to perform this action';
		}
		echo ResponseUtil::setResponse($error,$message,$errorCode,$data,'json');
		exit;
	}
	
	public function getreviewsAction(){
       		$cRequest = A::app()->getRequest();

		$offset	=	$cRequest->getPost('offset');
        $detailid	=	$cRequest->getPost('detailid');
$reviewid	=	$cRequest->getPost('reviewid');

		$userId = CAuth::getLoggedId();
        $page	=	floor($offset/10);
        $page = $page == 0 ? $page=1 : $page;

		$model	=	new Review();
		$data	=	$model->getReviews($detailid, $offset,$reviewid,$userId);

        echo ResponseUtil::setResponse('success','Reviews for ',0,$data,'json');
        exit;
	}

	public function startrendAction(){
		$cRequest	= A::app()->getRequest();
		$detailid	=$cRequest->getPost('subcat');
		$model	=	new Review();
		$data	=	$model->getSubcategoryStarTrend($detailid);

		echo ResponseUtil::setResponse('success','Star trends',0,$data,'json');
		exit;
		
	}

	public function dailyreviewsAction(){
		$cRequest	= A::app()->getRequest();
		$detailid	=$cRequest->getPost('subcat');
		
		$model	=	new Review();
		$data	=	$model->getSubcategoryDailyReviews($detailid);
		
		echo ResponseUtil::setResponse('success','Review trends',0,$data,'json');
		exit;
		
	}
}
