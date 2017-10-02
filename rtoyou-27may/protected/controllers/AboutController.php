<?php
class AboutController extends CController
{
	public function __construct() {
		parent::__construct();
		$this->_view->setTemplate('no-sidebar');
		
		$this->_view->text = '';
		$this->_view->comments = '';
		$this->_view->actionMessage = '';
		$this->_view->activeLink = '';
	}
	
	public function indexAction(){
		$this->_view->setMetaTags('About', 'About us,about,about rtoyou,r2you,rtoyou');
		//$this->_view->setMetaTags('description', 'This is a static web site, consists from the few pages.');
		
		$this->_view->_activeClass = "about";
		$this->_view->headingTop = 'About Us';
		$this->_view->subHeading = 'We Deliver what other promise';
		
		$this->_view->render('about/index');
	}
	public function faqAction(){

		$this->_view->_activeClass = "faq";
		$this->_view->headingTop = 'Have Questions ?';
		$this->_view->subHeading = 'Faq';
		$this->_view->render('about/faq');
	}
	public function tandcAction(){
		$this->_view->_activeClass = "tandc";
		$this->_view->headingTop = 'Terms&Condition';
		$this->_view->subHeading = 'Terms&Condition';
		$this->_view->render('about/tandc');
	}
	public function contactAction(){
		$this->_view->_activeClass = "contact";
		$this->_view->headingTop = 'Contact Us';
		$this->_view->subHeading = 'We like to create things with fun, open minded people . Feel free to say Bonjour!';

		$this->_view->render('about/contact');
	}
	public function privacyAction(){
		$this->_view->_activeClass = "privacy";
		$this->_view->headingTop = 'Privacy';
		$this->_view->subHeading = 'Privacy';
		$this->_view->render('about/privacy');
	}
	public function careerAction(){
		$this->_view->_activeClass = "career";
		$this->_view->headingTop = 'Career';
		$this->_view->subHeading = 'Career';

		$this->_view->render('about/career');
	}
	
}
