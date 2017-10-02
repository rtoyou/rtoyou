<?php
$reveal = false;
if ($this->_controller === "Index" || $this->_controller === "Detail") $reveal = true; ?>
<!DOCTYPE html>
<?php if ($this->_controller === "Detail") { ?>
<html
    class="st-layout ls-top-navbar ls-bottom-footer show-sidebar sidebar-l1 <?php echo $this->_action !== "photos" ? 'sidebar-r1-xs sidebar-r-25pc-lg sidebar-r-30pc' : ''; ?>"
    lang="en">
<?php } else { ?>
<html
    class="st-layout ls-top-navbar ls-bottom-footer show-sidebar <?php echo $reveal ? 'sidebar-l1 ' : 'sidebar-l2';
    echo $this->_controller === 'About' ? ' sidebar-l1-sm sidebar-r2' : '';
    echo $this->_controller === 'Index' ? '  sidebar-r2' : ''; ?>"
    lang="en">
<?php } ?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="templates/default/images/favicon.png" type="image/gif"/>
    <meta name="keywords"
          content="<?php echo CHtml::encode($this->_pageKeywords); ?>"/>
    <meta name="description"
          content="<?php echo CHtml::encode($this->_pageDescription); ?>"/>
    <meta name="og:title"
          content="<?php echo CHtml::encode($this->_ogTitle); ?>"/>
    <meta name="og:description"
          content="<?php echo CHtml::encode($this->_ogDesc); ?>"/>
    <meta name="og:image"
          content="<?php echo $this->_ogImage; ?>"/>

    <title><?php echo CHtml::encode($this->_pageTitle); ?></title>

    <base href="<?php echo A::app()->getRequest()->getBaseUrl(); ?>"/>
    <link href="templates/default/css/vendor.min.css" rel="stylesheet">

    <!-- Compressed Theme BUNDLE
    Note: The bundle includes all the custom styling required for the current theme, however
    it was tweaked for the current theme/module and does NOT include ALL of the standalone modules;
    The bundle was generated using modern frontend development tools that are provided with the package
    To learn more about the development process, please refer to the documentation. -->
    <!-- <link href="css/theme.bundle.min.css" rel="stylesheet"> -->
    <!-- Compressed Theme CORE
    This variant is to be used when loading the separate styling modules -->
    <link href="templates/default/css/theme-core.min.css" rel="stylesheet">
    <!-- Standalone Modules
        As a convenience, we provide the entire UI framework broke down in separate modules
        Some of the standalone modules may have not been used with the current theme/module
        but ALL modules are 100% compatible -->
    <link href="templates/default/css/module-essentials.min.css"
          rel="stylesheet"/>
    <link href="templates/default/css/module-layout.min.css"
          rel="stylesheet"/>
    <link href="templates/default/css/module-sidebar.min.css"
          rel="stylesheet"/>
    <link href="templates/default/css/module-sidebar-skins.min.css"
          rel="stylesheet"/>
    <link href="templates/default/css/module-navbar.min.css"
          rel="stylesheet"/>
    <link href="templates/default/css/module-media.min.css" rel="stylesheet"/>
    <!-- <link href="css/module-timeline.min.css" rel="stylesheet" /> -->
    <!-- <link href="css/module-cover.min.css" rel="stylesheet" /> -->
    <link href="templates/default/css/module-chat.min.css" rel="stylesheet"/>
    <!-- <link href="css/module-charts.min.css" rel="stylesheet" /> -->
    <!-- <link href="css/module-maps.min.css" rel="stylesheet" /> -->
    <!-- <link href="css/module-colors-alerts.min.css" rel="stylesheet" /> -->
    <link href="templates/default/css/module-colors-background.min.css"
          rel="stylesheet"/>
    <link href="templates/default/css/module-colors-buttons.min.css"
          rel="stylesheet"/>
    <!-- <link href="css/module-colors-calendar.min.css" rel="stylesheet" /> -->
    <!-- <link href="css/module-colors-progress-bars.min.css" rel="stylesheet" /> -->
    <link href="templates/default/css/module-colors-text.min.css"
          rel="stylesheet"/>
    <link href="templates/default/css/fileinput.min.css" rel="stylesheet"/>
    <link rel="stylesheet"
          href="templates/default/css/ladda-themeless.min.css">
    <link rel="stylesheet"
          href="templates/default/css/validation.css">
    <link rel="stylesheet"
          href="templates/default/css/animate.css">
    <link rel="stylesheet"
          href="templates/default/css/rtoyou.css">
    <link href="templates/default/css/jquery.fileupload.css"
          rel="stylesheet" type="text/css">


   

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries
    WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!-- If you don't need support for Internet Explorer <= 8 you can safely remove these -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]
    <script src="templates/default/js/validation.js"></script>-->
   

    <!-- Google Analytics Code -->
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-84861479-1', 'auto');
        ga('send', 'pageview');

    </script>
    <!-- End Google Analytics Code -->
</head>
<?php $model = new Category();
$category = $model->get(); ?>

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
if (isset($authUrl)) //user is not logged in, show login button
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
<body>
<?php if (!CAuth::getLoggedEmail() && CAuth::isLoggedIn()) { ?>

    <div id="missingEmailModal" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Please Provide Email address to better experiences.</h4>
                </div>
                <div class="modal-body">
                    <span class="missing-email-response"></span>
                    <p>Please provide a valid email address.</p>
                    <form>
                        <div class="form-group">
                            <input type="email" id="missing-email" class="form-control" placeholder="Email Address"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary send-email  ladda-button" data-expand="right">
                            Verify
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
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
                                    <?php foreach ($category as $c => $v) { ?>
                                        <option value="<?php echo $v['category_id']; ?>">
                                            <?php echo $v['category_name']; ?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="search-1 hidden-xs" style="margin-left: 10px;">
                        <div class="input-group">
                            <input type="text" class="form-control globaltypeahead"
                                   placeholder="Give some clue what you want to view.." id="globaltypeahead"
                                   style="width:300px;" autofocus> <span
                                class="input-group-addon "><i class="icon-search"></i> </span>

                        </div>
                    </div>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <!-- Login -->
                    <li
                        class="dropdown <?php echo $this->_controller == "Post" ? 'active' : ''; ?>"><a
                            href="post/index"> <i class="fa fa-fw fa-plus"></i> Add Review
                        </a>
                    </li>

                    <!-- // END sign up -->
                    <?php if (CAuth::isLoggedIn()) { ?>
                        <li class="dropdown user"><a href="#" class="dropdown-toggle"
                                                     data-toggle="dropdown" aria-expanded="true"> <img
                                    src="<?php echo CAuth::getLoggedAvatar(); ?>" alt=""
                                    class="img-circle"> <?php echo CAuth::getLoggedName(); ?><span
                                    class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="profile/index"><i class="fa fa-user"></i> &nbsp;Profile</a></li>
                                <li><a href="category/selection"><i class="fa fa-plus"></i> &nbsp;Category Selection</a>
                                </li>
                                <li><a href="password/index"><i class="fa fa-key"></i> &nbsp;Change Password</a></li>
                                <li><a href="index/logout"><i class="fa fa-sign-out"></i> &nbsp;Logout</a>
                                </li>
                            </ul>
                        </li>
                    <?php } else { ?>
                        <li class="dropdown login"><a href="#" class="dropdown-toggle "
                                                      data-toggle="dropdown"> <i class="fa fa-fw fa-lock"></i> Login
                            </a>
                            <div class="dropdown-menu " style="width: 400px;">
                                <form method="POST" action="index/login" id="login-form" name="login-form">
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
                                                           placeholder="Password" name="password" id="login-pass">
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
                                            <a href="<?php echo $notLoggedIn ? $authUrl : '#'; ?>"
                                               class="btn btn-danger"> <i class="fa fa-google-plus"> Google
                                                </i>
                                            </a>
                                        </div>

                                    </div>
                                    <a href="#" data-toggle="tk-modal-demo"
                                       data-modal-options="slide-down"
                                       data-target="#34c1a2b8-4993-fbee-6881-72bd17f6af45"> Forgot
                                        your Password? <i class="fa fa-question-circle"></i>
                                    </a>
                                    <a href="signup/index">Be a RtoYou?</a>
                                </form>
                            </div>
                        </li>
                        <!-- // END login -->
                        <!-- Sign up -->
                        <li
                            class="dropdown <?php echo $this->_controller == "Signup" ? 'active' : ''; ?>"><a
                                href="signup/index"> <i class="fa fa-fw fa-plus"></i> Sign Up
                            </a>
                        </li>
                        <li
                            class="dropdown"><a href="#" class="contestLink" data-toggle="tk-modal-demo"
                                                data-template="contest-modal"
                                                data-modal-options="slide-down" data-targetId="2"><i
                                    class="fa fa-fw fa-plus"></i> Participate</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </div>
    <!-- Sidebar component with st-effect-1 (set on the toggle button within the navbar) -->
    <div
        class="sidebar left <?php echo $reveal ? 'sidebar-size-1 sidebar-mini-reveal' : 'sidebar-size-2'; ?> sidebar-offset-0 sidebar-skin-dark sidebar-visible-desktop"
        id=sidebar-menu data-type=dropdown>
        <div data-scrollable>
            <ul
                class="sidebar-menu sm-active-item-bg sm-icons-block sm-icons-right">
                <?php foreach ($category as $key => $val) { ?>
                    <li class="<?php echo $activeLink === $val['category_name'] ? 'active' : '' ;?>"><a href="<?php echo $val['category_seo'] ?>"><i
                                class="<?php echo $val['category_icon'] ?>"></i><span><?php echo $val['category_name']; ?>
						</span> </a>
                    </li>
                <?php } ?>
            </ul>

        </div>
    </div>

    <!-- content push wrapper -->
    <?php echo A::app()->view->getContent(); ?>
    <a href="#" class="contestLink" data-toggle="tk-modal-demo" data-template="contest-modal"
       data-modal-options="slide-down" data-targetId="contest-id-72bd17f6af45"></a>
    <!-- /st-content -->
</div>
<script id="tk-modal-demo" type="text/x-handlebars-template">
    <div class="modal fade{{#if modalOptions}} {{ modalOptions }}{{/if}}" id="{{ id }}">
        <div class="modal-dialog{{#if dialogOptions}} {{ dialogOptions }}{{/if}}">
            <div class="v-cell">
                <div class="modal-content{{#if contentOptions}} {{ contentOptions }}{{/if}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span>
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
                                    <input type="email" class="form-control" id="inputEmail3"
                                           placeholder="xyz@francis.com">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="close-f btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary forgot-pass ladda-button" data-expand="right">
                            Send
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
<!-- /st-pusher -->

<!-- Start of Contest Layout -->

<script id="contest-modal" type="text/x-handlebars-template">
    <div class="modal fade{{#if modalOptions}} {{ modalOptions }}{{/if}}" id="{{ id }}">
        <div class="modal-dialog{{#if dialogOptions}} {{ dialogOptions }}{{/if}}">
            <div class="v-cell">
                <div class="modal-content{{#if contentOptions}} {{ contentOptions }}{{/if}}">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title">Participate in Contest</h4>
                    </div>
                    <div class="modal-body">
                        <img src="templates/default/images/400/young-couple-in-love.jpg"/>
                    </div>
                    <div class="modal-footer">
                        <?php if (CAuth::isLoggedIn()) { ?>
                            <button type="button" class="participate-contest btn btn-primary forgot-pass ladda-button"
                                    data-expand="right" data-loginstate="1" data-cid="68696970">Participate
                            </button>
                        <?php } else { ?>
                            <button type="button" class="participate-contest btn btn-primary forgot-pass ladda-button"
                                    data-expand="right" data-cid="68696970">Participate
                            </button>
                        <?php } ?>
                        <button type="button" class="close-f btn btn-default skip-contest" data-dismiss="modal">Skip
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>
<!-- End of Contest -->


<!-- Footer -->


<?php //echo A::app()->view->getContent(); ?>

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

</div>
<!-- Inline Script for colors and config objects; used by various external scripts; -->
<script>
    var colors = {
        "danger-color": "#e74c3c",
        "success-color": "#81b53e",
        "warning-color": "#f0ad4e",
        "inverse-color": "#2c3e50",
        "info-color": "#2d7cb5",
        "default-color": "#6e7882",
        "default-light-color": "#cfd9db",
        "purple-color": "#9D8AC7",
        "mustard-color": "#d4d171",
        "lightred-color": "#e15258",
        "body-bg": "#f6f6f6"
    };
    var config = {
        theme: "music",
        skins: {
            "default": {
                "primary-color": "#3498db"
            }
        }
    };
</script>


<!-- Separate Vendor Script Bundles -->
<script src="templates/default/js/vendor-core.min.js"></script>

<script src="templates/default/js/vendor-forms-min.js"></script>
<script src="templates/default/js/vendor-media-min.js"></script>

<?php if($this->_controller == "Detail") { ?>
	<script src="templates/default/js/vendor-charts-all.min.js"></script>
	<script src="templates/default/js/vendor-charts-morris.min.js"></script>
	<script src="templates/default/js/module-charts-all-min.js"></script>
<?php } ?>
<!--<script src="templates/default/js/jquery.jscroll.min.js"></script>-->


<script src="templates/default/js/module-essentials.js"></script>
<script src="templates/default/js/module-layout.min.js"></script>
<script src="templates/default/js/module-sidebar.min.js"></script>
<script src="templates/default/js/module-media.min.js"></script>

<!-- <script src="js/module-charts-flot.min.js"></script> -->
<!-- <script src="js/module-charts-easy-pie.min.js"></script>
<script src="templates/default/js/module-charts-morris.min.js"></script>-->
<!-- <script src="js/module-charts-sparkline.min.js"></script> -->
<script src="templates/default/js/fileinput-min.js"></script>
<!--<script src="templates/default/js/typeahead.js"></script>-->
<script src="templates/default/js/typeahead.bundle.js"></script>
 <script src="templates/default/js/spin.min.js"></script>

<script src="templates/default/js/ladda.min.js"></script>
<script src="templates/default/js/rtoyou.js"></script>
<script src="templates/default/js/bootstrap-notify-min.js"></script>
<script src="templates/default/js/jquery.fileupload-min.js" type="text/javascript"></script>

<!--<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script> -->

<script src="templates/default/js/javascript-min.js"></script>
<script src="templates/default/js/imagelightbox.min.js"></script>
<script src="templates/default/js/jquery.montage.min.js"></script>

<script type="text/javascript" src="templates/default/js/mustache-min.js"></script>
<script>

    $(function () {
        $(".datepicker1").datepicker({
            maxDate: '0',
            viewMode: 'years',


        });
        $("#missingEmailModal").modal('show');
        // ACTIVITY INDICATOR

        var activityIndicatorOn = function () {
                $('<div id="imagelightbox-loading"><div></div></div>').appendTo('body');
            },
            activityIndicatorOff = function () {
                $('#imagelightbox-loading').remove();
            },


            // OVERLAY

            overlayOn = function () {
                $('<div id="imagelightbox-overlay"></div>').appendTo('body');
            },
            overlayOff = function () {
                $('#imagelightbox-overlay').remove();
            },


            // CLOSE BUTTON

            closeButtonOn = function (instance) {
                $('<button type="button" id="imagelightbox-close" title="Close"></button>').appendTo('body').on('click touchend', function () {
                    $(this).remove();
                    instance.quitImageLightbox();
                    return false;
                });
            },
            closeButtonOff = function () {
                $('#imagelightbox-close').remove();
            },


            // CAPTION

            captionOn = function () {
                var description = $('a[href="' + $('#imagelightbox').attr('src') + '"] img').attr('alt');
                if (description.length > 0)
                    $('<div id="imagelightbox-caption">' + description + '</div>').appendTo('body');
            },
            captionOff = function () {
                $('#imagelightbox-caption').remove();
            },


            // NAVIGATION

            navigationOn = function (instance, selector) {
                var images = $(selector);
                if (images.length) {
                    var nav = $('<div id="imagelightbox-nav"></div>');
                    for (var i = 0; i < images.length; i++)
                        nav.append('<button type="button"></button>');

                    nav.appendTo('body');
                    nav.on('click touchend', function () {
                        return false;
                    });

                    var navItems = nav.find('button');
                    navItems.on('click touchend', function () {
                        var $this = $(this);

                        if (images.eq($this.index()).attr('href') != $('#imagelightbox').attr('src'))
                            instance.switchImageLightbox($this.index());

                        navItems.removeClass('active');
                        navItems.eq($this.index()).addClass('active');

                        return false;
                    })
                        .on('touchend', function () {
                            return false;
                        });
                }
            },
            navigationUpdate = function (selector) {
                var items = $('#imagelightbox-nav button');
                items.removeClass('active');
                items.eq($(selector).filter('[href="' + $('#imagelightbox').attr('src') + '"]').index(selector)).addClass('active');
            },
            navigationOff = function () {
                $('#imagelightbox-nav').remove();
            },


            // ARROWS

            arrowsOn = function (instance, selector) {
                var $arrows = $('<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"></button>');

                $arrows.appendTo('body');

                $arrows.on('click touchend', function (e) {
                    e.preventDefault();

                    var $this = $(this),
                        $target = $(selector + '[href="' + $('#imagelightbox').attr('src') + '"]'),
                        index = $target.index(selector);

                    if ($this.hasClass('imagelightbox-arrow-left')) {
                        index = index - 1;
                        if (!$(selector).eq(index).length)
                            index = $(selector).length;
                    }
                    else {
                        index = index + 1;
                        if (!$(selector).eq(index).length)
                            index = 0;
                    }

                    instance.switchImageLightbox(index);
                    return false;
                });
            },
            arrowsOff = function () {
                $('.imagelightbox-arrow').remove();
            };


        //	WITH ACTIVITY INDICATION

        $('a[data-imagelightbox="a"]').imageLightbox(
            {
                onLoadStart: function () {
                    activityIndicatorOn();
                },
                onLoadEnd: function () {
                    activityIndicatorOff();
                },
                onEnd: function () {
                    activityIndicatorOff();
                }
            });


        //	WITH OVERLAY & ACTIVITY INDICATION

        $('a[data-imagelightbox="b"]').imageLightbox(
            {
                onStart: function () {
                    overlayOn();
                },
                onEnd: function () {
                    overlayOff();
                    activityIndicatorOff();
                },
                onLoadStart: function () {
                    activityIndicatorOn();
                },
                onLoadEnd: function () {
                    activityIndicatorOff();
                }
            });


        //	WITH "CLOSE" BUTTON & ACTIVITY INDICATION

        var instanceC = $('a[data-imagelightbox="c"]').imageLightbox(
            {
                quitOnDocClick: false,
                onStart: function () {
                    closeButtonOn(instanceC);
                },
                onEnd: function () {
                    closeButtonOff();
                    activityIndicatorOff();
                },
                onLoadStart: function () {
                    activityIndicatorOn();
                },
                onLoadEnd: function () {
                    activityIndicatorOff();
                }
            });


        //	WITH CAPTION & ACTIVITY INDICATION

        $('a[data-imagelightbox="d"]').imageLightbox(
            {
                onLoadStart: function () {
                    captionOff();
                    activityIndicatorOn();
                },
                onLoadEnd: function () {
                    captionOn();
                    activityIndicatorOff();
                },
                onEnd: function () {
                    captionOff();
                    activityIndicatorOff();
                }
            });


        //	WITH ARROWS & ACTIVITY INDICATION

        var selectorG = 'a[data-imagelightbox="g"]';
        var instanceG = $(selectorG).imageLightbox(
            {
                onStart: function () {
                    arrowsOn(instanceG, selectorG);
                },
                onEnd: function () {
                    arrowsOff();
                    activityIndicatorOff();
                },
                onLoadStart: function () {
                    activityIndicatorOn();
                },
                onLoadEnd: function () {
                    $('.imagelightbox-arrow').css('display', 'block');
                    activityIndicatorOff();
                }
            });


        //	WITH NAVIGATION & ACTIVITY INDICATION

        var selectorE = 'a[data-imagelightbox="e"]';
        var instanceE = $(selectorE).imageLightbox(
            {
                onStart: function () {
                    addToLightBox(instanceE, selectorE);
                    overlayOn();
                    navigationOn(instanceE, selectorE);
                },
                onEnd: function () {
                    navigationOff();
                    overlayOff();
                    activityIndicatorOff();
                },
                onLoadStart: function () {
                    activityIndicatorOn();
                },
                onLoadEnd: function () {
                    navigationUpdate(selectorE);
                    activityIndicatorOff();
                }
            });

        var addToLightBox = function (instance, element) {
            instance.addToImageLightbox($(element));
        }
        //	ALL COMBINED

        var selectorF = 'a[data-imagelightbox="f"]';
        var instanceF = $(selectorF).imageLightbox(
            {
                onStart: function () {
                    overlayOn();
                    closeButtonOn(instanceF);
                    arrowsOn(instanceF, selectorF);
                },
                onEnd: function () {
                    overlayOff();
                    captionOff();
                    closeButtonOff();
                    arrowsOff();
                    activityIndicatorOff();
                },
                onLoadStart: function () {
                    captionOff();
                    activityIndicatorOn();
                },
                onLoadEnd: function () {
                    captionOn();
                    activityIndicatorOff();
                    $('.imagelightbox-arrow').css('display', 'block');
                }
            });

    });
    var $container = $('#am-container'),
        $imgs = $container.find('img').hide(),
        totalImgs = $imgs.length,
        cnt = 0;

    $imgs.each(function (i) {
        var $img = $(this);
        $('<img/>').load(function () {
            ++cnt;
            if (cnt === totalImgs) {
                $imgs.show();
                $container.montage({
                    minsize: true,
                    margin: 2
                });

                /*
                 * just for this demo:
                 */
                $('#overlay').fadeIn(500);
                var imgarr = new Array();
                for (var i = 1; i <= 73; ++i) {
                    imgarr.push(i);
                }
                $('#loadmore').show().bind('click', function () {
                    var len = imgarr.length;
                    for (var i = 0, newimgs = ''; i < 65; ++i) {
                        var pos = Math.floor(Math.random() * len),
                            src = imgarr[pos];
                        newimgs += '<a href="#"><img src="templates/default/images/images/' + src + '.jpg"/></a>';
                    }

                    var $newimages = $(newimgs);
                    $newimages.imagesLoaded(function () {
                        $container.append($newimages).montage('add', $newimages);
                    });
                });
            }
        }).attr('src', $img.attr('src'));
    });

</script>
<script>

    $(function () {
	    $('.modal').on('shown.bs.modal', function() {
		
	    });
	  
	   $('.modal').on('shown.bs.modal', function() {
		$(".forgot-response").removeClass('text-danger,text-success').html('');
		$("#inputEmail3").val('');
		if(document.forms['post_review']){
			document.forms['post_review'].reset();
		}
	    });

        <?php if(isset($_GET['participate'])) { ?>
        $("a.contestLink").trigger('click');
        <?php } ?>

        $(document).on('onAfterGetPhotos', function (e, data) {
            var photos = data.data;
            $.each(photos, function (k, v) {
                var _html = '<div class="item col-lg-4 col-md-3 col-sm-4 col-xs-6 height-' + v.height + '-lg"><div class="cover overlay hover cover-image-full height-440"> <img src="' + v.img + '" alt="image" /><a class="overlay overlay-hover overlay-full overlay-bg-black" href="#showImageModal" data-toggle="modal">  <span class="v-center"><span class="text-h4">' + v.caption + '!</span></span></a></div></div>';
                $('[data-toggle="isotope"]').append(_html);
//$('[data-toggle="isotope"]').tkIsotope('layout');

            });
            $('[data-toggle="isotope"]').tkIsotope('layout');
            $("a[data-toggle='modal']").click(function () {
                $("#showImageModal span.title").html($(this).text());
                $("#showImageModal img.full-image").attr('src', this.parentElement.children[0].currentSrc);
                $("#showImageModal").modal('show');
                return false;
            });
        });

        $('.load-reviews').scrollPagination({
            detailid: $("#subcat_id").val(),
            reviewid: $("#cmt_id").val(),
            nop: <?php echo CConfig::get('itemperpage');?>, // The number of posts per scroll to be loaded
            offset: 0, // Initial offset, begins at 0 in this case
            error: 'No More Reviews!', // When the user reaches the end this is the message that is
            // displayed. You can change this if you want.
            delay: 500, // When you scroll down the posts will load after a delayed amount of time.
                        // This is mainly for usability concerns. You can alter this as you see fit
            scroll: true, // The main bit, if set to false posts will not load as the user scrolls.
            url: 'review/getreviews'    	// but will still load if the user clicks.

        });

        $('.load-photos').scrollPagination({
            detailid: $("#subcat_id").val(),
            nop: 10, // The number of posts per scroll to be loaded
            offset: 0, // Initial offset, begins at 0 in this case
            error: 'No More Photos!', // When the user reaches the end this is the message that is
            // displayed. You can change this if you want.
            delay: 500, // When you scroll down the posts will load after a delayed amount of time.
                        // This is mainly for usability concerns. You can alter this as you see fit
            scroll: true, // The main bit, if set to false posts will not load as the user scrolls.
            url: 'detail/photojson',              	// but will still load if the user clicks.
            type: 'photopage'
        });
    })

</script>
<script>
    var jsonImages = [];
    var CONSTANTS = {
	isPostReviewPage : false,
	isProfilePage : false
    };

    $("#input-700").fileinput({
        dataType: 'json',
        uploadUrl: "upload/index", // server upload action
        uploadAsync: false,
        maxFileCount: 5,
        showUpload: false,
    });


    $("#input-700").on('fileuploaded', function (event, data, preview, index) {
        jsonImages.push({"image": "" + data.response.file + ""});
    });


    $("#input-700").on('fileclear', function (event, data, preview, index) {
        jsonImages = [];
    });

    <?php if($this->_controller == "Profile") { ?>
	 CONSTANTS.isProfilePage = true;
	  /**Script to attach for profile page*/
	    if(CONSTANTS.isProfilePage) {
		    $("#file-3").fileupload({
			dataType: 'json',
			url: 'upload/profile',
			add: function (e, data) {
			    $(".profile-pic").attr('src', 'templates/default/images/rtoyou-loading.gif');
			    //data.context = $('<p/>').text('Uploading...').appendTo();
			    data.submit();
			},
			done: function (e, data) {
			    if (data.result.success) {
				$(".profile-pic").attr('src', '/RtoyouImages/profile/' + data.result.file);
				$("li.user img").attr('src', '/RtoyouImages/profile/' + data.result.file);
				$("#profile-pic").val(data.result.file);
			    } else {
				$(".profile-pic").attr('src', $("#profile_pic").val());
				showMessage(data.result.message, 'danger');
			    }
			    /*  $.each(data.result.files, function (index, file) {
			     $('<p/>').text(file.name).appendTo(document.body);
			     });*/
			}
		    });
	    }
	    /**End of script to attach for profile page*/
    <?php } ?>
   
    
    $("#btn-addphotos").click(function () {
        $(".review-photos").show();
    });


</script>
<script>


    <?php
    $session = CHttpSession::init();
    if($session->hasFlash('loggedstate') ){ ?>
    $.notify({
        icon: 'glyphicon glyphicon-star',
        message: '<?php echo $session->getFlash('loggedstate');?>'
    }, {

        placement: {
            align: 'center',
        },
        delay: 2000,
        type: '<?php echo isset($_GET['error']) ? 'danger' : 'success'; ?>',
        animate: {
            enter: 'animated rollIn',
            exit: 'animated rollOut'
        }
    });

    <?php }?>


    <?php if($session->hasFlash('participate') ){ ?>
    $.notify({
        icon: 'glyphicon glyphicon-star',
        message: '<?php echo $session->getFlash('participate');?>'
    }, {

        placement: {
            align: 'center',
        },
        delay: 2000,
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
        /*$("body").append('<div id="loadingmask"></div>');
         $('#loadingmask').fadeOut(1000, function () {
         $(this).remove();
         });*/
        $("#twitter").load('index/twitter');
        $('#modal').modal('hide')
    });
    $('#modal').on('show.bs.modal', function (e) {
        var subcat = $(e.relatedTarget).data('subcat');
        var cat = $(e.relatedTarget).data('cat');
        $(e.currentTarget).find('input[name="subcategory"]').val(subcat);
        $(e.currentTarget).find('input[name="category"]').val(cat);
    });
    $("a[data-toggle='modal']").click(function () {
        $("#showImageModal span.title").html($(this).text());
        $("#showImageModal img.full-image").attr('src', this.parentElement.children[0].currentSrc);
        $("#showImageModal").modal('show');
        return false;
    });
</script>
<script>
    $(function () {
        <?php if ($this->_controller === "Signup") { ?>
        $("#inlineRadio1").attr('checked', 'checked'); //check to default selected male
        <?php } ?>
        $("#btn1").click(function (event) {
            var success = false;

            var _email = $("#email").val().trim();
            var _password = $("#password1").val();
            var _cnfpass = $("#password2").val();
            if (_email.length == 0) {
                $("#email").focus();
                $("#email").parent().addClass('has-error');
                showMessage('Please enter your email.', 'danger');
            } else if (_password.length == 0 || _password.length <= 6) {
                $("#password1").focus();
                $("#password1").parent().addClass('has-error');
                showMessage('Password must be at least seven characters long..', 'danger');
            } else if (_cnfpass.length == 0) {
                $("#password2").focus();
                $("#password2").parent().addClass('has-error');
                showMessage('Please enter Confirm password to match.', 'danger');
            } else if (_cnfpass !== _password) {
                $("#password2").focus();
                $("#password2").parent().addClass('has-error');
                showMessage('Your password and confirm password not matched..', 'danger');
            } else {
                success = true;
            }
            if (success) {
                $.ajax({
                    url: 'index/check',
                    method: 'POST',
                    data: {email: _email},
                    dataType: 'json',
                    success: function (data, textStatus, error) {
                        if (data.ErrorCode == 0
                            && data.success == "success") {
                            $("#password2").removeClass('has-error');
                            $("#password1").removeClass('has-error');
                            $("#email").removeClass('has-error');
                            $(".wiz-next").trigger('click');
                            $(".wiz-next").trigger('click');
                        } else {
                            showMessage(data.message, 'danger');
                            $("#email").focus();
                            $("#email").parent().addClass('has-error');
                        }
                    },
                    error: function (data, textStatus, error) {
                        showMessage(data.message, 'danger');
                        $("#email").focus();
                        $("#email").parent().addClass('has-error');
                    }
                });

            }
        });
        $(".join-now").click(function (event) {
            var success = false;
            var _name = $("#wiz-fname").val().trim();
            if (_name.length == 0 || _name.length > 60) {
                $("#wiz-fname").focus();
                showMessage('Name should be between 0 to 60 characters.', 'danger');
            } else if (dobValidate()) {
                success = true;
            }
            if (success) {
                $("form#registration").submit();
            }
        });
        $(".change-password").click(function (event) {
            var success = false;

            var _oldpass = $("#oldpassword").val().trim();
            var _password = $("#password1").val();
            var _cnfpass = $("#password2").val();

            if (_oldpass.length == 0 || _oldpass.length <= 6) {
                $("#oldpassword").focus();
                $("#oldpassword").parent().addClass('has-error');
                showMessage('Password must be at least seven characters long.', 'danger');
            } else if (_password.length == 0 || _password.length <= 6) {
                $("#password1").focus();
                $("#password1").parent().addClass('has-error');
                showMessage('New password must be at least seven characters long.', 'danger');
            } else if (_cnfpass.length == 0 || _cnfpass.length <= 6) {
                $("#password2").focus();
                $("#password2").parent().addClass('has-error');
                showMessage('Confirm Password must be at least seven characters long.', 'danger');
            } else if (_cnfpass !== _password) {
                $("#password2").focus();
                $("#password2").parent().addClass('has-error');
                showMessage('Your new password and confirm password not match.', 'danger');
            } else if (_cnfpass === _oldpass) {
                $("#password1").focus();
                $("#password1").parent().addClass('has-error');
                showMessage('New password can not be same as your last password.', 'danger');
            } else {
                success = true;
            }
            if (success) {
                $("#password2").removeClass('has-error');
                $("#password1").removeClass('has-error');
                $("#oldpassword").removeClass('has-error');
                $("form#changePasswordForm").submit();
            }
        });
        $(".update-profile").click(function (event) {
            var success = false;
            var _name = $("#pname").val().trim();
            if (_name.length == 0 || _name.length > 60) {
                $("#pname").focus();
                showMessage('Name should be between 0 to 60 characters.', 'danger');
            } else if (!dobValidate()) {
                success = false;
                $("#bday").focus();
            } else if (!urlValidate($("#facebook").val())) {
                $("#facebook").parent().addClass('has-error');
                showMessage('Facebook link should be a valid link.', 'danger');
            } else if (!urlValidate($("#twitter").val())) {
                $("#twitter").parent().addClass('has-error');
                showMessage('Twitter link should be a valid link.', 'danger');
            } else if (!urlValidate($("#instagram").val())) {
                $("#instagram").parent().addClass('has-error');
                showMessage('Instagram link should be a valid link.', 'danger');
            } else if (!numberValidate($("#contact").val())) {
                $("#contact").parent().addClass('has-error');
                showMessage('Contact Number should be a valid number.', 'danger');
            } else {
                success = true;
            }
            if (success) {
                $("form#update-profile").submit();
            }
        });

    });
    function get() {
        alert($('#from_Selected').val(''));
    }

   
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
                q += '&q=' + encodeURIComponent($('#globaltypeahead').val());
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
            suggestion: function (data) {
                return '<div class="search-results" onclick="window.location.href=\''+ data.category_seo + '/' + data.subcategory_seo +'\'" style="cursor: pointer;"><a href="' + data.category_seo + '/' + data.subcategory_seo + '"><img src="' + data.category_icon + '" class="image-responsive img-circle" width=40  height=40/>&nbsp;&nbsp;&nbsp;<strong>' + data.subcat_name + '</strong> in <strong>' + data.cat_name + '</strong></a><div>';
            }
        }
    });

    <?php if($this->_controller == "Post") { ?>
	CONSTANTS.isPostReviewPage = true;
    <?php }?>
   
    /** Script to load only for post review page */

    if(CONSTANTS.isPostReviewPage) {
	    var bestPictures = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.obj.whitespace('category_name'),
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		remote: {
		    url: 'post/listall?q=%QUERY&cat=' + document.forms['post_review'].category.value,
		    wildcard: '%QUERY',
		    replace: function () {
		        var q = 'post/listall?cat=';
		        if ($('.category').val()) {
		            q += encodeURIComponent($('.category').val());
		        }
		        q += '&q=' + encodeURIComponent($('#review_on').val());
		        return q;
		    }
		}
	    });

	    $(".category").change(function () {
		$('#review_on').val('');
		$('#from_Selected').val('');
		$(".typeahead").typeahead('val', "");
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
	    }).on('typeahead:selected', function (event, data) {
		$('#from_Selected').val(data.category_id);
	    }).on('keyup', function (e, d) {
		if ($(".typeahead").val().length == 0) $('#from_Selected').val('');
	    });
	    $('.typeahead').on('focus', function (e, d) {
		$('.typeahead').typeahead('close');
	    });
	    $(".typeahead").on('keyup', function (e, d) {
		if ($(".typeahead").typeahead('val').length == 0) $('#from_Selected').val('');
	    });
    }
    /** End of Script to load only for post review page */
</script>
</body>
</html>
