<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;

use hscstudio\heart\widgets\Nav;
use hscstudio\heart\widgets\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?php echo Yii::getAlias('@web');?>/favicon.ico"/>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '<i class="fa fa-th-large"></i> '.Yii::$app->params['namaAplikasi'],
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
                'innerContainerOptions'=>[
                    'class' => 'container-fluid',
                ]
            ]);
            $menuItems = [];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Register', 'url' => ['/user/registration/register']];
				$menuItems[] = ['label' => 'Login', 'url' => ['/user/security/login']];
            } else {
                $menuItemsLeft[] =
                    ['icon'=>'fa fa-android fa-fw','label' => 'ADMIN', 'url' => ['/administrator/default/index'], 'items' => [
                        ['icon'=>'fa fa-cog fa-fw fa-spin','label'=>'Generator', 'url'=> ['/gii']],
                        ['icon'=>'fa fa-warning fa-fw','label'=>'Privileges', 'url'=> ['/privilege/assigment'],'path'=>'privilege'],
                        ['icon'=>'fa fa-key fa-fw','label'=>'Users', 'url'=> ['/user/admin'],'path'=>'user'],
                    ]];
				$menuItemsLeft[] =
                    ['icon'=>'fa fa-home fa-fw','label' => 'SEKRETARIAT', 'url' => '#', 'items' => [
                        ['icon'=>'fa fa-sitemap fa-fw','label'=>'Organisation', 'url'=> ['/sekretariat-organisation/default/index'],'path'=>'sekretariat-organisation' ],
                        ['icon'=>'fa fa-users fa-fw','label'=>'HRD', 'url'=> ['/sekretariat-hrd/default/index'],'path'=>'sekretariat-hrd' ],
                        ['icon'=>'fa fa-money fa-fw','label'=>'Finance', 'url'=> ['/sekretariat-finance/default/index'],'path'=>'sekretariat-finance' ],
                        ['icon'=>'fa fa-desktop fa-fw','label'=>'Information Technology', 'url'=> ['/sekretariat-it/default/index'],'path'=>'sekretariat-it' ],
                        ['icon'=>'fa fa-joomla fa-fw','label'=>'General', 'url'=> ['/sekretariat-general/default/index'],'path'=>'sekretariat-general' ],
                    ]];
                $menuItemsLeft[] =
                    ['icon'=>'fa fa-building fa-fw','label' => 'PUSDIKLAT', 'url' => ['#'], 'items' => [
                        ['icon'=>'fa fa-joomla fa-fw','label'=>'General', 'url'=> ['/pusdiklat-general/default/index'],'path'=>'pusdiklat-general'],
						['icon'=>'fa fa-calendar fa-fw','label'=>'Planning', 'url'=> ['/pusdiklat-planning/default/index'],'path'=>'pusdiklat-planning'],
						['icon'=>'fa fa-paper-plane fa-fw','label'=>'Execution', 'url'=> ['/pusdiklat-execution/default/index'],'path'=>'pusdiklat-execution'],
						['icon'=>'fa fa-check-square-o fa-fw','label'=>'Evaluation', 'url'=> ['/pusdiklat-evaluation/default/index'],'path'=>'pusdiklat-evaluation'],
						'<li class="divider"></li>',
                       ['icon'=>'fa fa-joomla fa-fw','label'=>'General', 'url'=> ['/pusdiklat2-general/default/index'],'path'=>'pusdiklat2-general' ],
                        ['icon'=>'fa fa-stack-overflow fa-fw','label'=>'Training', 'url'=> ['/pusdiklat2-training/default/index'],'path'=>'pusdiklat2-training' ],
                        ['icon'=>'fa fa-sort-numeric-asc fa-fw','label'=>'Test', 'url'=> ['/pusdiklat2-test/default/index'],'path'=>'pusdiklat2-test' ],
						['icon'=>'fa fa-graduation-cap fa-fw','label'=>'Scholarship', 'url'=> ['/pusdiklat2-scholarship/default/index'],'path'=>'pusdiklat2-scholarship' ],
                    ]];
                $menuItemsLeft[] =
                    ['icon'=>'fa fa-university fa-fw','label' => 'BDK', 'url' => ['#'], 'items' => [
                        ['icon'=>'fa fa-joomla fa-fw','label'=>'General', 'url'=> ['/bdk-general/default/index'],'path'=>'bdk-general'],
                        ['icon'=>'fa fa-paper-plane fa-fw','label'=>'Execution', 'url'=> ['/bdk-execution/default/index'],'path'=>'bdk-execution'],
                        ['icon'=>'fa fa-check-square-o fa-fw','label'=>'Evaluation', 'url'=> ['/bdk-evaluation/default/index'],'path'=>'bdk-evaluation'],
                    ]];

                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav'],
                    'position'=>'left',
                    'items' => $menuItemsLeft,
                ]);

                $menuItems[] =  
                    ['icon'=>'fa fa-user','label'=>'', 'url'=> '', 'items'=>[
						['icon'=>'fa fa-user','label' => 'Profile','url' => ['/user/settings/profile'],],
                        '<li class="divider"></li>',
                        [
                            'icon'=>'fa fa-power-off',
                            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/user/security/logout'],
                            'linkOptions' => ['data-method' => 'post']
                        ]
                    ]                        
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
        ?>

        <div class="container-fluid">
			<?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container-fluid">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>