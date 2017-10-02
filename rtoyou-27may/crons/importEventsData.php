<?php
/**
 * Created by PhpStorm.
 * User: prashant
 * Date: 22/10/16
 * Time: 10:01 PM
 */

defined('RTOYOU_BASE_PATH') || define('RTOYOU_BASE_PATH', dirname(dirname(__FILE__)));

include 'config.php';
include 'database.php';

$databaseObj = CDatabase::init($params);

$handle = fopen("RTO-EVENT.csv","r");
$count = 0;

$reviews = array();
$subcat = array();
$dataInserted = false;
$company = 13;

$allUsersDb = $databaseObj->select("Select user_id from rtoyou_user_profile where user_status = 1 ");
$maxId = count($allUsersDb) - 1;
$inserted = 0;

while (($fields = fgetcsv($handle, 0, ",")) !== FALSE) {
    $count++;
    if ($count == 1) {
        continue;
    }

    $subcatName = $fields[1];
    $subcatUrl = $fields[2];
    $subcatDesc = $fields[3];
    $subcatAddress = "";
    $subcatContact = "";
    $review = $fields[4];
    $rating = $fields[5];

    $images = $fields[8];

    $printed = 1;
    if(!empty($review)){
        if(is_numeric($review[0])) {
            $review = substr($review,2);
        }
        $r = wordwrap($review, 70, "\n", true);
        $user = array_rand($allUsersDb,1);
        $reviews[]=array('comment'=>$review,'comment_from'=>$allUsersDb[$user]['user_id'],'cat_id'=>$company,'rating'=>$rating,'status'=>1,'comment_time'=>date('Y-m-d H:i:s'),'comment_title'=>substr($r,0 ,strpos($r,"\n")));
    }

    if(empty($subcat)){
        if(!empty($subcatName)) {
            $subcat['subcat_name'] = $subcatName;
            $subcat['subcat_desc'] = $subcatDesc;
            $subcat['subcat_address'] = $subcatAddress;
            $subcat['subcat_contact'] = $subcatContact;
            $subcat['subcat_status'] = 1;
            $subcat['category_link_id'] = $company;
            $subcat['category_seo'] = generateSeoTitle($subcatName);
            $subcat['subcat_added_time'] = date('Y-m-d H:i:s');
            $subcat['subcat_linkto'] = 0;
            $subcat['subcat_url'] = $subcatUrl;
        }
    }

    if(empty($fields[0]) && empty($fields[1]) && empty($fields[2]) && empty($fields[3]) && empty($fields[4]) && empty($fields[5]) && empty($fields[6]) && empty($fields[7]) && empty($fields[8])) {
        if(!$dataInserted) {
            $dataInserted = true;
            $subcat['subcat_rtoyou_count'] = count($reviews);
            $a = array('category'=>$subcat,'reviews'=>$reviews);

            $subcatid = $databaseObj->insert('rtoyou_subcategory',$subcat);
            foreach ($reviews as &$reviewDb) {
                $reviewDb['subcat_id']=$subcatid;
                $rev = $databaseObj->insert('rtoyou_reviews',$reviewDb);
            }
            echo $subcat['subcat_name']." inserted \r\n";
	    $inserted++;
            $subcat = array();
            $reviews = array();
      }
      $printed++;
    } else{
        $dataInserted = false;
        continue;
    }

}
function generateSeoTitle($title='') {
    if(empty($title) ) return $title;
    $title = strtolower($title);
    $title = preg_replace("/[^a-z0-9_\s-]/", "", $title);
    $title = preg_replace("/[\s-]+/", " ", $title);
    $title = preg_replace("/[\s_]/", "-", $title);
    return $title;
}

die;
fclose($file);
