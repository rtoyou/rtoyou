<?php
class CategoryController extends CController
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
	
	public function indexAction(){
		$this->_view->render('category/grid');
	}
	
	public function listAction(){
        $args = func_get_args();

        $categorySeo = $args[0];
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
		
		$model = new Category();
		$list = $model->getAllListByCategorySeoTitle($categorySeo,$page);

		$this->_view->list = $list['db'];
		$this->_view->page = $list['page'];
		
		$name = $model->getCategoryName($categorySeo);
		if(!$name) {
			$this->redirect('index/index');
		}
		$this->_view->categoryname = $name;
		
		$this->_view->render('category/grid');
	}

	public function selectionAction() {
if(CAuth::isLoggedIn()){
		$profileObj = new Profile();
		$pref = $profileObj->getUserCategoryPreferences(CAuth::getLoggedId());

		$model = new Category();
		$list = $model->get();
		
if(!empty($pref[0]["user_pref"])){
	foreach($list as $cat) {
			$category[$cat["category_id"]]=$cat;
		}
	$pref = explode(",",$pref[0]["user_pref"]);
		foreach($pref as $selection) {
			$category[$selection]['category_image'] =  SiteUtil::getCategoryImage($category[$selection]['category_seo']);
			$finallist[]=$category[$selection];
		}

		$this->_view->clist = $finallist;
} else {
$this->_view->clist = $list;

}
		
		
		$this->_view->render('category/selection');
}

else {

			CHttpSession::init()->setFlash('loggedstate', 'You have to login to view this page');
				$this->redirect('index/index?error=1');
}
	}

	public function saveselectionAction() {
		$error		=	'error';
		$message	=	'Some error occured !!!';
		$errorCode	=	100;

		if(CAuth::isLoggedIn()){
			$pref = implode(",",$_POST['order']);
			$userP = new Profile();
			$return = $userP->updateUserCategoryPreferences(CAuth::getLoggedId(),$pref);
			if($return){
				$error		=	'success';
				$errorCode	=	0;
				$message	=	'Preferences has been successfully updated.';
			} else {
				$errorCode	=	109;
				$message	=	'Error in saving prefernces updated.';
			}
        }
		echo ResponseUtil::setResponse($error,$message,$errorCode,array(),'json');
		exit;
	}
}
