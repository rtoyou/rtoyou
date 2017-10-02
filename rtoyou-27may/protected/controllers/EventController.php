<?php

require_once('/var/www/html/rtoyou/protected/handlers/libsse.php');

class EventController extends CController
{
	public function __construct() {
		parent::__construct();
	}

	public function listenAction(){
		$sse = new SSE();
		$sse->exec_limit=10;
		$sse->sleep_time=10;
		//if(rand(0, 10) < 5) {
			//$sse->addEventListener('time',new EventHandler());
		//}else{
			$sse->addEventListener('notify',new EventHandler());
	//	}
		$sse->start();
	}
}