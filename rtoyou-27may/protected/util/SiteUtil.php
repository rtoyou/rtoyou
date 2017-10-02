<?php
/**
 * Created by PhpStorm.
 * User: prashant
 * Date: 1/10/16
 * Time: 4:39 PM
 */
class SiteUtil {

    public static function getRatingPointsEffectNumber($rating =1 ) {
        $meanValue = 0;
        switch ($rating) {
            case 1:
                $meanValue = -2;
            case 2:
                $meanValue = -1;
            case 3:
                $meanValue = 0;
            case 4:
                $meanValue = 1;
            case 5:
                $meanValue = 2;
            default:
                $meanValue = 0;
        }
        return $meanValue;
    }

    public static function getUserProfileImage($image) {
	 return CConfig::get('BaseUrlImage').DIRECTORY_SEPARATOR.'profile'.DIRECTORY_SEPARATOR.$image;
    }

    public static function getSubcategoryImage($image) {
	 return CConfig::get('BaseUrlImage').'posts'.DIRECTORY_SEPARATOR.$image;
    }

    public static function getReviewImageUrl($image) {
        return CConfig::get('BaseUrlImage').'posts'.DIRECTORY_SEPARATOR.$image;
    }

    public static function getStarHTML($rating,$class='text-yellow-800'){
	    $rating = (int) $rating;
        switch ($rating) {
            case '1':
                $stars = '<span class="fa fa-fw fa-star '.$class.'"></span><span class="fa fa-fw fa-star-o '.$class.'"></span><span class="fa fa-fw fa-star-o '.$class.'"></span><span class="fa fa-fw fa-star-o '.$class.'"></span><span class="fa fa-fw fa-star-o '.$class.'"></span>';
		break;
            case '2':
                $stars = '<span class="fa fa-fw fa-star '.$class.'"></span><span class="fa fa-fw fa-star '.$class.'"></span><span class="fa fa-fw fa-star-o '.$class.'"></span><span class="fa fa-fw fa-star-o '.$class.'"></span><span class="fa fa-fw fa-star-o '.$class.'"></span>';
		break;
            case '3':
                $stars = '<span class="fa fa-fw fa-star '.$class.'"></span><span class="fa fa-fw fa-star '.$class.'"></span><span class="fa fa-fw fa-star '.$class.'"></span><span class="fa fa-fw fa-star-o '.$class.'"></span><span class="fa fa-fw fa-star-o '.$class.'"></span>';
		break;
            case '4':
                $stars = '<span class="fa fa-fw fa-star '.$class.'"></span><span class="fa fa-fw fa-star '.$class.'"></span><span class="fa fa-fw fa-star '.$class.'"></span><span class="fa fa-fw fa-star '.$class.'"></span><span class="fa fa-fw fa-star-o '.$class.'"></span>';
		break;
            case '5':
                $stars = '<span class="fa fa-fw fa-star '.$class.'"></span><span class="fa fa-fw fa-star '.$class.'"></span><span class="fa fa-fw fa-star '.$class.'"></span><span class="fa fa-fw fa-star '.$class.'"></span><span class="fa fa-fw fa-star '.$class.'"></span>';
		break;

        }
        return $stars;
    }

    public static function getAboutContent($aboutDesc = '') {
	    $breakWord = 97;
        if(strlen($aboutDesc) <= $breakWord) {
            return array('count'=>1,'text'=>$aboutDesc);
        } else {
            return array('count'=>2, 'text'=>wordwrap($aboutDesc, $breakWord, "</p>", true));
        }
    }

    public static function getFilteredComment($comment,$length = 150){
        return preg_replace('/\s+?(\S+)?$/','',substr($comment,0,$length))."...";
	    //return wordwrap($comment, 10, "\n", true);
    }

    public static function getCategoryImage($categorySeo){
        $max = 0;
        $images = glob(BASE_DIR.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$categorySeo.DIRECTORY_SEPARATOR.'*.jpg');
        if ( $images !== false ){
            $max = count($images);
        }
        if($max !== 0 ) {
            return 'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$categorySeo.DIRECTORY_SEPARATOR.rand(1,$max).'.jpg';
        } else {
            return 'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'portrait-trendy-hair-style.jpg';
        }
   }
 
   public static function getCategoryImageHome($categorySeo){
        $max = 0;
        $images = glob(BASE_DIR.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$categorySeo.DIRECTORY_SEPARATOR.'orig'.DIRECTORY_SEPARATOR.'*.jpg');
        if ( $images !== false ){
            $max = count($images);
        }
        if($max !== 0 ) {
            return 'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.$categorySeo.DIRECTORY_SEPARATOR.'orig'.DIRECTORY_SEPARATOR.rand(1,$max).'.jpg';
        } else {
            return 'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.'portrait-trendy-hair-style.jpg';
        }
   }
   
   public static function generateSeoTitle($title='') {
        if(empty($title) ) return $title;
        $title = strtolower($title);
        $title = preg_replace("/[^a-z0-9_\s-]/", "", $title);
        $title = preg_replace("/[\s-]+/", " ", $title);
        $title = preg_replace("/[\s_]/", "-", $title);
        return $title;
   }

   public static function  getSubCategoryUrl($array=array()){
       if(empty($array['category_seo'])) {
             $array['category_seo']= self::generateSeoTitle($array['subcat_name']);
       }
        return $array['catSeo'].DIRECTORY_SEPARATOR.$array['category_seo'];
   }

   public static function getCategoryName($category = '') {
        $catSeo = $category['category_seo'];
        return $catSeo;

   }

   public static function getNoImage() {
         return 'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.CConfig::get('defaultImages.no-image');
   }
   public static function getSmallLoading() {
         return 'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.CConfig::get('defaultImages.loading-small');
   }
   public static function getBigLoading() {
         return 'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR.CConfig::get('defaultImages.loading-big');
   }

   public static function redirect404(){
       header('Location:'.A::app()->getRequest()->getBaseUrl().'404.html');
       exit;
   }
}
