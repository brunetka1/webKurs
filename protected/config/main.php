<?php
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	//'theme'=>'bootstrap',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Shop mamagment',
	

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'bootstrap.helpers.TbHtml',

	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(

			//'generatorPaths'=>array(
            //     'bootstrap.gii',
            //),
			'class'=>'system.gii.GiiModule',
			'password'=>'rfnzcjkysirj',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			'generatorPaths' => array('bootstrap.gii'),
		),
		
	),

	// application components
	'components'=>array(
			'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			//'returnUrl'=>array('ibeacon/admin'),
			//'loginUrl'=>array('site/login'),
		),
		// uncomment the following to enable URLs in path-format





		'urlManager'=>array(
			'urlFormat'=>'path',
			//'showScriptName' => false,
			'rules'=>array(
				
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/*
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		*/
		'db'=>array(
			'connectionString'   => 'mysql:host=localhost;dbname=db',
            'emulatePrepare'     => true,
            'username'           => 'root',
            'password'           => '',
            'enableProfiling'    => true,
            'enableParamLogging' => true,
            'charset'            => 'utf8',
            'tablePrefix'        => 'tbl_',
			//'connectionString' => 'mysql:host=db3.ho.ua;dbname=yaa',
			
			//'username' => 'yaa',
			//'password' => '',
			
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),
	
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);