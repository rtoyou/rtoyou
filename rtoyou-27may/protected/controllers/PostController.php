<?php

class PostController extends CController
{

	public function __construct()
	{
		parent::__construct();

        $this->_view->setMetaTags('title', 'RtoYou - Add Review on your favourites');
        $this->_view->setMetaTags('keywords', 'review , reviews , add reviews , add review , category , hotel , restraunts ');
        $this->_view->setMetaTags('description', 'This is a static web site, consists from the few pages.');

		$this->_view->header = '';
		$this->_view->text = '';
		$this->_view->comments = '';
		$this->_view->actionMessage = '';
		$this->_view->activeLink = '';
	}

	public function indexAction()
	{
		$model=new Category();
		$this->_view->category = $model->get();
		$this->_view->render('post/index');
	}

	public function errorAction()
	{
		$this->_view->header = 'Error 404';
		$this->_view->text = CDebug::getMessage('errors', 'action').'<br>Please check carefully the URL you\'ve typed.';
		$this->_view->render('error/index');
	}

	public function listAction()
	{
		$this->_view->render('post/list');
	}

	public function gridAction()
	{
			
		$this->_view->render('post/grid');
	}

	public function contactAction($act = '')
	{
		$cRequest = A::app()->getRequest();
		$this->_view->errorField = '';
		$this->_view->firstName = $cRequest->getPost('first_name');
		$this->_view->lastName = $cRequest->getPost('last_name');
		$this->_view->email = $cRequest->getPost('email');
		$this->_view->message = $cRequest->getPost('message');
		$msg = '';

		if($cRequest->getPost('act') == 'send'){

			$result = CWidget::create('CFormValidation', array(
					'fields'=>array(
							'first_name'=>array('title'=>'First Name', 'validation'=>array('required'=>true, 'type'=>'mixed')),
							'last_name' =>array('title'=>'Last Name', 'validation'=>array('required'=>true, 'type'=>'mixed')),
							'email'     =>array('title'=>'Email', 'validation'=>array('required'=>true, 'type'=>'email')),
							'message'   =>array('title'=>'Message', 'validation'=>array('required'=>true, 'type'=>'any')),
					),
			));

			if($result['error']){
				$msg = $result['errorMessage'];
				$this->_view->errorField = $result['errorField'];
			}else{
				// send email
				$body  = 'From: '.$cRequest->getPost('first_name').' '.$cRequest->getPost('last_name')."\n";
				$body .= 'Email: '.$cRequest->getPost('email')."\n";
				$body .= 'Message: '.$cRequest->getPost('message');

				CMailer::config(array('mailer'=>CConfig::get('email.mailer')));
				if(APPHP_MODE == 'demo'){
					$this->_view->actionMessage = CWidget::create('CMessage', array('warning', '<b>:(</b> Sorry, but sending emails is blocked in DEMO version!'));
				}else{
					$model = new Contact();
					$ret = $model->save($this->_view->firstName,$this->_view->lastName, $this->_view->email, $this->_view->message);
					if($ret) {
						$this->redirect('page/contact?act=success');
					}
					if(CMailer::send($this->_view->email, 'Contact Us - message', $body, array('from'=>CConfig::get('email.from')))){
						$this->redirect('page/contact?act=success');
					}else{
						if(APPHP_MODE == 'debug') $this->_view->actionMessage = CWidget::create('CMessage', array('error', CMailer::getError()));
						else $this->_view->actionMessage = CWidget::create('CMessage', array('error', 'An error occurred while sending your message! Please try again later.'));
					}
				}
			}

			if(!empty($msg)){
				$this->_view->firstName = $cRequest->getPost('first_name', 'string');
				$this->_view->lastName  = $cRequest->getPost('last_name', 'string');
				$this->_view->email     = $cRequest->getPost('email', array('string', 'email'));
				$this->_view->message   = $cRequest->getPost('message', 'string');

				$this->_view->actionMessage = CWidget::create('CMessage', array('validation', $msg));
			}
		}else if($cRequest->getQuery('act') == 'success'){
			$this->_view->actionMessage = CWidget::create('CMessage', array('success', 'Your message has been successfully sent!'));
		}

		$this->_view->header = 'Contact Us';
		$this->_view->text = '
		Etiam ornare ultricies nulla. Mauris porta, lacus et accumsan commodo, quam nisl semper arcu,
		vitae pretium nibh leo vel nibh. Phasellus eu aliquam massa. Curabitur venenatis, augue ut laoreet
		placerat, augue quam semper justo, in euismod nisl arcu in enim. Morbi tincidunt dolor a tortor
		mattis adipiscing. Mauris eros purus, sollicitudin eget porta ut, pretium vitae mi. Etiam malesuada
		feugiat orci non volutpat. Praesent eget eros blandit ante tincidunt cursus. Nullam cursus neque eu
		massa lobortis imperdiet porta nibh commodo. Cum sociis natoque penatibus et magnis dis parturient
		montes, nascetur ridiculus mus. Sed viverra congue lobortis. Donec rhoncus, leo sed posuere
		scelerisque, velit leo tempor risus, vitae dapibus sapien quam eu urna. Cras id nisl eu dui tempus
		pulvinar.';
			
		$this->_view->render('page/index');
	}

	public function listallAction (){

		$model = new Category();
		$data = $model->listAllFromCategory($_GET['q'],$_GET['cat']);
		echo json_encode($data);exit;
		echo '[
		{
		"year": "1961",
		"value": "West Side Story",
		"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
		"tokens": [
		"West",
		"Side",
		"Story"
		]
	},
	{
	"year": "1962",
	"value": "Lawrence of Arabia",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"Lawrence",
	"of",
	"Arabia"
	]
	},
	{
	"year": "1963",
	"value": "Tom Jones",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"Tom",
	"Jones"
	]
	},
	{
	"year": "1964",
	"value": "My Fair Lady",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"My",
	"Fair",
	"Lady"
	]
	},
	{
	"year": "1965",
	"value": "The Sound of Music",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"The",
	"Sound",
	"of",
	"Music"
	]
	},
	{
	"year": "1966",
	"value": "A Man for All Seasons",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"A",
	"Man",
	"for",
	"All",
	"Seasons"
	]
	},
	{
	"year": "1967",
	"value": "In the Heat of the Night",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"In",
	"the",
	"Heat",
	"of",
	"the",
	"Night"
	]
	},
	{
	"year": "1968",
	"value": "Oliver!",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"Oliver!"
	]
	},
	{
	"year": "1969",
	"value": "Midnight Cowboy",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"Midnight",
	"Cowboy"
	]
	},
	{
	"year": "1970",
	"value": "Patton",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"Patton"
	]
	},`
	{
	"year": "1971",
	"value": "The French Connection",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"The",
	"French",
	"Connection"
	]
	},
	{
	"year": "1972",
	"value": "The Godfather",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"The",
	"Godfather"
	]
	},
	{
	"year": "1973",
	"value": "The Sting",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"The",
	"Sting"
	]
	},
	{
	"year": "1974",
	"value": "The Godfather Part II",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"The",
	"Godfather",
	"Part",
	"II"
	]
	},
	{
	"year": "1975",
	"value": "One Flew over the Cuckoos Nest",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"One",
	"Flew",
	"over",
	"the",
	"Cuckoos",
	"Nest"
	]
	},
	{
	"year": "1976",
	"value": "Rocky",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"Rocky"
	]
	},
	{
	"year": "1977",
	"value": "Annie Hall",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"Annie",
	"Hall"
	]
	},
	{
	"year": "1978",
	"value": "The Deer Hunter",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"The",
	"Deer",
	"Hunter"
	]
	},
	{
	"year": "1979",
	"value": "Kramer vs. Kramer",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"Kramer",
	"vs.",
	"Kramer"
	]
	},
	{
	"year": "1980",
	"value": "Ordinary People",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"Ordinary",
	"People"
	]
	},
	{
	"year": "1981",
	"value": "Chariots of Fire",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"Chariots",
	"of",
	"Fire"
	]
	},
	{
	"year": "1982",
	"value": "Gandhi",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"Gandhi"
	]
	},
	{
	"year": "1983",
	"value": "Terms of Endearment",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"Terms",
	"of",
	"Endearment"
	]
	},
	{
	"year": "1984",
	"value": "Amadeus",
	"image":"http://icons.iconarchive.com/icons/famfamfam/flag/16/ae-icon.png",
	"tokens": [
	"Amadeus"
	]
	},
	{
	"year": "1985",
	"value": "Out of Africa",
	"tokens": [
	"Out",
	"of",
	"Africa"
	]
	},
	{
	"year": "1986",
	"value": "Platoon",
	"tokens": [
	"Platoon"
	]
	},
	{
	"year": "1987",
	"value": "The Last Emperor",
	"tokens": [
	"The",
	"Last",
	"Emperor"
	]
	},
	{
	"year": "1988",
	"value": "Rain Man",
	"tokens": [
	"Rain",
	"Man"
	]
	},
	{
	"year": "1989",
	"value": "Driving Miss Daisy",
	"tokens": [
	"Driving",
	"Miss",
	"Daisy"
	]
	},
	{
	"year": "1990",
	"value": "Dances With Wolves",
	"tokens": [
	"Dances",
	"With",
	"Wolves"
	]
	},
	{
	"year": "1991",
	"value": "The Silence of the Lambs",
	"tokens": [
	"The",
	"Silence",
	"of",
	"the",
	"Lambs"
	]
	},
	{
	"year": "1992",
	"value": "Unforgiven",
	"tokens": [
	"Unforgiven"
	]
	},
	{
	"year": "1993",
	"value": "Schindlerâ€™s List",
	"tokens": [
	"Schindlerâ€™s",
	"List"
	]
	},
	{
	"year": "1994",
	"value": "Forrest Gump",
	"tokens": [
	"Forrest",
	"Gump"
	]
	},
	{
	"year": "1995",
	"value": "Braveheart",
	"tokens": [
	"Braveheart"
	]
	},
	{
	"year": "1996",
	"value": "The English Patient",
	"tokens": [
	"The",
	"English",
	"Patient"
	]
	},
	{
	"year": "1997",
	"value": "Titanic",
	"tokens": [
	"Titanic"
	]
	},
	{
	"year": "1998",
	"value": "Shakespeare in Love",
	"tokens": [
	"Shakespeare",
	"in",
	"Love"
	]
	},
	{
	"year": "1999",
	"value": "American Beauty",
	"tokens": [
	"American",
	"Beauty"
	]
	},
	{
	"year": "2000",
	"value": "Gladiator",
	"tokens": [
	"Gladiator"
	]
	},
	{
	"year": "2001",
	"value": "A Beautiful Mind",
	"tokens": [
	"A",
	"Beautiful",
	"Mind"
	]
	},
	{
	"year": "2002",
	"value": "Chicago",
	"tokens": [
	"Chicago"
	]
	},
	{
	"year": "2003",
	"value": "The Lord of the Rings: The Return of the King",
	"tokens": [
	"The",
	"Lord",
	"of",
	"the",
	"Rings:",
	"The",
	"Return",
	"of",
	"the",
	"King"
	]
	},
	{
	"year": "2004",
	"value": "Million Dollar Baby",
	"tokens": [
	"Million",
	"Dollar",
	"Baby"
	]
	},
	{
	"year": "2005",
	"value": "Crash",
	"tokens": [
	"Crash"
	]
	},
	{
	"year": "2006",
	"value": "The Departed",
	"tokens": [
	"The",
	"Departed"
	]
	},
	{
	"year": "2007",
	"value": "No Country for Old Men",
	"tokens": [
	"No",
	"Country",
	"for",
	"Old",
	"Men"
	]
	},
	{
	"year": "2008",
	"value": "Slumdog Millionaire",
	"tokens": [
	"Slumdog",
	"Millionaire"
	]
	},
	{
	"year": "2009",
	"value": "The Hurt Locker",
	"tokens": [
	"The",
	"Hurt",
	"Locker"
	]
	},
	{
	"year": "2010",
	"value": "The Kings Speech",
	"tokens": [
	"The",
	"Kings",
	"Speech"
	]
	},
	{
	"year": "2011",
	"value": "The Artist",
	"tokens": [
	"The",
	"Artist"
	]
	},
	{
	"year": "2012",
	"value": "Argo",
	"tokens": [
	"Argo"
	]
	}
	]';
		exit;
	}

	public function reviewAction(){
		$request = CHttpRequest::init();

		if($request->isPostRequest()) {
			$category		=	$request->getPost('category');
			$subcategory	=	$request->getPost('review_on');
			$subcategoryFrom=	$request->getPost('from_Selected');
			$review			=	$request->getPost('review');
			$rating			=	$request->getPost('rating');

			$imagesMul		=	json_decode(urldecode($request->getPost('images-mul')),true);
			$category		=	$request->getPost('category');
			$ip				=	$_SERVER['REMOTE_ADDR'];

			$user			=	CAuth::isLoggedIn() ? CAuth::getLoggedId() : false;


			if(strlen($subcategoryFrom) >0  && strlen($subcategory) >0 ) {
				$newSubcat = false;
			} else if(strlen($subcategoryFrom) ==0 ){
				$newSubcat = true;
			} else {
				$newSubcat = false;
			}
			$images=false;
			if(count($imagesMul) > 0 ){
				foreach ($imagesMul as $k=>$v) $images.=$v['image']."||";
				$images = substr($images, 0,-2);
			}
			$result = CWidget::create('CFormValidation', array(
					'fields'=>array(
							'review'=>array('title'=>'Review Message', 'validation'=>array('required'=>true, 'type'=>'any', 'maxLength'=>5000)),
					),
			));
				
			if($result['error']){
				$msg = $result['errorMessage'];
				$this->_view->errorField = $result['errorField'];
				CHttpSession::init()->setFlash('Review', array('success'=>false,'message'=>$msg));
			}else{

				$model	=	new Review();
				$res	=	$model->addReview($category, $newSubcat? $subcategory : $subcategoryFrom, $review, $images,
						$rating,$user,$ip,$newSubcat);

                if(is_array($res) && !$res['success']){
                    CHttpSession::init()->setFlash('Review', array('success'=>false,'message'=>$res['message']));
                } else if($res === -1) {
					CHttpSession::init()->setFlash('Review', array('success'=>false,'message'=>'You have to login to make review.'));
				}else if($res){
					unset($_SESSION['review_text']);
					CHttpSession::init()->setFlash('Review', array('success'=>true,'message'=>'Your review has been added successfully.It will be shown once approved from our system.'));
				} else {
					$this->_view->error = true;
					CHttpSession::init()->setFlash('Review', array('success'=>false,'message'=>'OOPS !! There is some error while reviewing. Try Again'));
				}
			}
			$this->redirect('post/index');
		}else {
			$this->redirect('post/index');
		}
	}
	
	public function messageAction(){
		$request = CHttpRequest::init();
		
		$category		=	$request->getPost('category');
		$subcategory	=	$request->getPost('subcategory');
		$review			=	$request->getPost('review');
		$rating			=	$request->getPost('rating');
		$newSubcat		=	false;
		$ip				=	$_SERVER['REMOTE_ADDR'];
		$user			=	CAuth::isLoggedIn() ? CAuth::getLoggedId() : false;
		$error		=	'error';
		$message	=	'Some error occured !!!';
		$errorCode	=	100;
		$data		=	array();
		
		$result = CWidget::create('CFormValidation', array(
				'fields'=>array(
						'review'=>array('title'=>'Review Message', 'validation'=>array('required'=>true, 'type'=>'any', 'maxLength'=>5000)),
				),
		));
		
		if($result['error']){
			$message = $result['errorMessage'];
		}else{
			$model	=	new Review();
			$data	=	$model->addReview($category, $subcategory, $review, false,
					$rating,$user,$ip,$newSubcat);
			if($data === -1) {
				$errorCode=105;
				$message='You have to login to make review.';
			} else if(is_array($data) && !$data['success']){
				$errorCode	=	105;
				$message	=	$data['message'];
			}else if($data){
				$error	=	'success';
				$errorCode	=	0;
				$message	=	'Your review has been added successfully.It will be shown once approved from our system.';
			} else {
				$errorCode	=	104;
				$message	=	'OOPS !! There is some error while reviewing. Try Again';
			}
		}
		echo ResponseUtil::setResponse($error,$message,$errorCode,$data,'json');
		exit;
	}
}
