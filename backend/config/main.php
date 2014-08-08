<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log','heart'],
    'modules' => [
		'sekretariat-hrd' => [
            'class' => 'backend\modules\sekretariat\hrd\Module',
        ],
		'sekretariat-organisation' => [
            'class' => 'backend\modules\sekretariat\organisation\Module',
        ],
		'heart' => [
            'class' => 'hscstudio\heart\Module',
            'features'=>[
                // fontawesome, datecontrol (kartik), gridview (kartik), gii, privilege (yii2-admin), user (yii2-user)
				'fontawesome'=>true, // use false for not use it
				'datecontrol'=>true,// use false for not use it
				'gridview'=>true,// use false for not use it
				'gii'=>true, // use false for not use it
				'privilege'=>[
					'allowActions' => [
						'debug/*',
						'site/*',
						'gii/*',
						'user/*',
						'privilege/*',
						'gridview/*',	// add or remove allowed actions to this list
						'employee/*',
						'sekretariat-hrd/*',
						'sekretariat-organisation/*'
					],
					'authManager' => [
					  'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
					]
				],
				'user'=>[
					'components' => [
						'manager' => [
							// Active record classes
							//'userClass'    => 'dektrium\user\models\User',
							//'profileClass' => 'dektrium\user\models\Profile',
							//'accountClass' => 'dektrium\user\models\Account',
							// Model that is used on resending confirmation messages
							//'resendFormClass' => 'dektrium\user\models\ResendForm',
							// Model that is used on logging in
							//'loginFormClass' => 'dektrium\user\models\LoginForm',
							// Model that is used on password recovery
							//'passwordRecoveryFormClass' => 'dektrium\user\models\RecoveryForm',
							// Model that is used on requesting password recovery
							//'passwordRecoveryRequestFormClass' => 'dektrium\user\models\RecoveryRequestForm',
						],
					],                  
					'confirmable' => false,
					'confirmWithin' =>  86400, 
					'allowUnconfirmedLogin' => true,
					'rememberFor' => 1209600,
					'recoverWithin' => 21600,
					'admins' => ['admin'],
					'cost' => 13,
				],  
            ]
        ],
	],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
