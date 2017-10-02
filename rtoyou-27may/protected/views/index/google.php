<?php
session_start();
function isWebRequest()
{
	return isset($_SERVER['HTTP_USER_AGENT']);
}

function pageHeader($title)
{
	$ret = "";
	if (isWebRequest()) {
		$ret .= "<!doctype html>
		<html>
		<head>
		<title>" . $title . "</title>
		<link href='styles/style.css' rel='stylesheet' type='text/css' />
		</head>
		<body>\n";
		if ($_SERVER['PHP_SELF'] != "/index.php") {
			$ret .= "<p><a href='index.php'>Back</a></p>";
		}
		$ret .= "<header><h1>" . $title . "</h1></header>";
	}
	return $ret;
}


function pageFooter($file = null)
{
	$ret = "";
	if (isWebRequest()) {
		// Echo the code if in an example.
		if ($file) {
			$ret .= "<h3>Code:</h3>";
			$ret .= "<pre class='code'>";
			$ret .= htmlspecialchars(file_get_contents($file));
			$ret .= "</pre>";
		}
		$ret .= "</html>";
	}
	return $ret;
}

function missingApiKeyWarning()
{
	$ret = "";
	if (isWebRequest()) {
		$ret = "
		<h3 class='warn'>
		Warning: You need to set a Simple API Access key from the
		<a href='http://developers.google.com/console'>Google API console</a>
		</h3>";
	} else {
		$ret = "Warning: You need to set a Simple API Access key from the Google API console:";
		$ret .= "\nhttp://developers.google.com/console\n";
	}
	return $ret;
}

function missingClientSecretsWarning()
{
	$ret = "";
	if (isWebRequest()) {
		$ret = "
		<h3 class='warn'>
		Warning: You need to set Client ID, Client Secret and Redirect URI from the
		<a href='http://developers.google.com/console'>Google API console</a>
		</h3>";
	} else {
		$ret = "Warning: You need to set Client ID, Client Secret and Redirect URI from the";
		$ret .= " Google API console:\nhttp://developers.google.com/console\n";
	}
	return $ret;
}

function missingServiceAccountDetailsWarning()
{
	$ret = "";
	if (isWebRequest()) {
		$ret = "
		<h3 class='warn'>
		Warning: You need to set Client ID, Email address and the location of the Key from the
		<a href='http://developers.google.com/console'>Google API console</a>
		</h3>";
	} else {
		$ret = "Warning: You need to set Client ID, Email address and the location of the Key from the";
		$ret .= " Google API console:\nhttp://developers.google.com/console\n";
	}
	return $ret;
}

/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/user-example.php
 ************************************************/
 $client_id = '1022172329868-pjikki7h1v15iorqnb8laao9ch75b84o.apps.googleusercontent.com';
 $client_secret = 'Wvq9ngZgSGuLkl0R_d7Y8Hvr';
 $redirect_uri = 'http://localhost/rtoyou/index/google';

/************************************************
  Make an API request on behalf of a user. In
  this case we need to have a valid OAuth 2.0
  token for the user, so we need to send them
  through a login flow. To do this we need some
  information from our API console project.
 ************************************************/
$client = new Google_Client();
$client->setClientId(CConfig::get('google.CLIENT_ID'));
$client->setClientSecret(CConfig::get('google.CLIENT_SECRET'));
$client->setRedirectUri(CConfig::get('google.REDIRECT_URI'));
$client->addScope("https://www.googleapis.com/auth/userinfo.email");

/************************************************
  When we create the service here, we pass the
  client to it. The client then queries the service
  for the required scopes, and uses that when
  generating the authentication URL later.
 ************************************************/
$objOAuthService = new Google_Service_Oauth2($client);

/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
 ************************************************/
if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
  header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
} else {
  $authUrl = $client->createAuthUrl();
}

/************************************************
  If we're signed in we can go ahead and retrieve
  the ID token, which is part of the bundle of
  data that is exchange in the authenticate step
  - we only need to do a network call if we have
  to retrieve the Google certificate to verify it,
  and that can be cached.
 ************************************************/
if ($client->getAccessToken()) {
  $_SESSION['access_token'] = $client->getAccessToken();
  $token_data = $client->verifyIdToken()->getAttributes();
  $user = $objOAuthService->userinfo->get();
  $user_id              = $user['id'];
  $user_name            = filter_var($user['name'], FILTER_SANITIZE_SPECIAL_CHARS);
  $email                = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
  $profile_url          = filter_var($user['link'], FILTER_VALIDATE_URL);
  $profile_image_url    = filter_var($user['picture'], FILTER_VALIDATE_URL);
  $personMarkup         = "$email<div><img src='$profile_image_url?sz=50'></div>";
}

echo pageHeader("User Query - Retrieving An Id Token");
if (strpos($client_id, "googleusercontent") == false) {
  echo missingClientSecretsWarning();
  exit;
}


//HTML page start
echo '<!DOCTYPE HTML><html>';
echo '<head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
echo '<title>Login with Google</title>';
echo '</head>';
echo '<body>';
echo '<h1>Login with Google</h1>';

if(isset($authUrl)) //user is not logged in, show login button
{
    echo '<a class="login" href="'.$authUrl.'"><img src="images/google-login-button.png" /></a>';
} 
else // user logged in 
{
   /* connect to database using mysqli */
   // $mysqli = new mysqli($hostname, $db_username, $db_password, $db_name);
    
    //if ($mysqli->connect_error) {
      //  die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    //}
    
    //compare user id in our database
    //$user_exist = $mysqli->query("SELECT COUNT(google_id) as usercount FROM google_users WHERE google_id=$user_id")->fetch_object()->usercount; 
    //if($user_exist)
    //{
      //  echo 'Welcome back '.$user_name.'!';
    //}else{ 
        //user is new
        echo 'Hi '.$user_name.', Thanks for Registering!';
      //  $mysqli->query("INSERT INTO google_users (google_id, google_name, google_email, google_link, google_picture_link) 
        //VALUES ($user_id, '$user_name','$email','$profile_url','$profile_image_url')");
    //}

    
    echo '<br /><a href="'.$profile_url.'" target="_blank"><img src="'.$profile_image_url.'?sz=100" /></a>';
    echo '<a class="logout" href="?reset=1">Logout</a>';
    
    //list all user details
    echo '<pre>'; 
    print_r($user);
    echo '</pre>';  
}
 
echo '</body></html>';