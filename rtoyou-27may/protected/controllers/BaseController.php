<?php

class BaseController extends CController
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
        $this->_view->header = 'RtoYou ';
        
        $this->_view->render('index/index');		
    }
	
    public function googleAction() {
    	
    	$this->_view->render('index/google');
    }
}