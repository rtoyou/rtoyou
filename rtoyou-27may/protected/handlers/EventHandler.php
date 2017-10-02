<?php
require_once('libsse.php');

class EventHandler extends SSEEvent
{
	public function update(){
		$model=new Review();
		return json_encode($model->getReviewDetail());
	}
}