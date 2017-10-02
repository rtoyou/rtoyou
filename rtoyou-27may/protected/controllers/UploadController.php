<?php
class UploadController extends CController
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
		$fileArray = $_FILES['images'];
		$fileArrayNew = array('size'=>($fileArray['size'][0]/(1000*1000)),'tmp_name'=>$fileArray['tmp_name'][0],
				'ext'=>$fileArray['type'][0],'name'=>$fileArray['name'][0]);
		if($file=ImageUtil::uploadImage($fileArrayNew)){
			if(!is_numeric($file) && $file) {
				echo json_encode(array('success'=>true,'file'=>$file));
			} else {
				$message = ($file == 1 ) ? 'Image FOrmat not supported' : 'Unknown Error';
				echo json_encode(array('error'=>$message,'message'=>$message));
			}
		}else {
			echo json_encode(array('error'=>'Unknown Error','message'=>'Unknown Error'));
		}
	}

	public function profileAction(){

		if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];

			$fileArrayNew = array('size'=>($size/(1000*1000)),'tmp_name'=>$_FILES['photoimg']['tmp_name'],
					'ext'=>$_FILES['photoimg']['type'],'name'=>$_FILES['photoimg']['name']);

				
			if($file=ImageUtil::uploadImage($fileArrayNew,true)){
				if(!is_numeric($file) && $file) {
					$pic=new Profile();
					$ret=$pic->updatePicture(CAuth::getLoggedId(), $file);
					if($ret){
LoginUtil::setUserAvatar($file);
						echo json_encode(array('success'=>true,'file'=>$file));
					} else {
						echo json_encode(array('success'=>false,'message'=>'Unknown Error'));
					}
				} else {
					$message = ($file == 1 ) ? 'Image Format not supported' : 'Unknown Error';
					echo json_encode(array('error'=>$message,'message'=>$message));
				}
			}else {
				echo json_encode(array('error'=>'Unknown Error','message'=>'Unknown Error'));
			}
				
		} else {
			echo json_encode(array(
					"message"=>A::t('error',"no_image_upload"),
					"errorCode"=>114));
		}
	}
}