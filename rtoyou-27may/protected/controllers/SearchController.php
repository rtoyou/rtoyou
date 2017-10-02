<?php
class SearchController extends CController
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
	
	public function globalAction(){
		$model = new Dashboard();
		$data = $model->getSearchResults($_GET['q'],$_GET['cat']);
		echo json_encode($data);exit;
		
	}
}