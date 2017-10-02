<?php 

include 'config.php';
include 'database.php';

$databaseObj = CDatabase::init($params);


$list = file_get_contents('/home/prashant/Downloads/countriesList.json',true);

$listArray = json_decode($list,true);

foreach ($listArray as $country) {
	$databaseObj->insert('rtoyou_countries',$country);
}
