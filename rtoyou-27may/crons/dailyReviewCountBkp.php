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

$allSubcategories = $databaseObj->select("SELECT * FROM `rtoyou_daily_reviews` WHERE `countdate` >= DATE_SUB(CURRENT_DATE(),INTERVAL 1 DAY)");

foreach ($allSubcategories as $subcategory) {
    $databaseObj->insert('rtoyou_daily_reviews_bkp',$subcategory);
}
$databaseObj->delete('rtoyou_daily_reviews','`countdate` >= DATE_SUB(CURRENT_DATE(),INTERVAL 1 DAY)');


$all = $databaseObj->select("Select subcat_id from rtoyou_subcategory where subcat_status = 1");
foreach($all as $v) {
    $subcatId = (int) $v['subcat_id'];
    $reviews = $databaseObj->select("Select count(*) as totalReviews from rtoyou_reviews where subcat_id = :subcatId ",array('subcatId'=>$subcatId));
    $totalReviews = $reviews[0]['totalReviews'];

    $databaseObj->insert('rtoyou_daily_reviews',array('countdate'=>date('Y-m-d H:i:s'),'total'=> $reviews,'subcat_id'=>$subcatId));
}

