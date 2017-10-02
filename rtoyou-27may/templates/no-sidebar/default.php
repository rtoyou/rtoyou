<!DOCTYPE html>

<html class="ls-top-navbar" 
	lang="en">

<head>


<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<meta name="keywords"
	content="<?php echo CHtml::encode($this->_pageKeywords); ?>" />
<meta name="description"
	content="<?php echo CHtml::encode($this->_pageDescription); ?>" />

<title><?php echo CHtml::encode($this->_pageTitle); ?>
</title>

<base href="<?php echo A::app()->getRequest()->getBaseUrl(); ?>" />
<link href="templates/default/css/vendor.min.css" rel="stylesheet">
<link href="templates/default/css/theme-core.min.css" rel="stylesheet">
<link href="templates/default/css/module-essentials.min.css"
	rel="stylesheet" />
<link href="templates/default/css/module-layout.min.css"
	rel="stylesheet" />
<link href="templates/default/css/module-sidebar.min.css"
	rel="stylesheet" />
<link href="templates/default/css/module-sidebar-skins.min.css"
	rel="stylesheet" />
<link href="templates/default/css/module-navbar.min.css"
	rel="stylesheet" />
<link href="templates/default/css/module-media.min.css" rel="stylesheet" />
<!-- <link href="css/module-timeline.min.css" rel="stylesheet" /> -->
<!-- <link href="css/module-cover.min.css" rel="stylesheet" /> -->
<link href="templates/default/css/module-chat.min.css" rel="stylesheet" />


<link href="templates/default/css/fileinput.min.css" rel="stylesheet" />
<link rel="stylesheet"
	href="templates/default/css/ladda-themeless.min.css">

	
	<link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/themes/south-street/jquery-ui.css" id="theme">


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
WARNING: Respond.js doesn't work if you view the page via file:// -->
<!-- If you don't need support for Internet Explorer <= 8 you can safely remove these -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->
		<script src="templates/default/js/validation.js"></script>

	<style>
.globaltypeahead,.tt-query,.tt-hint {
	width: auto;
	height: 35px;
	padding: 8px 12px;
	line-height: 30px;
	outline: none;
}

.globaltypeahead {
	background-color: #f7f7f7;
}

.globaltypeahead:focus {
	border: 1px solid #efefef;
}

.tt-query {
	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}

.tt-hint {
	color: #999
}

.tt-menu {
	width: 400px;
	margin: 12px 0;
	padding: 8px 0;
	background-color: #fff;
	border: 1px solid #ccc;
	border: 1px solid rgba(0, 0, 0, 0.2);
	-webkit-border-radius: 8px;
	-moz-border-radius: 8px;
	border-radius: 8px;
	-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
	-moz-box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
	box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
}

.tt-suggestion {
	padding: 3px 20px;
	font-size: 13px;
	line-height: 24px;
}

.tt-suggestion:hover {
	cursor: pointer;
	color: #fff;
	background-color: #0097cf;
}

.tt-suggestion.tt-cursor {
	color: #fff;
	background-color: #0097cf;
}

.tt-suggestion p {
	margin: 0;
}

.required {
	color: #bd362f;
	content: "*";
}
</style>	
<style>
.form-control-w-250 {
	width: 250px !important;
}

.margin-top-6 {
	margin-top: 6px;
}

.radio-female input[type=radio]:checked+label::after {
	background-color: #ff4081;
}

.radio-female input[type=radio]+label::after {
	background-color: #ff4081;
}

.file-drop-zone {
	border: 0px;
}
.text-pink{color: #ec407a;}
.text-yellow{color:#fdce02;}
.search-results a {text-decoration : none !important;}
div.search-results:hover a{color:white;}

#loadingmask
{
    width:100%;
    height:100%;
    position:absolute;
    top:0;
    background:white url(http://smallenvelop.com/wp-content/uploads/2014/08/Preloader_8.gif) center no-repeat;
	z-index : 10000;
}

.intro-header {
	background:#4CA;
  /*background: no-repeat center center;*/
  background-attachment: fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
   background-size: cover;
  -o-background-size: cover;
   margin-top: -9px;
 
}
.intro-header h1 {
  color: white;
}
@media only screen and (min-width: 768px) {
  .intro-header .site-heading,
  .intro-header .post-heading,
  .intro-header .page-heading {
    padding: 150px 0;
  }
}
.intro-header .site-heading,
.intro-header .page-heading {
  text-align: center;
}
.intro-header .page-heading h1 {
  margin-top: 0;
  
}
.intro-header .page-heading .subheading {
  font-size: 24px;
  line-height: 1.1;
  display: block;
  font-weight: 300;
  margin: 10px 0 0;
}
@media only screen and (min-width: 768px) {
  .intro-header .site-heading h1,
  .intro-header .page-heading h1 {
    font-size: 80px;
  }
}
.intro-header .post-heading h1 {
  font-size: 35px;
}
.intro-header .post-heading .subheading,
.intro-header .post-heading .meta {
  line-height: 1.1;
  display: block;
}
.intro-header .post-heading .subheading {
  font-size: 24px;
  margin: 10px 0 30px;
  font-weight: 600;
}
.intro-header .post-heading .meta {
  font-style: italic;
  font-weight: 300;
  font-size: 20px;
}
.intro-header .post-heading .meta a {
  color: white;
}
@media only screen and (min-width: 768px) {
  .intro-header .post-heading h1 {
    font-size: 55px;
  }
  .intro-header .post-heading .subheading {
    font-size: 30px;
  }
}
.footer{position:normal;}

/** End of style*/
</style>
<!-- Google Analytics Code -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-84861479-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- End Google Analytics Code -->
</head>
<?php  $model=new Category();
	   $category = $model->get();?>

<?php 
//unset($_SESSION['access_token']);
$client = new Google_Client();
$client->setApplicationName('Login to RtoYou.com');
$client->setClientId(CConfig::get('google.CLIENT_ID'));
$client->setClientSecret(CConfig::get('google.CLIENT_SECRET'));
$client->setRedirectUri(CConfig::get('google.REDIRECT_URI'));
$client->addScope("https://www.googleapis.com/auth/userinfo.email");
$objOAuthService = new Google_Service_Oauth2($client);
if (isset($_GET['code'])) {
	$client->authenticate($_GET['code']);
	$_SESSION['access_token'] = $client->getAccessToken();
	$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
	$client->setAccessToken($_SESSION['access_token']);
} else {
	$authUrl = $client->createAuthUrl();
}
if(isset($authUrl)) //user is not logged in, show login button
{
	$notLoggedIn = true;
}
?>

<?php
/*
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphUser;

FacebookSession::setDefaultApplication(CConfig::get('facebook.APP_ID'),CConfig::get('facebook.APP_SECRET'));
$helper = new FacebookRedirectLoginHelper(CConfig::get('facebook.REDIRECT_URI'));
$session= $helper->getSessionFromRedirect();

if(!$session) {
	$fbloginURL = $helper->getLoginUrl(array('public_profile,user_birthday,user_about_me,user_photos,email'));
}*/

?>
<body >
<header class="intro-header <?php echo $this->_activeClass;?>">
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="page-heading">
                <h1><?php echo $this->headingTop;?></h1>
                <hr class="small">
                <span class="subheading"><?php echo $this->subHeading;?></span>
            </div>
        </div>
    </div>
</div>
</header>
	<!-- Wrapper required for sidebar transitions -->
	<div class="st-container">

		<!-- Fixed navbar -->
		<div class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="#sidebar-menu" data-toggle="sidebar-menu"
						class="toggle pull-left visible-xs"><i class="fa fa-bars"></i> </a>
					<button type="button" class="navbar-toggle collapsed"
						data-toggle="collapse" data-target="#main-nav">
						<span class="sr-only">Toggle navigation</span> <span
							class="icon-bar"></span> <span class="icon-bar"></span> <span
							class="icon-bar"></span>
					</button>
					<!-- <a href="#sidebar-map" data-toggle="sidebar-menu" class="toggle pull-right visible-xs"><i class="fa fa-map-marker"></i></a> -->
					<a class="navbar-brand" href="index/index">R<sub>to</sub>U
					</a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="main-nav">
					<form class="navbar-form navbar-left margin-none">
						<div class="search-1">
							<div class="form-group">
								<div class="input-group">
									<select style="width: 100%;" class="margin-top-6"
										data-toggle="select2" data-placeholder="Select a Category .."
										tabindex="-1" title="" id="globalcat">
										<option value="-1">Choose a category</option>
										<?php foreach ($category as $c=>$v) { ?>
										<option value="<?php echo $v['category_id'];?>">
											<?php echo $v['category_name'];?>
										</option>
										<?php }?>

									</select>
								</div>
							</div>
						</div>
						<div class="search-1 hidden-xs" style="margin-left: 10px;">
							<div class="input-group">
								<input type="text" class="form-control globaltypeahead"
									placeholder="Give some clue what you want to view.." id="globaltypeahead" style="width:300px;"> <span
									class="input-group-addon "><i class="icon-search"></i> </span>

							</div>
						</div>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<!-- Login -->
						<li
							class="dropdown <?php echo $this->_controller == "Post" ? 'active' : '';?>"><a
							href="post/index"> <i class="fa fa-fw fa-plus"></i> Add Review
						</a>
						</li>

						<!-- // END sign up -->
						<?php if(CAuth::isLoggedIn()) { ?>
						<li class="dropdown user"><a href="#" class="dropdown-toggle"
							data-toggle="dropdown" aria-expanded="true"> <img
								src="<?php echo CAuth::getLoggedAvatar();?>" alt=""
								class="img-circle"> <?php echo CAuth::getLoggedName();?><span
								class="caret"></span>
						</a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="profile/index"><i class="fa fa-user"></i> &nbsp;Profile</a></li>
								<li><a href="category/selection"><i class="fa fa-plus"></i> &nbsp;Category Selection</a></li>
								<li><a href="password/index"><i class="fa fa-key"></i> &nbsp;Change Password</a></li>
								<li><a href="index/logout"><i class="fa fa-sign-out"></i> &nbsp;Logout</a>
								</li>
							</ul></li>
						<?php } else {?>
						<li class="dropdown"><a href="#" class="dropdown-toggle"
							data-toggle="dropdown"> <i class="fa fa-fw fa-lock"></i> Login
						</a>
							<div class="dropdown-menu " style="width: 400px;">
								<form  method="POST" action="index/login" id="login-form" name="login-form">
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"></i> </span>
											<input type="text" class="form-control" name="email"
												placeholder="Email" id="login-email">
										</div>
									</div>
									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-shield"></i>
											</span> <input type="password" class="form-control"
												placeholder="Password" name="password"  id="login-pass">
										</div>
									</div>
									<div class="row" style="margin-bottom: 10px;">
										<div class="col-md-4 col-xs-12 col-sm-12 text-center">
											<button type="submit" class="btn btn-primary">
												Login <i class="fa fa-sign-in"></i>
											</button>

										</div>


										<div class="col-md-4 col-xs-12 col-sm-12 ">
											<a href="index/facebook" class="btn btn-info">
												<i class="fa fa-facebook"> Facebook </i>
											</a>
										</div>
										<div class="col-md-4 col-xs-12 col-sm-12 ">
											<a href="<?php echo $notLoggedIn ? $authUrl : '#';?>"
												class="btn btn-danger"> <i class="fa fa-google-plus"> Google
											</i>
											</a>
										</div>

									</div>
									<a href="#"  data-toggle="tk-modal-demo"
										data-modal-options="slide-down"
										data-target="#34c1a2b8-4993-fbee-6881-72bd17f6af45"> Forgot
										your Password? <i class="fa fa-question-circle"></i>
									</a>
								</form>
							</div>
						</li>
						<!-- // END login -->
						<!-- Sign up -->
						<li
							class="dropdown <?php echo $this->_controller == "Signup" ? 'active' : '';?>"><a
							href="signup/index"> <i class="fa fa-fw fa-plus"></i> Sign Up
						</a>
						</li>
						<?php }?>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
		</div>
		<!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
		<div
			class="sidebar left <?php echo $reveal ? 'sidebar-size-1 sidebar-mini-reveal' : 'sidebar-size-2' ;?> sidebar-offset-0 sidebar-skin-dark sidebar-visible-desktop"
			id=sidebar-menu data-type=dropdown>
			<div data-scrollable>
				<ul
					class="sidebar-menu sm-active-item-bg sm-icons-block sm-icons-right">
					<?php foreach ($category as $key=>$val) { ?>
					<li><a href="<?php echo $val['category_seo']?>"><i
							class="<?php echo $val['category_icon']?>"></i><span><?php echo $val['category_name'];?>
						</span> </a>
					</li>
					<?php }?>
				</ul>

			</div>
		</div>
		

		<!-- content push wrapper -->
		
		<!-- /st-content -->
	</div>
<style>
.breadcrumbs-v3::after {
    background: rgba(0, 0, 0, 0.2) none repeat scroll 0 0;
    content: " ";
    height: 100%;
    left: 0;
    position: absolute;
    top: 0;
    width: 100%;
    z-index: -1;
}
}
.breadcrumbs-v3.img-v3 {
    background: rgba(0, 0, 0, 0) url("http://htmlstream.com/preview/unify-v1.9.6/assets/img/breadcrumbs/img3.jpg") no-repeat scroll center center ;
}
.breadcrumbs-v3 {
    padding: 100px 0;
    position: relative;
    z-index: 1;
}
.breadcrumbs-v1, .breadcrumbs-v3 {
    transition: all 0.8s ease-in-out 0s;
}
.text-center {
    text-align: center;
}
.footer {
    position: inherit;
    bottom:0;
    width:100%;
    background-color: #4CA;
}

.footer p {
    color: #fff;
    font-size:.90em;
    display: inline-block;
}

#ftr-wrap {
    display:table;
    table-layout:fixed;
    width:100%;
    margin:0 auto;
}
#ftr-wrap > div {
    display:table-cell;
    vertical-align:middle;
    
}
#ftr-wrap > div:nth-child(1) {text-align:left;}
#ftr-wrap > div:nth-child(2) {text-align:center;}
#ftr-wrap > div:nth-child(3) {text-align:right;}

.ftr-links ul {
    padding: 0;
}
.ftr-links ul li {
    display: inline-block;
    padding-right: 15px;
    font-size:.75em;
}
.ftr-links ul li a {
    color: #fff;
    margin: 0;
}

</style>
<div id="content" style="min-height:600px;">
    <div class="container">
<?php echo A::app()->view->getContent(); ?>
</div></div>
	<script id="tk-modal-demo" type="text/x-handlebars-template">
                            <div class="modal fade{{#if modalOptions}} {{ modalOptions }}{{/if}}" id="{{ id }}">
                                <div class="modal-dialog{{#if dialogOptions}} {{ dialogOptions }}{{/if}}">
                                    <div class="v-cell">
                                        <div class="modal-content{{#if contentOptions}} {{ contentOptions }}{{/if}}">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                                </button>
                                                <h4 class="modal-title">Forgot Password</h4>
                                            </div>
                                            <div class="modal-body">
													<span class="forgot-response"></span>
													<form class="horizontal-form" role="form">
														 <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                                    <div class="input-group col-sm-9">
                                                   <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                        <input type="email" class="form-control" id="inputEmail3" placeholder="xyz@francis.com">
                                                    </div>
                                                </div>
													</form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="close-f btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary forgot-pass ladda-button" data-expand="right">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </script>
	<!-- /st-pusher -->
	<!-- Footer -->




	<?php //echo A::app()->view->getContent(); ?>

	

	</div>
<!-- Footer -->
	<footer class="footer">
	 <div class="container">
		<div id="ftr-wrap">
		    <div class="ftr-links">
		        <ul>
			<li><a href="index/index">Home</a></li>
			<li><a href="about">About Us</a></li>
			<li><a href="contact">Contact Us</a></li>
			<li><a href="terms-and-conditions">Terms&Conditions</a></li>
			<li><a href="privacy-policy">Privacy Policy</a></li>
			<li><a href="faq">Faq</a></li>
		</ul>
		    </div>
		    <div class="copyright-amazon">
		        <p class="copyright">&copy; Copyright rtoyou 2016 , Delhi India</p>
		         <p class="amazon">Review at RtoYou</p>
		    </div>     
		</div>
	      </div>
	
	    
	    
	    
	   
	</footer>
	<!-- Inline Script for colors and config objects; used by various external scripts; -->
	<script>
		var config = {
			theme : "music",
			skins : {
				"default" : {
					"primary-color" : "#3498db"
				}
			}
		};
	</script>
	<!-- Separate Vendor Script Bundles -->
	<script src="templates/default/js/vendor-core.min.js"></script>
	<!-- <script src="templates/default/js/vendor-tables.min.js"></script> -->
	<script src="templates/default/js/vendor-forms.min.js"></script>

	<script src="templates/default/js/vendor-charts-all.min.js"></script>
	<script src="templates/default/js/vendor-charts-morris.min.js"></script>
<script src="templates/default/js/jquery.jscroll.min.js"></script>

	<script src="templates/default/js/module-essentials.js"></script>
	<script src="templates/default/js/module-layout.min.js"></script>
	<script src="templates/default/js/module-sidebar.min.js"></script>
	<script src="templates/default/js/module-media.min.js"></script>
	<!-- <script src="js/module-maps.min.js"></script> -->
	<script src="templates/default/js/module-charts-all.js"></script>
	<!-- <script src="js/module-charts-flot.min.js"></script> -->
	<!-- <script src="js/module-charts-easy-pie.min.js"></script> 
	<script src="templates/default/js/module-charts-morris.min.js"></script>-->
	<!-- <script src="js/module-charts-sparkline.min.js"></script> -->
	<script src="templates/default/js/fileinput.js"></script>
	<script src="templates/default/js/typeahead.js"></script>
	<script src="templates/default/js/typeahead.bundle.js"></script>
	<script src="templates/default/js/spin.min.js"></script>
	<script src="templates/default/js/ladda.min.js"></script>
	<script src="templates/default/js/rtoyou.js"></script>
	<script src="templates/default/js/bootstrap-notify.js"></script>
	<script src="templates/default/js/jquery.fileupload.js"
	type="text/javascript"></script>
	
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
<script src="templates/default/js/javascript.js"></script>

<script>

	$( function(){
		$(".datepicker1").datepicker({
			endDate : new Date(),
			viewMode: 'years'

		});
	});

</script>

	<script>
var jsonImages=[];


</script>
	<script>
		
		
<?php $session = CHttpSession::init();
	if($session->hasFlash('loggedstate') ){ ?>
		$.notify({
			icon: 'glyphicon glyphicon-star',
			message: '<?php echo $session->getFlash('loggedstate');?>' 
		},{
			
			placement : {
				align : 'center',
			},
			delay : 2000,
			type: '<?php echo isset($_GET['error']) ? 'danger' : 'success'; ?>',
			animate: {
				enter: 'animated rollIn',
				exit: 'animated rollOut'
			}
		});

	<?php }?>
		// [END region_geolocation]
	</script>
	<script>
   $(function () { 
	   //$("body").append('<div id="loadingmask"></div>');
	  // $('#loadingmask').fadeOut(1000, function(){ $(this).remove(); });
	   $('#modal').modal('hide')});
   $('#modal').on('show.bs.modal', function(e) {
		 var subcat = $(e.relatedTarget).data('subcat');
		 var cat = $(e.relatedTarget).data('cat');
		 $(e.currentTarget).find('input[name="subcategory"]').val(subcat);
		 $(e.currentTarget).find('input[name="category"]').val(cat);
	});
    
</script>
	<script>
	var globalRes = new Bloodhound({
	  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('category_name'),
	  queryTokenizer: Bloodhound.tokenizers.whitespace,
	  remote: {
	    url: 'search/global?cat=-1',
	    wildcard: '%QUERY',
            replace: function () {
	          var q = 'search/global?cat=';
	          if ($('#globalcat').val()) {
	              q += encodeURIComponent($('#globalcat').val());
	          }
	          q += '&q='+encodeURIComponent($('#globaltypeahead').val());
	          return q;
	      }
	  }
	});
	$('.globaltypeahead').typeahead(null, {
		  hint: true,
		  display: 'category_name',
		  source: globalRes,
		  limit: 10,
		  templates: {
			    empty: [
			      '<div class="empty-message">',
			        'unable to find any Results . Please Type it as your own. We will build it in our system.',
			      '</div>'
			    ].join('\n'),
			    suggestion: function(data){
				return '<div class="search-results"><a href="'+data.category_seo+'/'+data.subcategory_seo+'"><img src="'+data.category_icon+'" class="image-responsive img-circle" width=40  height=40/>&nbsp;&nbsp;&nbsp;<strong>'+data.subcat_name+'</strong> in <strong>'+data.cat_name+'</strong></a><div>';
			}
			  }
		});
	
	var bestPictures = new Bloodhound({
	  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('category_name'),
	  queryTokenizer: Bloodhound.tokenizers.whitespace,
	  remote: {
	    url: 'post/listall?q=%QUERY&cat='+document.forms['post_review'].category.value,
	    wildcard: '%QUERY',
        replace: function () {
	          var q = 'post/listall?cat=';
	          if ($('.category').val()) {
	              q += encodeURIComponent($('.category').val());
	          }
	          q += '&q='+encodeURIComponent($('#review_on').val());
	          return q;
	      }
	  }
	});

	
	$('.typeahead').typeahead(null, {
	  hint: false,
	  display: 'category_name',
	  source: bestPictures,
	  templates: {
		    empty: [
		      '<div class="empty-message">',
		        'unable to find any Results . Please Type it as your own. We will build it in our system.',
		      '</div>'
		    ].join('\n'),
		    suggestion: Handlebars.compile('<div><img src="{{category_icon}}" class="image-responsive img-circle"/>&nbsp;&nbsp;&nbsp;<strong>{{category_name}}</strong> – {{year}}</div>')
		  }
	}).on('typeahead:selected', function(event, data){ 
		 $('#from_Selected').val(data.category_id);        
    }).on('keyup',function(e,d){
		if($(".typeahead").val().length == 0 ) $('#from_Selected').val('');  
	});
	$('.typeahead').on('focus',function(e,d){
		$('.typeahead').typeahead('close');
	});
	$(".typeahead").on('keyup',function(e,d){
		if($(".typeahead").typeahead('val').length == 0 ) $('#from_Selected').val('');  
	});

	</script>
</body>
</html>
