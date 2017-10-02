<?php
class PagingUtil {
	
	public static function getPaging($total,$limit,$current,$targetpath){
		if($current != null) {
			if($total > 0 && $limit >0) {
				$totalpages = ceil($total/$limit);
			} else {
				$totalpages = 0;
			}
			if($current>$totalpages) $current=$totalpages;
			$start	=	$limit*$current -$limit;
			if($start<0)	$start=0;
			
			$paging = CWidget::create('CPagination', array(
				'actionPath' => $targetpath,
				'currentPage' => $current,
				'pageSize' => $limit,
				'totalRecords' => $total,
				'linkType' => 0,
				'linkNames' => array('previous'=>'', 'next'=>''),
				'showResultsOfTotal' => false
				 ));
			return array('start'=>$start,'limit'=>$limit,'paging'=>$paging);
		}
		return array();
	}
}