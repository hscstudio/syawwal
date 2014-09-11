<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','heart'],
    'controllerNamespace' => 'frontend\controllers',
	'modules' => [
        'eregistrasi-student' => [
            'class' => '\frontend\modules\eregistrasi\student\Module',
        ],
		'gridview' => [
			'class' => '\kartik\grid\Module',
		],
		'datecontrol' =>  [
			'class' => 'kartik\datecontrol\Module',		
		],
		'user'=>[
			'class' => '\dektrium\user\Module',
			'components' => [
				'manager' => [
					'userClass' => 'common\models\Student',
					],
				], 
			'controllerMap' => [
				'admin' => 'frontend\controllers\SiteController'
				],					
			'confirmable' => false,
			'confirmWithin' =>  86400, 
			'allowUnconfirmedLogin' => false,
			'rememberFor' => 1209600,
			'recoverWithin' => 21600,
			//'admins' => ['admin'],
			'cost' => 13,	
		],
		'heart' => [
            'class' => 'hscstudio\heart\Module',
            'features'=>[
				'datecontrol'=>true,// use false for not use it
				'gridview'=>true,// use false for not use it
				//'gii'=>false, // use false for not use it
				'privilege'=>[
					'allowActions' => [
						/* DEFAULT */
						'debug/*',
						'site/*',
						//'gii/*',
						//'user/*',
						'privilege/*',
						'gridview/*',	// add or remove allowed actions to this list
						'file/*',
						'eregistrasi-student/*',
						],
					'authManager' => [
					  'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
					]
				],
				'user'=>true,
            ]],		
    ],
	
    'components' => [
		
        'user' => [
            'identityClass' => 'common\models\Student',
            'enableAutoLogin' => false,
			'identityCookie' => [
				  'name' => '_frontendUser', // unique for frontend
				  'path'=>'/syawwal/frontend'  // correct path for the frontend app.
			  ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
		],
    ],
    'params' => $params,
];
