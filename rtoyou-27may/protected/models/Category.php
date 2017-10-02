<?php

class Category extends CModel
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get()
	{
		//$this->_db->cacheOn();
		$result = $this->_db->select('select cat_id as category_id,cat_name as category_name,cat_icon as category_icon,category_seo as category_seo
				from '.CConfig::get('db.prefix').'category where cat_status = 1 Order by display_order ASC ');
		return $result;
	}

	public function listAllFromCategory($query,$category){
		$result = $this->_db->select('select subcat_id as category_id,subcat_name as category_name,
				subcat_image as category_icon from '.CConfig::get('db.prefix').'subcategory where subcat_name
				LIKE "'.$query.'%" and category_link_id = '.$category.' ');
		return $result;
	}

	public function getAllListByCategorySeoTitle($categorySeo,$page){
	    $limit=CConfig::get('itemperpage');
		$result = $this->_db->select('select count(*) as total from '.CConfig::get('db.prefix').'subcategory scat , '.CConfig::get('db.prefix').'category  cat
				where scat.category_link_id = cat.cat_id and cat.category_seo =:category_seo  and subcat_status = 1 '
				,array('category_seo'=>$categorySeo));
        $total = $result[0]['total'];
		if($result[0]['total']){
			$pages	=	PagingUtil::getPaging($result[0]['total'],$limit,$page,$categorySeo);
				
			$result = $this->_db->select('select subcat_rtoyou_fav as favorite ,subcat_id,subcat_name,scat.category_seo ,subcat_image,subcat_rtoyou_count as comments , cat.cat_name as
					category_name, cat.category_seo as catSeo, averageRating as avg from '.CConfig::get('db.prefix').'subcategory scat , '.CConfig::get('db.prefix').'category  cat
					where scat.category_link_id = cat.cat_id and cat.category_seo =:category_seo and subcat_status = 1
					LIMIT '.$pages['start'].' , '.$limit.' '
					,array('category_seo'=>$categorySeo));
            foreach ($result as &$key) {
                $key['url'] =  SiteUtil::getSubCategoryUrl($key);
            }

		}
		return $total ? array('db'=>$result,'page'=>$pages['paging']) :false;
	}

	public function getCategoryName($id){
		$result = $this->_db->select('select cat_name as category_name
				from  '.CConfig::get('db.prefix').'category  where category_seo =:category_seo  and cat_status = 1 '
				,array('category_seo'=>$id));
		return $result[0]['category_name'];
	}

    public function getCategorySeoTitle($id){
        $result = $this->_db->select('select category_seo 
				from  '.CConfig::get('db.prefix').'category  where cat_id =:cat_id  and cat_status = 1 '
            ,array('cat_id'=>$id));
        return $result[0]['category_seo'];
    }

	public function isSeoTitleExist($seoTitle = '') {
		$seo = SiteUtil::generateSeoTitle($seoTitle);
		$result = $this->_db->select('select subcat_id from  '.CConfig::get('db.prefix').'subcategory  where category_seo =:category_seo'
			,array('category_seo'=>$seo));
		if(count($result) > 1) {
			return $result[0]['subcat_id'];
		} else {
			return $seo;
		}
		
	}

	public function getSubcategoryBySeoTitle($seoTitle = '') {
        $result = $this->_db->select('select *	from '.CConfig::get('db.prefix').'subcategory where subcat_status = 1  and category_seo = :seo',array('seo'=>$seoTitle));
        return $result;
    }
}
