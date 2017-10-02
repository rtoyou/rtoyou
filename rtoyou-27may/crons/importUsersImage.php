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

 $gender=array(
        'Male'=>'default_avatar_male.jpg',
        'Female'=>'default_avatar_female.jpg'
    );

$allUsersDb = $databaseObj->select("Select user_gender,user_id,user_image from rtoyou_user_profile where user_status = 1 ");

foreach($allUsersDb as $users){
	$image = $users['user_image'];
	if(!file_exists("/home/pacific0073/public_html/RtoyouImages/profile/".$image) || empty($image)){
		 $rev = $databaseObj->update('rtoyou_user_profile',array('user_image'=>$gender[$users['user_gender']]),'user_id='.$users['user_id']);
	}
}
