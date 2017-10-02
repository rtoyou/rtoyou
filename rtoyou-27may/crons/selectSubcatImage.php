<?php
/**
 * Created by PhpStorm.
 * User: prashant
 * Date: 2/10/16
 * Time: 4:39 PM
 */
defined('RTOYOU_BASE_PATH') || define('RTOYOU_BASE_PATH', dirname(dirname(__FILE__)));

include 'config.php';
include 'database.php';

$databaseObj = CDatabase::init($params);

$allSubcategories = $databaseObj->select("Select subcat_id from rtoyou_subcategory where subcat_status = 1");
foreach ($allSubcategories as $subcategory) {
    $subcatId = (int) $subcategory['subcat_id'];

    $reviews = $databaseObj->select("select location from rtoyou_reviews where subcat_id=:subcatId ",array('subcatId'=>$subcatId));
    $photos=array();
    foreach($reviews as $review){
	if(empty($review['location'])){
		continue;
	}
	$location = explode("||",$review['location']);
	if(count($location) == 1){
		$photos[]=$location[0];
	} else {
		foreach($location as $l) {
			$photos[]=$l;
		}
	}
	$count = count($photos);
	if($count > 20) {
		break;
	}
    }
    $subcatImage = $photos[rand(0,$count)];
    $databaseObj->update('rtoyou_subcategory',array('subcat_image'=>$subcatImage,'subcat_collage'=>implode("||",$photos)),'subcat_id=:subcatId' ,array('subcatId'=>$subcatId));
}
