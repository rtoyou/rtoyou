<?php

class DetailController extends CController
{
    
	public function __construct()
	{
        parent::__construct();
		
    }
	
	public function indexAction($seoTitle=array())
	{
	     $detailObj = new Category();

         $detail = $detailObj->getSubcategoryBySeoTitle($seoTitle);
         if(!$detail) {
            SiteUtil::redirect404();
            exit;
         }
         $this->_view->categoryInfo = $detail[0];
	 $this->_view->contactInfoAvailable =  ReviewUtil::isContactAvailable($this->_view->categoryInfo);
         MetaUtil::setMetaTagsDetailPage($this->_view,$this->_view->categoryInfo);

         $this->_view->render('detail/index');
    }

	public function errorAction()
	{
        $this->_view->header = 'Error 404';
        $this->_view->text = CDebug::getMessage('errors', 'action').'<br>Please check carefully the URL you\'ve typed.';		
        $this->_view->render('error/index');        
    }
    
	public function listAction()
	{
		$this->_view->render('detail/grid');		
    }

    public function photosAction()
    {
        $this->_view->render('detail/photo');
    }

   	public function gridAction()
	{
       
        $this->_view->render('post/grid');		
    }


	public function photojsonAction() {
		$array = array(
			array(
				'height'=>440,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg',
				'caption'=>'on the way top'
			),
		array(
				'height'=>330,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg',
'caption'=>'on the way top'
			),
		array(
				'height'=>220,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg',
'caption'=>'on the way top'
			),
		array(
				'height'=>440,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg'
			),array(
				'height'=>220,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg'
			),array(
				'height'=>110,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg'
			),
		array(
				'height'=>220,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg'
			),
		array(
				'height'=>330,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg'
			),
		array(
				'height'=>110,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg'
			),array(
				'height'=>330,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg'
			),array(
				'height'=>110,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg'
			),
		array(
				'height'=>220,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg'
			),
		array(
				'height'=>440,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg'
			),
		array(
				'height'=>110,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg'
			),array(
				'height'=>3300,
				'width'=>200,
				'img' => 'templates/default/images/400/young-couple-in-love.jpg'
			));
		echo ResponseUtil::setResponse('success','Reviews for ',0,$array,'json');
	}
	
}
