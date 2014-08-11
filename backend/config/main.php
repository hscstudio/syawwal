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
		/*Sekretariat*/
		'sekretariat-organisation' => [
            'class' => 'backend\modules\sekretariat\organisation\Module',
        ],
		'sekretariat-hrd' => [
            'class' => 'backend\modules\sekretariat\hrd\Module',
        ],
		'sekretariat-finance' => [
            'class' => 'backend\modules\sekretariat\finance\Module',
        ],
		'sekretariat-it' => [
            'class' => 'backend\modules\sekretariat\it\Module',
        ],
		'sekretariat-general' => [
            'class' => 'backend\modules\sekretariat\general\Module',
        ],
		///////////////////////////////////////////
		/*Pusdiklat2*/
		'pusdiklat2-general' => [
            'class' => 'backend\modules\pusdiklat2\general\Module',
        ],
		'pusdiklat2-training' => [
            'class' => 'backend\modules\pusdiklat2\training\Module',
        ],
		'pusdiklat2-test' => [
            'class' => 'backend\modules\pusdiklat2\test\Module',
        ],
		'pusdiklat2-scholarship' => [
            'class' => 'backend\modules\pusdiklat2\scholarship\Module',
        ],
		/////////////////
		/* START PUSDIKLAT */
		'pusdiklat-general' => [
            'class' => 'backend\modules\pusdiklat\general\Module',
        ],
		'pusdiklat-planning' => [
            'class' => 'backend\modules\pusdiklat\planning\Module',
        ],
		'pusdiklat-execution' => [
            'class' => 'backend\modules\pusdiklat\execution\Module',
        ],
		'pusdiklat-evaluation' => [
            'class' => 'backend\modules\pusdiklat\evaluation\Module',
        ],
		/* FINISH PUSDIKLAT */
		/* START BDK */
		'bdk-general' => [
            'class' => 'backend\modules\bdk\general\Module',
        ],
		'bdk-execution' => [
            'class' => 'backend\modules\bdk\execution\Module',
        ],
		'bdk-evaluation' => [
            'class' => 'backend\modules\bdk\evaluation\Module',
        ],
		/* FINSIH BDK */
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
						'privilege/*',
						'gridview/*',	// add or remove allowed actions to this list
						'employee/*',
						/*Priviledge Sekretariat*/
						'sekretariat-organisation/*',
						'sekretariat-hrd/*',
						'sekretariat-finance/*',
						'sekretariat-it/*',
						'sekretariat-general/*',
						////////////////////////////////////////////////
						/*Pusdiklat2*/
						'pusdiklat2-general/*',
						'pusdiklat2-training/*',
						'pusdiklat2-test/*',
						'pusdiklat2-scholarship/*',
						/* START PUSDIKLAT */
						'pusdiklat-general/*',
						'pusdiklat-planning/*',
						'pusdiklat-execution/*',
						'pusdiklat-evaluation/*',
						/* FINISH PUSDIKLAT */
						/* START BDK */
						'bdk-general/*',
						'bdk-execution/*' ,
						'bdk-evaluation/*' ,
						/* FINISH BDK */
						
					],
					'authManager' => [
					  'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
					]
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
