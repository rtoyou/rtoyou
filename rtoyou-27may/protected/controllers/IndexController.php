<?php


use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\GraphUser;
use Facebook\FacebookRequest;
use Abraham\TwitterOAuth\TwitterOAuth;


class IndexController extends CController
{


	public function __construct()
	{
		parent::__construct();

		$this->_view->setMetaTags('title', 'Rtoyou - A review and rating network');
		$this->_view->setMetaTags('keywords', 'rtoyou,rating,reviews');
		$this->_view->setMetaTags('description', 'RtoYou.com is an answer for all those users who want to know the pros/cons of any product in the world. This is the place where you can help others by writing the review as well as can make your decisions based on the review of others.');
	}

	public function indexAction()
	{
		$this->_view->header = 'RtoYou ';
        $model	=	new Dashboard();

        $fromUser = false;
        if(CAUTH::isLoggedIn()) {
                $fromUser =true;
                $userPreferences = CAUTH::getUserPreferences();
                $selectedCategories  = explode(",",$userPreferences);
        } else {
            $category = new Category();
            $selectedCategories = $category->get();
            shuffle($selectedCategories);

        }
        $topData = array();
        $count = 5;
        $i=0;
        $selectedCategories = array_slice($selectedCategories,0,12);
        foreach ($selectedCategories as $category) {
            if($i < $count) {
                $topData['topOne'][] = $model->getTopOneBySubcategory($category,$fromUser);
            }else{
                $topData['topFive'][] = $model->getTopFiveBySubcategory($category,$fromUser);
            }
            $i++;
        }
        $this->_view->topDetails = $topData;
		$this->_view->topReviewers = $model->getTopReviewers();
		$this->_view->newsubcat = $model->getNewSubcategory();
		$this->_view->newestComments = $model->getRecentComments();


        $this->_view->reviewOfDay  = $model->getReviewOfDay();

		$this->_view->userSays = $model->getWhatUserSays();

		$this->_view->render('index/index');
	}

	public function googleAction() {
		$client = new Google_Client();
		$client->setClientId(CConfig::get('google.CLIENT_ID'));
		$client->setClientSecret(CConfig::get('google.CLIENT_SECRET'));
		$client->setRedirectUri(CConfig::get('google.REDIRECT_URI'));
		$client->addScope("https://www.googleapis.com/auth/userinfo.email");
		$objOAuthService = new Google_Service_Oauth2($client);
		if (isset($_GET['code'])) {
			$client->authenticate($_GET['code']);
			$_SESSION['access_token'] = $client->getAccessToken();
			//$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
			//	header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
		}
			
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			$client->setAccessToken($_SESSION['access_token']);
		} else {
			$authUrl = $client->createAuthUrl();
		}
		if ($client->getAccessToken()) {
			$_SESSION['access_token'] = $client->getAccessToken();
			$token_data = $client->verifyIdToken()->getAttributes();
			$user = $objOAuthService->userinfo->get();
			$user_id              = $user['id'];
			$user_name            = filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
			$gender          	  = filter_var($user['gender'], FILTER_SANITIZE_SPECIAL_CHARS);
			$email                = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
			$profile_url          = filter_var($user['link'], FILTER_VALIDATE_URL);
			$profile_image_url    = filter_var($user['picture'], FILTER_VALIDATE_URL);
			//$personMarkup         = "$email<div><img src='$profile_image_url?sz=50'></div>";

			$loginError = true;

			$login = new Login();
			$model = new Register();

			if(!$model->isEmailExist($email)) {
				if($model->isGoogleUserExist($user_id)){
					$saveUser = false;
					$data = $login->getUserByGoogle($user_id, $email);
					if($data) $loginError = false;
				} else {
					$imageName = ImageUtil::download($profile_image_url);
					if(!$imageName) $imageName = CConfig::get('profile.'.$gender);
					$return = $model->saveUser($user_name,$email,$gender,$dob,null,$user_id,$profile_url,null,null,
							null,$imageName);
					if($return) {
						$data = $login->getUserByGoogle($user_id, $email);
						if($data){
							$loginError = false;
						} 
					}
				}
			} else {
				$data = $login->getUserByEmail($email);
				if($data) $loginError = false;
			}
			if($loginError) {
				$this->redirect('index/index?error=1');
			} else {
				LoginUtil::setSession($data);
				if(isset($_COOKIE['participate']) && isset($_COOKIE['cid']) && $_COOKIE['participate'] == 1 ){
					//CHttpSession::init()->setFlash('loggedstate', 'you have successfully participated in contest.');
					$this->redirect('contest/participate');
				} else {
					CHttpSession::init()->setFlash('loggedstate', 'you have successfully logged In.');
				}
				$this->redirect('index/index');
			}

		}
		//$this->_view->render('index/google');
	}

	public function facebookAction(){
		FacebookSession::setDefaultApplication(CConfig::get('facebook.APP_ID'),CConfig::get('facebook.APP_SECRET'));
		$helper = new FacebookRedirectLoginHelper(CConfig::get('facebook.REDIRECT_URI'));
		try{
			$session= $helper->getSessionFromRedirect();
		}catch( FacebookRequestException $ex ) {
		  	$this->redirect('index/index?error=100');
			CHttpSession::init()->setFlash('loggedstate', 'There are some error occurs with facebook login.');
		} catch( Exception $ex ) {
			 $this->redirect('index/index?error=100');
			CHttpSession::init()->setFlash('loggedstate', 'There are some error occurs with facebook login.');
		}
		if(isset($session)){
			$request = new FacebookRequest( $session, 'GET', '/me' );
  			//$response = $request->execute();
            $me = $request->execute()->getGraphObject(GraphUser::className());

            $name = $me->getName();
            $facebookid = $me->getID();
            $email = $me->getEmail();
            $gender = $me->getGender();
            $facebooklink = $me->getLink();
            $dob = $me->getBirthday();
            //$pic = $me->getPicture();
$loginError = true;
            if(!is_null($dob)) $dob = $dob->format('Y-m-d H:i:s');
			/* ---- Session Variables -----*/

			$_SESSION['FBID'] = $facebookid;
			$_SESSION['FULLNAME'] = $name;
			$_SESSION['EMAIL'] =  $email;

            $login = new Login();
            $model = new Register();
            //if(!is_null($email)) {
                if (!$model->isEmailExist($email)) {
                    if ($model->isFacebookUserExist($facebookid)) {
                        $saveUser = false;
                        $data = $login->getUserByFacebook($facebookid, $email);
                        if ($data) $loginError = false;
                    } else {
                        $imageName = ImageUtil::download("https://graph.facebook.com/$facebookid/picture?type=large");
                        if (!$imageName) $imageName = CConfig::get('profile.' . $gender);

                        if (!$imageName) $imageName = CConfig::get('profile.' . $gender);
                        $return = $model->saveUser($name, $email, $gender, $dob, $facebookid, null, null, $facebooklink, null,
                            null, $imageName);
                        if ($return) {
                            $data = $login->getUserByFacebook($facebookid, $email);

                            if ($data) {
                                $loginError = false;
                                LoginUtil::setSession($data);
                            }
                        }
                    }
                } else {
                    $data = $login->getUserByEmail($email);
                    if ($data) {
                        $loginError = false;
                    } else {
                        $loginError = true;
                    }
                }
            //} else{
              //  $loginError = true;
            //}
            if($loginError) {
                CHttpSession::init()->setFlash('loggedstate', 'There are some error occurs with facebook login.');
                $this->redirect('index/index?error=1');
            } else {
                LoginUtil::setSession($data);
		
		//check for this user is come to participate or not
		if(isset($_COOKIE['participate']) && isset($_COOKIE['cid']) && $_COOKIE['participate'] == 1 ){
			//CHttpSession::init()->setFlash('loggedstate', 'you have successfully participated in contest.');
			$this->redirect('contest/participate');
		} else {
                	CHttpSession::init()->setFlash('loggedstate', 'you have successfully logged In.');
		}
                $this->redirect('index/index');
            }
		} else {
			$loginUrl =  $helper->getLoginUrl(array('public_profile,user_birthday,user_about_me,user_photos,email'));
		    header("Location: ".$loginUrl);
		}

	}

	public function loginAction(){

		$request = new CHttpRequest();
		$email = $request->getPost('email');
		$password = $request->getPost('password');
			
		$login = new Login();

		if($data = $login->login($email, $password)) {
			LoginUtil::setSession($data);
			//check for this user is come to participate or not
			if(isset($_COOKIE['participate']) && isset($_COOKIE['cid']) && $_COOKIE['participate'] == 1 ){
				//CHttpSession::init()->setFlash('loggedstate', 'you have successfully participated in contest.');
				$this->redirect('contest/participate');
			} else {
		        	CHttpSession::init()->setFlash('loggedstate', 'you have successfully logged In.');
			}
			$this->redirect('index/index');
		} else {
			CHttpSession::init()->setFlash('loggedstate', 'Please re-check your credentials.');
			$this->redirect('index/index?error=1');
		}
	}

	public function logoutAction(){
		$session = CHttpSession::init();
		foreach ($_SESSION as $k=>$v) unset($_SESSION[$k]);
			
		$session->setFlash('loggedstate', 'you have successfully logout.');
		$this->redirect('index/index');
	}

	public function verifyAction(){
		$email	=	$_GET['email'];
		$hash	=	$_GET['hash'];

		if(isset($email) && isset($hash)) {
			$model	=	new Register();
			if($model->verifyEmail($email,$hash)){
				$login = new Login();
				$data = $login->getUserByEmail($email);
				LoginUtil::setSession($data);
				
				if(isset($_COOKIE['participate']) && isset($_COOKIE['cid']) && $_COOKIE['participate'] == 1 ){
					//CHttpSession::init()->setFlash('loggedstate', 'you have successfully participated in contest.');
					$this->redirect('contest/participate');
				} else {
					CHttpSession::init()->setFlash('loggedstate', 'your email has been successfully verified.');

				}

				$this->redirect('index/index');
			} else {
				CHttpSession::init()->setFlash('loggedstate', 'Email could not be verifed.');
				$this->redirect('index/index?error=1');
			}
		} else {
			CHttpSession::init()->setFlash('loggedstate', 'Missing email or verification hash.Please click on link again.');
			$this->redirect('index/index?error=1');
		}
		$this->_view->render('index/index');
	}

	public function forgotAction(){
		$error		=	'error';
		$message	=	'Some error occured !!!';
		$errorCode	=	100;
		$data		=	array();

		$email	=	$_POST['email'];
		if(isset($email) && CValidator::isEmail($email)) {
			$hash	=	HashUtil::getHash(20);
			$model	=	new Register();

			$name	=	$model->ForgotPassword($email,$hash);
			$name	?	EmailUtil::sendForgotPasswordMail($name , $email,CConfig::get('baseurl').'index/resetpass?email='.$email.'&hash='.$hash) : "";
			if($name) {
				$error	=	'success';
				$errorCode	=	0;
				$message	=	'A link has been sent to your mail to change your password';
			} else {
				$errorCode	=	112;
				$message	=	'Email Id not registered with us.';
			}
		} else {
			$message	=	"Please enter a valid email.";
		}
		echo ResponseUtil::setResponse($error,$message,$errorCode,$data,'json');
		exit;
	}

	public function resetpassAction(){

		$email	=	$_GET['email'];
		$hash	=	$_GET['hash'];
		$session	=	CHttpSession::init();

		if(isset($_POST) && !empty($_POST)) {
			if($session->isExists('resetpass_email')){
				$password	=	$_POST['newpassword'];
				$cnfpass	=	$_POST['confirmpassword'];

				$reg		=	new Profile();
				$passwordUpdated	=	$reg->changePwd($password,$session->get('resetpass_email'));
				if($passwordUpdated) {
					CHttpSession::init()->setFlash('loggedstate', 'Your password has been successfully changed.');
					$session->remove('resetpass_email');
					$this->redirect('index/index');
				} else {
					CHttpSession::init()->setFlash('loggedstate', 'Some error in changing your password.');
					$this->_view->render('index/resetpass');
				}
			} else {
				CHttpSession::init()->setFlash('loggedstate', 'There is some error to reset your password.');
				$this->redirect('index/index?error=1');
			}
		} else {
			if(isset($email) && CValidator::isEmail($email) && isset($hash)) {
				$model	=	new Register();
				$valid	=	$model->isValidResetPasswordLink($email,$hash);
				if($valid) {
					$session->set('resetpass_email', $email);
					$this->_view->render('index/resetpass');
				} else {
					CHttpSession::init()->setFlash('loggedstate', 'Reset Password link is not a valid link.');
					$this->redirect('index/index?error=1');
				}
			} else {
				CHttpSession::init()->setFlash('loggedstate', 'Email or password hash is missing.');
				$this->redirect('index/index?error=1');
			}
		}
	}

	public function twitterAction(){
		
		define('TWEET_LIMIT', 5);
		define('TWITTER_USERNAME', 'rtoyoutweets');
		define('CONSUMER_KEY', 'mhJtYh8yn7CGweVRMRrHON9fw');
		define('CONSUMER_SECRET', 'yUOlLwGRmR9gmMO4DcUlSCHEkLuHauloBaOAbObhgAGuAW3t0P');
		define('ACCESS_TOKEN', '135550323-rDwOIwagub3gXJXu9AS2AL5vXDXdLIttSeVaY82u');
		define('ACCESS_TOKEN_SECRET', '9qxEUGIsVBWYhloCuTCC5xCLpQggpueyykCjOZIOgWNYq');





		$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
		# Migrate over to SSL/TLS
		$twitter->ssl_verifypeer = true;

		# Load the Tweets
		$tweets = $twitter->get('statuses/user_timeline', array('screen_name' => TWITTER_USERNAME, 'exclude_replies' => 'true', 'include_rts' => 'false', 'count' => TWEET_LIMIT));
		$result = json_encode($tweets);

		$tweets=json_decode($result,true);
		# Example output
		if(!empty($tweets)) {
			$twitter='';
			foreach($tweets as $tweet) {
				$twitter .= '<div class="list-group-item"><div class="media">
				<a href="http://twitter.com/rtoyoutweets" target="_blank"><div class="media-body">
				<p style="font-weight:100;">'.$tweet['text'].'</p>
				</div></a></div></div>';
			}
			echo '<div class="sidebar-block list-group list-group-menu list-group-striped">'.$twitter."</div>";
		}
		exit;
	}

	public function triggerAction(){

		$email	=	$_GET['email'];
		
		if(isset($email) && !empty($email)) {
			$hash = sha1(uniqid(rand()));
			$ver = sha1($hash);
			$contestId = 2;
			$contest = new Contest();
			$save = $contest->triggerEmail($email,$hash,$ver,$contestId);
			if($save){
				$msg = "click here to participate in contest.<br/>";

				// use wordwrap() if lines are longer than 70 characters
				$msg = wordwrap($msg,70);
				$Link = "<a href='http://www.rtoyou.com/80a740febb8085c43fbee79a231513aa/rtoyou-27may/participate?h=$hash&_ver=$ver&c=$contestId'>Click Here</a>";
				// send email
				mail($email,"Participate Contest",$msg.$Link);
				echo "email has been sent to ".$email;exit;
			}
		} 
		echo "error in sending email to ".$email;exit;
	}

	public function saveemailAction(){
		$error		=	'error';
		$message	=	'Some error occured !!!';
		$errorCode	=	100;
		$data		=	array();

			
		if(CAuth::isLoggedIn()){
			$email	=	$_POST['email'];
			if(isset($email) && CValidator::isEmail($email)) {
				$model = new Register();
				if(!$model->isEmailExist($email)){
					$act_id= HashUtil::getHash(20);
					$profileObj = new Profile();
					$success = $profileObj->saveEmailAddress(CAuth::getLoggedId(),$email,$act_id);
			
					if($success){
						EmailUtil::sendVerificationMail($this->_view->emailid,
										 CConfig::get('baseurl').'index/verify?email='.$email .'&hash='.$act_id);
						A::app()->getSession()->set('loggedEmail',$email);
						$error	=	'success';
						$errorCode	=	0;
						$message	=	'Email address has been added to your profile.Verification link has been sent to your email.'; 
					} else {
						$errorCode	=	112;
						$message	=	'There is some error to send verification link.Please try again.';
					}
				} else {
					$message	=	'Email id already exist to some other account.';
				}
			} else {
				$message	=	"Please enter a valid email.";
			}
			
		} else {
			$message ="You have to login to add email address to your account.";
		}
		echo ResponseUtil::setResponse($error,$message,$errorCode,$data,'json');
		exit;	
	}

	public function checkAction(){
		$error		=	'error';
		$message	=	'Some error occured !!!';
		$errorCode	=	100;
		$data		=	array();

		$email	=	$_POST['email'];
		if(isset($email) && CValidator::isEmail($email)) {
			$model = new Register();
			if($model->isEmailExist($email)){
				$errorCode	=	115;
				$message = 'Entered Email Id Is Already Registered.';
				
			} else {
				$error	=	'success';
				$errorCode	=	0;
				$message	=	'Email is valid.';
			}

			
		} else {
			$message	=	"Please enter a valid email.";
		}
		echo ResponseUtil::setResponse($error,$message,$errorCode,$data,'json');
		exit;
	}
}
