<?php use yii\helpers\Html;
use kartik\widgets\SideNav;
use hscstudio\heart\widgets\Breadcrumbs;
/**
 * @var \yii\web\View $this
 * @var string $content
 */
?>
<?php  $this->beginContent('@app/views/layouts/main.php'); ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">                
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
			<hr>
			<?php
			$items = [
				['icon'=>'dashboard','label' => 'Dashboard', 'url' => ['/'.$this->context->module->uniqueId.'/default/index']],
			];
			echo SideNav::widget(['items' => $items, 'type' => SideNav::TYPE_PRIMARY, 
				//'heading' => '<i class="glyphicon glyphicon-cog"></i> Operations'
				]);
			?>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Right side column. Contains the navbar and content of the page -->
    <aside class="right-side">   
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1><?=  Html::encode($this->title) ?></h1>
        </section>
        <?=  Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <!-- Main content -->
        <section class="content">
            <?=  $content ?>
        </section><!-- /.content -->
    </aside><!-- /.right-side -->
</div><!-- ./wrapper -->
<?php  $this->endContent();