<?php
/**
 * Created by PhpStorm.
 * User: prashant
 * Date: 22/10/16
 * Time: 3:56 PM
 */

class MetaUtil
{
    public static $view;

    public static function setMetaTagsDetailPage($viewObj=NULL,$detail = array()){
        self::$view = $viewObj;

        self::$view->setMetaTags('keywords',$detail['subcat_name']);
        self::$view->setMetaTags('description', $detail['subcat_desc']);

        self::$view->setMetaTags('og:title', $detail['subcat_name']);
        self::$view->setMetaTags('og:description', $detail['subcat_desc']);
        self::$view->setMetaTags('og:image', SiteUtil::getSubcategoryImage($detail['subcat_image']));
        return;
    }
}