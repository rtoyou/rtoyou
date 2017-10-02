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
    $reviews = $databaseObj->select("select SUM(rating),count(*) as total, (SUM(rating)/count(*)) as avg  from rtoyou_reviews where subcat_id=:subcatId ",array('subcatId'=>$subcatId));
    $databaseObj->update('rtoyou_subcategory',array('averageRating'=>$reviews[0]['avg']),'subcat_id=:subcatId' ,array('subcatId'=>$subcatId));
}
