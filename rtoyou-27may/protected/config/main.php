<?php

return array(
    // application data
    'name'=>'Static Site',
    'version'=>'0.0.1',

    'installationKey' => '1wew3e4r5t',

    'imageformat'=>array('image/jpeg','image/png','image/jpg','image/PNG'),
    'maxfilesize'=>5,
    'itemperpage'=>20,
    'email' => array(
        'mailer' => 'phpMail', /* phpMail | phpMailer | smtpMailer */
        'from'   => 'support@rtoyou.com',
        'isHtml' => true,
        'smtp' => array(
            'secure' => 'ssl',
            'host' => 'smtp.gmail.com',
            'port' => '465',
            'username' => 'ggprashant007@gmail.com',
            'password' => '****************',
        ),
    ),
    'gender'=>array(
        'Male'=>'default_avatar_male.jpg',
        'Female'=>'default_avatar_female.jpg'
    ),
'defaultImages' =>array(
	'no-image'=>'noimage.png',
	'loading-small'=>'ajax-loader.gif',
	'loading-big'=>'rtoyou-loading.gif'
    ),
    
    'google' => array(
        'CLIENT_ID' => '676698115460-svr929c1h4mbbkne2t2c7kkvpeipk3h8.apps.googleusercontent.com',
        'CLIENT_SECRET'   => 'M4s2v5GG6F3irWvhHugQhSOJ',
        'REDIRECT_URI' => 'http://www.rtoyou.com/80a740febb8085c43fbee79a231513aa/rtoyou-27may/index/google',
    ),
    'facebook' => array(
        'APP_ID' => '1349029535137571',
        'APP_SECRET'   => '46efc58df51fa5a38dc7578543e86155',
        'REDIRECT_URI' => 'http://www.rtoyou.com/80a740febb8085c43fbee79a231513aa/rtoyou-27may/index/facebook',
    ),
    'ImageServerPath'=>'/home/pacific0073/public_html/RtoyouImages/',
    'BaseUrlImage'=>'http://www.rtoyou.com/RtoyouImages/',
    'baseurl'=>'http://rtoyou.com/80a740febb8085c43fbee79a231513aa/rtoyou-27may/',
    'MAX_WITHOUT_LOGIN'=>3,
    'validation' => array(
        'csrf' => false
    ),

    'defaultTimeZone' => 'UTC',
    'defaultTemplate' => 'default',
    'defaultController' => 'Index',
    'defaultAction' => 'index',

    'urlManager' => array(
        'urlFormat' => 'shortPath',  /* get | path | shortPath */
        'rules' => array(
            //'controller/action/value1/value2' => 'controller/action/param1/value1/param2/value2',
        ),
    ),

);
