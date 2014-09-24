<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use hscstudio\heart\widgets\Box;

/* @var $this yii\web\View */
/* @var $model backend\models\Training */

$this->title = \yii\helpers\Inflector::camel2words($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-view">
	<?php
	function showLabel($status){
		if ($status==1){
			$icon='<span class="glyphicon glyphicon-check"></span>';
			$label='label label-info';
			$title='READY';
		}	
		else if ($status==2){ 
			$icon='<span class="glyphicon glyphicon-refresh"></span>';
			$label='label label-success';
			$title='EXECUTE';
		}
		else if ($status==3){ 
			$icon='<span class="glyphicon glyphicon-trash"></span>';
			$label='label label-danger';
			$title='CANCEL';
		}
		else {
			$icon='<span class="glyphicon glyphicon-fire"></span>';
			$label='label label-warning';
			$title='PLAN';
		}
		return Html::tag('span', $icon.' '.$title, ['class'=>$label,'title'=>$title,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer']);
	}
	?>
	
	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview',
	]); ?>
	
	<div class="panel">
		<div id="panel-heading-dashboard" style="display:none;" >
			<div id="link-back" >
				<a class="dashboard-show" href="<?= yii\helpers\Url::to(["dashboard","id"=>$model->id]) ?>" style="color:#666;padding:5px;display:block;text-align:center;background:#ddd;border-bottom: 1px solid #ddd;border-radius:4px 4px 0 0">
					<span class="badge"><i class="fa fa-arrow-circle-left"></i> Back To Dashboard</span>
				</a>
			</div>
			<div id="panel-heading-content"></div>
		</div>
		<?php $this->registerJs('
			$("div#panel-dashboard").slideToggle("slow");
		') ?>
		<div id="panel-dashboard" class="row" style="margin:0;padding:0; display:none;">
			<div class="col-md-3">
			<?php
			Box::begin([
				'type'=>'small', // ,small, solid, tiles
				'bgColor'=>'aqua', // , aqua, green, yellow, red, blue, purple, teal, maroon, navy, light-blue
				'options' => [
				],
				'headerOptions' => [
					'button' => ['collapse','remove'],
					'position' => 'right', //right, left
					'color' => '', //primary, info, warning, success, danger
					'class' => '',
				],
				'header' => 'T',
				'bodyOptions' => [],
				'icon' => 'glyphicon glyphicon-eye-open',
				'link' => ['view','id'=>$model->id],
				'footerOptions' => [
					'class' => 'dashboard-hide',
				],
				'footer' => 'More info <i class="fa fa-arrow-circle-right"></i>',
			]);
			?>
			<h3>Property</h3>
			<p>Property of Training</p>
			<?php
			Box::end();
			?>
			</div>

			<!--
			
			<div class="col-md-3">
			<?php
			Box::begin([
				'type'=>'small', // ,small, solid, tiles
				'bgColor'=>'green', // , aqua, green, yellow, red, blue, purple, teal, maroon, navy, light-blue
				'options' => [
				],
				'headerOptions' => [
					'button' => ['collapse','remove'],
					'position' => 'right', //right, left
					'color' => '', //primary, info, warning, success, danger
					'class' => '',
				],
				'header' => 'T',
				'bodyOptions' => [],
				'icon' => 'fa fa-home',
				'link' => ['./training-class2','tb_training_id'=>$model->id],
				'footerOptions' => ['data-pjax'=>0],
				'footer' => 'More info <i class="fa fa-arrow-circle-right"></i>',
			]);
			?>
			<h3>Class</h3>
			<p>Class of Training</p>
			<?php
			Box::end();
			?>
			</div>
			
			
			
			<div class="col-md-3">
			<?php
			Box::begin([
				'type'=>'small', // ,small, solid, tiles
				'bgColor'=>'yellow', // , aqua, green, yellow, red, blue, purple, teal, maroon, navy, light-blue
				'options' => [
				],
				'headerOptions' => [
					'button' => ['collapse','remove'],
					'position' => 'right', //right, left
					'color' => '', //primary, info, warning, success, danger
					'class' => '',
				],
				'header' => 'T',
				'bodyOptions' => [],
				'icon' => 'fa fa-th',
				'link' => ['room','activity_id'=>$model->id],
				'footerOptions' => ['data-pjax'=>0],
				'footer' => 'More info <i class="fa fa-arrow-circle-right"></i>',
			]);
			?>
			<h3>Room</h3>
			<p>Room of Training</p>
			<?php
			Box::end();
			?>
			</div>
			
			<div class="col-md-3">
			<?php
			Box::begin([
				'type'=>'small', // ,small, solid, tiles
				'bgColor'=>'red', // , aqua, green, yellow, red, blue, purple, teal, maroon, navy, light-blue
				'options' => [
				],
				'headerOptions' => [
					'button' => ['collapse','remove'],
					'position' => 'right', //right, left
					'color' => '', //primary, info, warning, success, danger
					'class' => '',
				],
				'header' => 'T',
				'bodyOptions' => [],
				'icon' => 'fa fa-users',
				'link' => ['./training-class-student','tb_training_id'=>$model->id],
				'footerOptions' => ['data-pjax'=>0],
				'footer' => 'More info <i class="fa fa-arrow-circle-right"></i>',
			]);
			?>
			<h3>Student</h3>
			<p>Student of Training</p>
			<?php
			Box::end();
			?>
			</div>
			
			<div class="col-md-3">
			<?php
			Box::begin([
				'type'=>'small', // ,small, solid, tiles
				'bgColor'=>'blue', // , aqua, green, yellow, red, blue, purple, teal, maroon, navy, light-blue
				'options' => [
				],
				'headerOptions' => [
					'button' => ['collapse','remove'],
					'position' => 'right', //right, left
					'color' => '', //primary, info, warning, success, danger
					'class' => '',
				],
				'header' => 'T',
				'bodyOptions' => [],
				'icon' => 'fa fa-book',
				'link' => '',
				'footerOptions' => [],
				'footer' => 'More info <i class="fa fa-arrow-circle-right"></i>',
			]);
			?>
			<h3>Document</h3>
			<p>Document of Training</p>
			<?php
			Box::end();
			?>
			</div>
			
			<div class="col-md-3">
			<?php
			Box::begin([
				'type'=>'small', // ,small, solid, tiles
				'bgColor'=>'purple', // , aqua, green, yellow, red, blue, purple, teal, maroon, navy, light-blue
				'options' => [
				],
				'headerOptions' => [
					'button' => ['collapse','remove'],
					'position' => 'right', //right, left
					'color' => '', //primary, info, warning, success, danger
					'class' => '',
				],
				'header' => 'T',
				'bodyOptions' => [],
				'icon' => 'fa fa-list-ol',
				'link' => '',
				'footerOptions' => [],
				'footer' => 'More info <i class="fa fa-arrow-circle-right"></i>',
			]);
			?>
			<h3>Attendance</h3>
			<p>Student Attendance</p>
			<?php
			Box::end();
			?>
			</div>
			
			<div class="col-md-3">
			<?php
			Box::begin([
				'type'=>'small', // ,small, solid, tiles
				'bgColor'=>'teal', // , aqua, green, yellow, red, blue, purple, teal, maroon, navy, light-blue
				'options' => [
				],
				'headerOptions' => [
					'button' => ['collapse','remove'],
					'position' => 'right', //right, left
					'color' => '', //primary, info, warning, success, danger
					'class' => '',
				],
				'header' => 'T',
				'bodyOptions' => [],
				'icon' => 'fa fa-cogs',
				'link' => '',
				'footerOptions' => [],
				'footer' => 'More info <i class="fa fa-arrow-circle-right"></i>',
			]);
			?>
			<h3>Generator</h3>
			<p>Document Generator</p>
			<?php
			Box::end();
			?>
			</div>
			
			<div class="col-md-3">
			<?php
			Box::begin([
				'type'=>'small', // ,small, solid, tiles
				'bgColor'=>'maroon', // , aqua, green, yellow, red, blue, purple, teal, maroon, navy, light-blue
				'options' => [
				],
				'headerOptions' => [
					'button' => ['collapse','remove'],
					'position' => 'right', //right, left
					'color' => '', //primary, info, warning, success, danger
					'class' => '',
				],
				'header' => 'T',
				'bodyOptions' => [],
				'icon' => 'fa fa-upload',
				'link' => '',
				'footerOptions' => [],
				'footer' => 'More info <i class="fa fa-arrow-circle-right"></i>',
			]);
			?>
			<h3>Uploader</h3>
			<p>Document Uploader</p>
			<?php
			Box::end();
			?>
			</div>
			
			<div class="col-md-3">
			<?php
			Box::begin([
				'type'=>'small', // ,small, solid, tiles
				'bgColor'=>'navy', // , aqua, green, yellow, red, blue, purple, teal, maroon, navy, light-blue
				'options' => [
				],
				'headerOptions' => [
					'button' => ['collapse','remove'],
					'position' => 'right', //right, left
					'color' => '', //primary, info, warning, success, danger
					'class' => '',
				],
				'header' => 'T',
				'bodyOptions' => [],
				'icon' => 'fa fa-money',
				'link' => ['./training-honour','tb_training_id'=>$model->id],
				'footerOptions' => ['data-pjax'=>0],
				'footer' => 'More info <i class="fa fa-arrow-circle-right"></i>',
			]);
			?>
			<h3>Honour</h3>
			<p>Honour of Training</p>
			<?php
			Box::end();
			?>
			</div>
			
			<div class="col-md-3">
			<?php
			Box::begin([
				'type'=>'small', // ,small, solid, tiles
				'bgColor'=>'light-blue', // , aqua, green, yellow, red, blue, purple, teal, maroon, navy, light-blue
				'options' => [
				],
				'headerOptions' => [
					'button' => ['collapse','remove'],
					'position' => 'right', //right, left
					'color' => '', //primary, info, warning, success, danger
					'class' => '',
				],
				'header' => 'T',
				'bodyOptions' => [],
				'icon' => 'fa fa-user-md',
				'link' => ['trainer','id'=>$model->id],
				'footerOptions' => [
					'class' => 'dashboard-hide',
				],
				'footer' => 'More info <i class="fa fa-arrow-circle-right"></i>',
			]);
			?>
			<h3>Trainer</h3>
			<p>Trainer of Training</p>
			<?php
			Box::end();
			?>
			</div>
		
			-->
		</div>
	</div>
		<div id="panel-detail-dashboard">
		</div>
	
	<?php
	$this->registerJs('
		$("a.dashboard-hide").on("click", function () {
			$("div#ajax-loader").show();
			$("div#panel-detail-dashboard").hide("fast");
			var $link = $(this);
			var $source = $link.attr("source")
			$.ajax({
				url: $(this).attr("href"),
				type: "get",
				success: function(data) {
					if ($source) 
						result = $(data).find($source);
					else
						result = data;
					$("div#panel-dashboard div.col-md-3").slideToggle("slow");
					$("div#panel-detail-dashboard").html(result);	
					header = $link.parent("div.small-box").parent().html();
					$("div#panel-heading-content").html(header);
					$("div#panel-heading-content").find("a").remove();
					$("div#panel-heading-dashboard").slideToggle("slow");
					$("div#panel-detail-dashboard").slideToggle("slow");
					$("div#ajax-loader").hide();
				},
				error:  function( jqXHR, textStatus, errorThrown ) {
					alert(jqXHR.responseText);
					$("div#ajax-loader").hide();
				}
			});	
			return false;
		});
		
		$("div#ajax-loader").hide();
	'); 
	?>
	<div id="ajax-loader" class="overlay dark">
	<div class="fa fa-spinner loading-img"></div>
	</div>
	
	<?php \yii\widgets\Pjax::end(); ?>
</div>
