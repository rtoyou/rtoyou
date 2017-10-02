<?php

class Review extends CModel
{
    public static $FAVOURITE = 1;
    public static $COOL = .5;
    public static $AVERAGE = -1;
    public static $REVIEW_LENGTH = 150;

    public function __construct()
    {
        parent::__construct();
    }

   /*
    * @Returns
    * -1 if limit exceeds if user is not logged in.
    * true on success
    * false on failure
    */
    public function addReview($category, $subcategory, $review, $images, $rating, $fromUser = null, $ip = null, $newsubcat = false)
    {
        $success = false;
        $retval = 0;

        $reviewUtilObj = new ReviewUtil($review);

        $response = $reviewUtilObj->isValidReview();

        if(!$response['success']) {
            return $response;
        }

        $this->_db->beginTransaction();
        if ($newsubcat) {
	    $catObj = new Category();
	    $subcatSeoTitle = $catObj->isSeoTitleExist($subcategory);
	    if(is_numeric($subcatSeoTitle)) {
		return false;
	    }
            $subcatid = $this->_db->insert('subcategory', array('subcat_name' => $subcategory, 'subcat_image' => '',
                'category_link_id' => $category,'category_seo'=>$subcatSeoTitle,'subcat_added_time'=>date('Y-m-d H:i:s')));
            if ($subcatid) {
                $subcategory = $subcatid;
            } else {
                $subcategory = false;
            }
        } else {
            $subcategory = $subcategory;
        }

        if ($subcategory) {
            $data = array('cat_id' => $category, 'subcat_id' => $subcategory, 'comment' => $review,'comment_title'=>ReviewUtil::getReviewShortTitle($review),
                'rating' => $rating, 'ip' => $ip, 'location' => $images, 'comment_from' => $fromUser, 'comment_time' => date('y-m-d H:i:s'));
            $result = $this->_db->insert('reviews', $data);
            if ($fromUser && $result)
                $result = $this->_db->customExec('update ' . CConfig::get('db.prefix') . 'user_profile
					set user_comments_count = user_comments_count+1 where user_id=:userid', array('userid' => $fromUser));
            if ($result) {
                !$newsubcat ? $this->addCounter($subcategory) : '';
                if ($fromUser) {
                    $success = true;
                } else {
                    $dataToip = array('user_ip' => $ip, 'user_review_count' => 1, 'last_added' => date('Y-m-d H:i:s'));
                    if ($count = $this->IPExist($ip)) {
                        if (intval($count) != CConfig::get('MAX_WITHOUT_LOGIN')) {
                            $return = $this->_db->customExec('update ' . CConfig::get('db.prefix') . 'review_by_ip
									set user_review_count = user_review_count+1 where user_ip=:ip', array('ip' => $ip));
                            $success = $return ? true : false;
                        } else {
                            $retval = -1;
                        }
                    } else {
                        $return = $this->_db->insert('review_by_ip', $dataToip);
                        $success = $return ? true : false;
                    }
                }
            }
        }
        $success ? $this->_db->commit() : $this->_db->rollBack();
        if ($retval === -1) {
            return $retval;
        }
        return $success;
    }

    /*
     * Function to check If userIp exist
    * returns count of review from ip on success
    * false on new ip
    */
    public function IPExist($ip = null)
    {
        if (!is_null($ip)) {
            $data = $this->_db->select('select count(*) as total , user_review_count as reviews from ' . CConfig::get('db.prefix') . 'review_by_ip where user_ip=:ip',
                array('ip' => $ip));
            return $data[0]['total'] ? $data[0]['reviews'] : 0;
        }
        return false;
    }

    public function addCounter($reviewid)
    {
        $return = $this->_db->customExec('update ' . CConfig::get('db.prefix') . 'subcategory
				set subcat_rtoyou_count = subcat_rtoyou_count+1 where subcat_id=:reviewid', array('reviewid' => $reviewid));
        $success = $return ? true : false;
    }

    public function setFavorite($subcategory = null, $counter = 0, $user =0 ,$ip = NULL)
    {
        $success = false;
        if($ip) {
            $present = $this->_db->select('Select count(*) as total from ' . CConfig::get('db.prefix') . 'reviews_subcataction where scatid=:scatid and uniqueid=:uid ',array('uid'=>$ip,'scatid'=>$subcategory));
            if($present[0]['total'] == 0) {
                $this->_db->insert('reviews_subcataction', array('uniqueid'=>$ip,'scatid'=>$subcategory, 'created_date' => date('Y-m-d H:i:s')));

                $return = $this->_db->customExec('update ' . CConfig::get('db.prefix') . 'subcategory
				set subcat_rtoyou_fav = subcat_rtoyou_fav + 1 where subcat_id=:subcategory', array('subcategory' => $subcategory));
                $success = $return ? true : false;

            } else {
                return false;

            }
        }
        return $success;
    }

    /**
     * Function for making review favorite , bad or cool , only once per user
     *
     * @param string $type
     * @param int $reviewId
     * @param int $userId
     * @return array|bool
     */
    public function setState($type = 'cool',$reviewId = 0,$userId = 0 ) {
        $success = false;
        if($userId) {
            $present = $this->_db->select('Select type from ' . CConfig::get('db.prefix') . 'reviews_action where uid=:uid and rid=:rid ',array('uid'=>$userId,'rid'=>$reviewId));
            if($present) {
                $type = $present[0]['type'];
                return array('success'=>false,'type'=>$type);
            } else {
                $this->_db->insert('reviews_action', array('uid' => $userId, 'rid' => $reviewId, 'type' => $type, 'created_date' => date('Y-m-d H:i:s')));
                $return = $this->_db->customExec('update ' . CConfig::get('db.prefix') . 'reviews
				set ' . $type . ' = ' . $type . ' + 1 where review_id=:rid', array('rid' => $reviewId));
                $success = $return ? true : false;
            }
        }
        return $success;
    }

    public function getReviewDetail()
    {
        $return = $this->_db->select('select subcat_name,comment,rating,review_id , user_image,user_name
				from rtoyou_reviews rr,rtoyou_subcategory rsc,rtoyou_user_profile rup
				 where rr.subcat_id = rsc.subcat_id  and rup.user_id = rr.comment_from and rsc.subcat_id=32');
        return $return;
    }

    public function getReviews($subCategorySeo = NULL, $page=1,$reviewId = 0, $userId = 0)
    {
        $limit = CConfig::get('itemperpage');

        $pages	=	PagingUtil::getPaging($count,$limit,$page,'');

	if(($reviewId != 0) || !empty($reviewId) ){
		 $result = $this->_db->select('select subcat_name,comment as review,comment_title as title ,rating,review_id , user_image as userPic ,user_name as reviewer, rr.awesome , rr.cool,rr.bad ,rup.user_name as rtoyouer ,rr.comment_time as created,rr.location 
				from rtoyou_reviews rr,rtoyou_subcategory rsc,rtoyou_user_profile rup
				 where rr.subcat_id = rsc.subcat_id  and rup.user_id = rr.comment_from and rsc.subcat_id='.$subCategorySeo.' and rr.status = 1 and rr.review_id =:rid ORDER BY comment_time DESC 
				',array('rid'=>$reviewId));

	} else {
        $result = $this->_db->select('select subcat_name,comment as review, comment_title as title ,rating,review_id , user_image as userPic ,user_name as reviewer, rr.awesome , rr.cool,rr.bad ,rup.user_name as rtoyouer ,rr.comment_time as created,rr.location 
				from rtoyou_reviews rr,rtoyou_subcategory rsc,rtoyou_user_profile rup
				 where rr.subcat_id = rsc.subcat_id  and rup.user_id = rr.comment_from and rsc.subcat_id='.$subCategorySeo.' and rr.status = 1  ORDER BY comment_time DESC 
				 LIMIT ' . $page . ' , ' . $limit . ' ');

	}

	foreach ($result as &$review) {
            $img = array();
            $review["userPic"] = SiteUtil::getUserProfileImage($review['userPic']);
            $review["time"] = TimeUtil::covertTimeToString($review['created']);
            $review['starHtml'] = SiteUtil::getStarHTML($review['rating']);
	    $review['indicator'] = (strlen($review['review']) >500) ? 1 : 0;
	    $type=0;
	    if($userId){
	    	$type = $this->getReviewStateForUser($review['review_id'],$userId);
	    	$review[$type."_sel"] = 1;
	    }
	    
            if(isset($review['location'])){
                $images = explode("||",$review['location']);
                $total = count($images);
                for($i=1;$i<=$total;$i++){
                    $img['img'.$i]=array('url'=>SiteUtil::getReviewImageUrl($images[$i-1]),'title'=>"Image ".$i);
                }
            }
            $review['images']=$img;
        }
        
        return $result;

    }


    public function getReviewStateForUser($reviewId,$userId){
    	
    	$present = $this->_db->select('Select type from ' . CConfig::get('db.prefix') . 'reviews_action where uid=:uid and rid=:rid ',array('uid'=>$userId,'rid'=>$reviewId));
    	$type = $present[0]['type'];
    	return $type;
    }

    public function getReviewAnalysisPoints($reviewInfo = null)
    {
        $reviewPoints = 0;
        if (!empty($reviewInfo)) {
            $reviewText = $reviewInfo["comment"];
            $totalCools = $reviewInfo["cool"];
            $totalAwesome = $reviewInfo["awesome"];
            $totalBad = $reviewInfo["bad"];
            $rating = $reviewInfo["rating"];

            if (strlen(trim($reviewText)) <= self::REVIEW_LENGTH) {
                $awesome = 1;
                $cool = .5;
                $bad = -1;
            } else {
                $awesome = 2;
                $cool = 1;
                $bad = -.5;
            }

            $reviewPoints = round( ((int) SiteUtil::getRatingPointsEffectNumber($rating) + $reviewPoints + ($totalAwesome * $awesome + $totalCools * $cool + $totalBad * $bad)), 2);
            $pointsOfSentimentAnalysis = self::getSentimentAnalysisPoints($reviewText);

            return ($reviewPoints + $pointsOfSentimentAnalysis);
        }

        return $reviewPoints;
    }

    /**
     * @return int
     */
    public static function getSentimentAnalysisPoints()
    {
        return 0;
    }

    public function approveComment($commentId = null, $admin = false)
    {
        if (is_null($commentId) || $admin) {
            return false;
        }
        $result = $this->_db->select("select review_id,rating,awesome,cool,bad,comment,status from  " . CConfig::get('db.prefix') . " reviews where review_id=:reviewid ", array('reviewid' => $commentId));
        if ($result) {
            $reviewPoints = $this->getReviewAnalysisPoints($result[0]);
            $return = $this->_db->customExec('update ' . CConfig::get('db.prefix') . 'reviews
				set review_points = :reviewpoints and status = 1 ', array('reviewpoints' => $reviewPoints));
            $success = $return ? true : false;
            return $success;
        }
        return false;
    }

    public function getLatestReviewOfSubcategory($subcatId = 0){
        if($subcatId == 0 ) {
            return array();
        } else {
            $return = $this->_db->select('select subcat_name,comment,rating,review_id , user_image,user_name
				from rtoyou_reviews rr,rtoyou_subcategory rsc,rtoyou_user_profile rup
				 where rr.subcat_id = rsc.subcat_id  and rup.user_id = rr.comment_from and rsc.subcat_id=:subcatid ORDER BY review_points DESC LIMIT 1',array('subcatid'=>$subcatId));
            return $return[0];
        }
    }
    public function getSubcategoryStarTrend($subcatId = 0){
	if($subcatId == 0 ) {
            return array();
        } else {
            $return = $this->_db->select('select rating,count(*) as total from  ' . CConfig::get('db.prefix') . 'reviews where subcat_id=:subcatid GROUP BY rating ',array('subcatid'=>$subcatId));
	    $star = 1;
            foreach($return as $stars) {
		$return[$stars['rating']." Stars"] = $stars['total'];
	    }
	    for($star=1;$star<=5;$star++) {
		if(!isset($return[$star." Stars"])) {
			$values['y'] = $star." Stars";
			$values['value'] = 0;
		} else {
			$values['y'] = $star." Stars";
			$values['value'] = $return[$star." Stars"];
		}
		$final[]=$values;
	    }
		return $final;
        }
	}

	public function getSubcategoryDailyReviews($subcatId = 0){
		if($subcatId == 0 ) {
		    return array();
		} else {
		    $return = $this->_db->select('select DATE_FORMAT(countdate,"%d-%m-%Y") as date , total from  ' . CConfig::get('db.prefix') . 'daily_reviews where subcat_id=:subcatid and countdate BETWEEN DATE_SUB(NOW(), INTERVAL 10 DAY) AND NOW() ORDER BY countdate DESC ',array('subcatid'=>$subcatId));
		    return $return;
		}
	}
}
