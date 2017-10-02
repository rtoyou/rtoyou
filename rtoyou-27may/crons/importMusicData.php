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

$handle = fopen("RTOData-MUSICMOVIE.csv","r");
$count = 0;

$reviews = array();
$subcat = array();
$dataInserted = false;
$music = 11;

$allUsersDb = $databaseObj->select("Select user_id from rtoyou_user_profile where user_status = 1 ");
$maxId = count($allUsersDb) - 1;

while (($fields = fgetcsv($handle, 0, ",")) !== FALSE) {
    $count++;
    if ($count == 1) {
        continue;
    }

    $subcatName = $fields[1];
    $subcatDesc = $fields[2];
    $subcatWriter = $fields[3];
    $review = $fields[4];
    $rating = $fields[5];

   
    $printed = 1;
    if(!empty($review)){
        if(is_numeric($review[0])) {
            $review = substr($review,2);
        }
        $r = explode('<br/>', wordwrap($review, 80, "<br/>", true));
        $user = array_rand($allUsersDb,1);
        $reviews[]=array('comment'=>$review,'comment_from'=>$allUsersDb[$user]['user_id'],'cat_id'=>$music,'rating'=>$rating,'status'=>1,'comment_time'=>date('Y-m-d H:i:s'),'comment_title'=>$r[0]."...");
    }

    if(empty($subcat)){
        if(!empty($subcatName)) {
            $subcat['subcat_name'] = $subcatName;
            $subcat['subcat_desc'] = $subcatDesc;
            $subcat['subcat_author'] = $subcatWriter;
            $subcat['subcat_status'] = 1;
            $subcat['category_link_id'] = $music;
            $subcat['category_seo'] = generateSeoTitle($subcatName);
            $subcat['subcat_added_time'] = date('Y-m-d H:i:s');
            $subcat['subcat_linkto'] = 0;
           // $subcat['subcat_url'] = $subcatUrl;
        }
    }

    if(empty($fields[0]) && empty($fields[1]) && empty($fields[2]) && empty($fields[3]) && empty($fields[4]) && empty($fields[5])) {

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
