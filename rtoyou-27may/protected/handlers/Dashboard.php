<?php

class Dashboard extends CModel
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getSearchResults($key,$category=null){
		$prefix	=	CConfig::get('db.prefix');
		if(strlen($key) == 0) return false;
		
		$category = ( is_null($category) || $category != -1 ) ? $category : false;
		$result = $this->_db->select("select subcat_id,subcat_name , cat_name, rc.category_seo, subcat_image as category_icon ,rsc.category_seo as subcategory_seo
				from ".$prefix."subcategory rsc ,".$prefix."category rc
				where subcat_name LIKE '%".$key."%' and rc.cat_id = rsc.category_link_id
				".($category ? " and rc.cat_id = $category" : " ")."
				");
		return $result;
	}

	public function getTopFiveBySubcategory($category = array(),$fromUser = false ,$top = 5){
	    if($fromUser) {
	        $categoryObj = new Category();
            $catSeo =  $categoryObj->getCategorySeoTitle($category);
        } else {
            $catSeo = $category['category_seo'];
        }
        $result = $this->_db->select('select subcat_rtoyou_fav as favorite ,subcat_id,subcat_name,subcat_image,subcat_rtoyou_count as comments ,scat.category_seo , cat.cat_icon, cat.category_seo as catSeo,
				cat.cat_name as	category_name, scat.averageRating as avg from '.CConfig::get('db.prefix').'subcategory scat , '.CConfig::get('db.prefix').'category  cat
				where scat.category_link_id = cat.cat_id and cat.category_seo = :catSeo  and subcat_status = 1 ORDER BY scat.totalPoints DESC 
				LIMIT 0 , '.$top.' '
       ,array('catSeo'=>$catSeo) );

        $reviewObj = new Review();
        foreach ($result as &$key) {
            $key['url'] =  SiteUtil::getSubCategoryUrl($key);
            $key['review'] = $reviewObj->getLatestReviewOfSubcategory($key['subcat_id']);
        }
        return $result;
    }

    public function getTopOneBySubcategory($category = array(),$fromUser = false){
        if($fromUser) {
            $categoryObj = new Category();
            $catSeo =  $categoryObj->getCategorySeoTitle($category);
        } else {
            $catSeo = $category['category_seo'];
        }
        $result = $this->_db->select('select subcat_rtoyou_fav as favorite ,subcat_id,subcat_name,subcat_image,subcat_rtoyou_count as comments ,scat.category_seo , cat.cat_icon,  cat.category_seo as catSeo,
				cat.cat_name as	category_name, scat.averageRating as avg from '.CConfig::get('db.prefix').'subcategory scat , '.CConfig::get('db.prefix').'category  cat
				where scat.category_link_id = cat.cat_id and cat.category_seo = :catSeo  and subcat_status = 1 ORDER BY scat.totalPoints DESC 
				LIMIT 0 , 1 '
            ,array('catSeo'=>$catSeo) );

        $reviewObj = new Review();
        foreach ($result as &$key) {
            $key['url'] =  SiteUtil::getSubCategoryUrl($key);
            $key['review'] = $reviewObj->getLatestReviewOfSubcategory($key['subcat_id']);
        }
        return $result;
    }


	/*public function getTopHotels($top=5)
	{
		$result = $this->_db->select('select subcat_rtoyou_fav as favorite ,subcat_id,subcat_name,subcat_image,subcat_rtoyou_count as comments ,scat.category_seo , cat.category_seo as catSeo,
				cat.cat_name as	category_name, scat.averageRating as avg from '.CConfig::get('db.prefix').'subcategory scat , '.CConfig::get('db.prefix').'category  cat
				where scat.category_link_id = cat.cat_id and category_link_id = 1  and subcat_status = 1
				LIMIT 0 , '.$top.' '
		);
        foreach ($result as &$key) {
            $key['url'] =  SiteUtil::getSubCategoryUrl($key);
        }
		return $result;
	}
	
	public function getTopMovies($top=6) {
		$result = $this->_db->select('select subcat_rtoyou_fav as favorite ,subcat_id,subcat_name,subcat_image,subcat_rtoyou_count as comments ,scat.category_seo , cat.category_seo as catSeo,
				cat.cat_name as	category_name , scat.averageRating as avg  from '.CConfig::get('db.prefix').'subcategory scat , '.CConfig::get('db.prefix').'category  cat
				where scat.category_link_id = cat.cat_id and category_link_id = 11  and subcat_status = 1
				LIMIT 0 , '.$top.' '
		);
		return $result;
	}

	public function getTopHolidays($top=6) {
		$result = $this->_db->select('select subcat_rtoyou_fav as favorite ,subcat_id,subcat_name,subcat_image,subcat_rtoyou_count as comments ,scat.category_seo , cat.category_seo as catSeo,
				cat.cat_name as	category_name, scat.averageRating as avg  from '.CConfig::get('db.prefix').'subcategory scat , '.CConfig::get('db.prefix').'category  cat
				where scat.category_link_id = cat.cat_id and category_link_id = 2  and subcat_status = 1
				LIMIT 0 , '.$top.' '
		);
		return $result;
	}
	public function getTopHospitals($top=6) {
		$result = $this->_db->select('select subcat_rtoyou_fav as favorite ,subcat_id,subcat_name,subcat_image,subcat_rtoyou_count as comments ,scat.category_seo , cat.category_seo as catSeo,
				cat.cat_name as	category_name, scat.averageRating as avg  from '.CConfig::get('db.prefix').'subcategory scat , '.CConfig::get('db.prefix').'category  cat
				where scat.category_link_id = cat.cat_id and category_link_id = 6 and subcat_status = 1
				LIMIT 0 , '.$top.' '
		);
		return $result;
	}
	*/
	public function getTopReviewers($limit=3){
		
		$result = $this->_db->select('select user_name as name , user_location as location , user_image as image , user_comments_count as total , cat.category_seo as catSeo ,
		created_date as fromdate, SUBSTRING(rv.comment,1,100) as review , rsc.subcat_name ,rsc.subcat_id,rsc.category_seo from '.CConfig::get('db.prefix').'user_profile rp, '.CConfig::get('db.prefix').'reviews rv , '.CConfig::get('db.prefix').'subcategory rsc,'.CConfig::get('db.prefix').'category cat where rsc.subcat_id = rv.subcat_id and cat.cat_id = rsc.category_link_id and rv.review_id = (select review_id from '.CConfig::get('db.prefix').'reviews rr where rr.comment_from = rp.user_id and rr.status = 1 ORDER BY comment_time DESC LIMIT 0,1) order by user_comments_count DESC Limit 0,'.$limit);

        foreach ($result as &$key) {
		    $key['url'] =  SiteUtil::getSubCategoryUrl($key);
		}
		return $result;
	}

    /**
     * @param int $top
     * @return mixed
     */
	public function getNewSubcategory($top=5){
		$result = $this->_db->select('select subcat_id,subcat_name,subcat_image,subcat_rtoyou_count as comments , scat.category_seo , cat.category_seo as catSeo,
				cat.cat_name as	category_name from '.CConfig::get('db.prefix').'subcategory scat , '.CConfig::get('db.prefix').'category  cat
				where scat.category_link_id = cat.cat_id and subcat_status = 1
				ORDER BY subcat_added_time DESC LIMIT 0 , '.$top.' '
		);
        foreach ($result as &$key) {
            $key['url'] =  SiteUtil::getSubCategoryUrl($key);
        }
		return $result;
	}
	
	public function getRecentComments($limit=5) {
		$result = $this->_db->select('select scat.subcat_id,subcat_name,subcat_image,subcat_rtoyou_count as comments , scat.category_seo , cat.category_seo as catSeo,
				rr.comment as review, rr.rating from '.CConfig::get('db.prefix').'subcategory scat , 
				'.CConfig::get('db.prefix').'reviews rr,
				'.CConfig::get('db.prefix').'category cat
				where scat.subcat_id = rr.subcat_id and cat.cat_id = scat.category_link_id and scat.subcat_status = 1 and rr.status = 1
				ORDER BY rr.comment_time DESC LIMIT 0 , '.$limit.' '
		);
        foreach ($result as &$key) {
            $key['url'] =  SiteUtil::getSubCategoryUrl($key);
        }
        return $result;
	}

    /**
     *
     * get review of the day on the basis of review points ,
     * if two reviews having same points the latest will be picked
     *
     * @param string $date
     * @return array of Review of day
     */
	public function getReviewOfDay($date = '' ) {
	    if(empty($date)) {
	        $date = date('Y-m-d');
        }
        $review = $this->_db->select("select r1.* ,rp.user_name , scat.subcat_name , scat.category_seo, scat.subcat_id from rtoyou_reviews r1 , ".CConfig::get('db.prefix')."user_profile rp ,".CConfig::get('db.prefix')."subcategory scat  where r1.review_points = (select MAX(review_points) 
            from rtoyou_reviews r2 where r2.status = 1 and DATE_FORMAT(r2.comment_time,'%Y-%m-%d') = :currentdate ) AND scat.subcat_id = r1.subcat_id and rp.user_id = r1.comment_from ORDER BY comment_time DESC LIMIT 1",array('currentdate'=>$date));

        if(empty($review)) {
            $date = '2016-10-25';

            $review = $this->_db->select("select r1.* ,rp.user_name , scat.subcat_name , scat.category_seo, scat.subcat_id from rtoyou_reviews r1 , ".CConfig::get('db.prefix')."user_profile rp ,".CConfig::get('db.prefix')."subcategory scat  where r1.review_points = (select MAX(review_points) 
            from rtoyou_reviews r2 where r2.status = 1 and DATE_FORMAT(r2.comment_time,'%Y-%m-%d') = :currentdate ) AND scat.subcat_id = r1.subcat_id and rp.user_id = r1.comment_from ORDER BY comment_time DESC LIMIT 1",array('currentdate'=>$date));

        }
        return $review;
    }

    /**
     * Get the latest reviews on Rtoyou Subcategory page
     *
     * @return string
     */
    public function getWhatUserSays() {
        $subcat = 79;
        $review = $this->_db->select("select comment from ".CConfig::get('db.prefix')."reviews where status=1 and subcat_id =:subcat ORDER BY comment_time DESC LIMIT 1 ",array('subcat'=>$subcat));
        if($review) {
            return SiteUtil::getFilteredComment($review[0]['comment']);
        } else{
            return '';
        }
	
    }
}
