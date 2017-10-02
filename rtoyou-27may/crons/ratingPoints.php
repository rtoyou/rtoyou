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

$allSubcategories = $databaseObj->select("Select * from rtoyou_subcategory where subcat_status = 1 ");

foreach ($allSubcategories as $subcategory) {
    $subcatId = (int) $subcategory['subcat_id'];
    $subCatFav = (int) $subcategory['subcat_rtoyou_fav'];

    $reviews = $databaseObj->select("Select count(*) as totalReviews, SUM(review_points) as rp from rtoyou_reviews where subcat_id = :subcatId ",array('subcatId'=>$subcatId));
    $totalReviews = $reviews[0]['totalReviews'];
    $totalReviewPoints = $reviews[0]['rp'];

    if($totalReviews < 100) {
        $fav = 3;
    } else {
        $fav = 5;
    }

    $totalPoints = $totalReviews + ($fav * $subCatFav ) + $totalReviewPoints;
    $databaseObj->update('rtoyou_subcategory',array('totalPoints'=>$totalPoints),'subcat_id=:subcatId' ,array('subcatId'=>$subcatId));

}