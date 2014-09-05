<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;
use hscstudio\heart\widgets\Nav;
use hscstudio\heart\widgets\NavBar;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title>SIMBPPK</title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?php echo Yii::getAlias('@web');?>/bppk.jpg"/>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => '<i class="fa fa-th-large"></i> '.Yii::$app->params['namaAplikasi'],
                'brandUrl' => Yii::$app->homeUrl,
                'options' => ['class' => 'navbar-inverse navbar-fixed-top',],
				'innerContainerOptions'=>['class' => 'container-fluid',],
            ]);
            
            if (Yii::$app->user->isGuest) {
				$menuItems[] = ['icon'=>'fa fa-home fa-fw','label' => 'Home', 'url' => ['/site/index']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } 
			else {
				//$menuItemsLeft[] = ['icon'=>'fa fa-home fa-fw','label' => 'Home', 'url' => ['/site/index']];
				$menuItemsLeft[] = ['icon'=>'fa fa-book fa-fw','label' => 'Eregistrasi', 'url' => ['/eregistrasi-student/default/index']];
				//$menuItemsLeft[] = ['icon'=>'fa fa-database fa-fw','label' => 'Diklat', 'url' => ['/eregistrasi/training/default/index']];
				
			echo Nav::widget([
                    'options' => ['class' => 'navbar-nav'],
                    'position'=>'left',
                    'items' => $menuItemsLeft,
                ]);
				
				$menuItems[] =  
                    ['icon'=>'fa fa-user','label'=>'', 'url'=> '', 'items'=>[
                        [
                            'icon'=>'fa fa-power-off',
                            'label' => 'Logout (' . Yii::$app->user->identity->nip . ')',
                            'url' => ['/site/logout'],
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
        <p class="pull-left">&copy; Badan Pendidikan dan Pelatihan Keuangan <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
