<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;

/* @var $searchModel backend\models\TrainingClassStudentSearch */

$this->title = 'Student : '.\yii\helpers\Inflector::camel2words($training->name);
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training/index'])];
$this->params['breadcrumbs'][] = ['label' => 'Training Class', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class/index','tb_training_id'=>$tb_training_id])];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-class-student-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<div class="panel" id="panel-heading-dashboard" style="display:none;" >
		<a href="<?= yii\helpers\Url::to(["training/dashboard","id"=>$training->id]) ?>" style="color:#666;padding:5px;display:block;text-align:center;background:#ddd;border-bottom: 1px solid #ddd;border-radius:4px 4px 0 0">
			<span class="badge"><i class="fa fa-arrow-circle-left"></i> Back To Dashboard</span>
		</a>
		<?php
		\hscstudio\heart\widgets\Box::begin([
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
			'icon' => 'fa fa-user',
			//'link' => ['./training-class','tb_training_id'=>$training->id],
			'footerOptions' => ['class'=>'hide'],
			//'footer' => 'More info <i class="fa fa-arrow-circle-right"></i>',
		]);
		?>
			<h3>Student</h3>
			<p>Student of Training</p>
		<?php
		\hscstudio\heart\widgets\Box::end();
		?>
	</div>
	<?php
	$this->registerJs('
		$("div#panel-heading-dashboard").slideToggle("slow");
	');
	?>
	
	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview',
	]); ?>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
			[
				'attribute' => 'tb_student_id',
				'label' => 'NAMA',
				'value' => function ($data) {
					return $data->student->name;
				}
			],
			[
				'label' => 'NIP',
				'width' => '200px',
				'value' => function ($data) {
					return $data->student->nip;
				}
			],
            /*
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'number',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Number', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
		
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'headClass',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'HeadClass', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
		
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'activity',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Activity', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
		
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'presence',
				//'pageSummary' => 'Page Total',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Presence', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
		
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'pretest',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Pretest', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
		
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'posttest',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Posttest', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
			*/
            ['class' => 'kartik\grid\ActionColumn'],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			'before'=>
				Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Training Class', \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class/index','tb_training_id'=>$tb_training_id]), ['class' => 'btn btn-warning']).' '.
				Html::a('<i class="fa fa-fw fa-plus"></i> Create Training Class Student', ['create'], ['class' => 'btn btn-success']).
				'<div class="pull-right" style="margin-right:5px;">'.
				Select2::widget([
					'name' => 'class', 
					'data' => $listTrainingClass,
					'value' => $tb_training_class_id,
					'options' => [
						'placeholder' => 'Class ...', 
						'class'=>'form-control', 
						'onchange'=>'
							$.pjax.reload({
								url: "'.\yii\helpers\Url::to(['index','tb_training_id'=>$tb_training_id]).'&tb_training_class_id="+$(this).val(), 
								container: "#pjax-gridview", 
								timeout: 1,
							});
						',	
					],
				]).
				'</div>',
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index','tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],
		'responsive'=>true,
		'hover'=>true,
    ]); ?>
	
	<?php 	
	echo Html::beginTag('div', ['class'=>'row']);
		echo Html::beginTag('div', ['class'=>'col-md-2']);
			echo Html::beginTag('div', ['class'=>'dropdown']);
				echo Html::button('PHPExcel <span class="caret"></span></button>', 
					['type'=>'button', 'class'=>'btn btn-default', 'data-toggle'=>'dropdown']);
				echo Dropdown::widget([
					'items' => [
						['label' => 'EXport XLSX', 'url' => ['php-excel?filetype=xlsx&template=yes']],
						['label' => 'EXport XLS', 'url' => ['php-excel?filetype=xls&template=yes']],
						['label' => 'Export PDF', 'url' => ['php-excel?filetype=pdf&template=no']],
					],
				]); 
			echo Html::endTag('div');
		echo Html::endTag('div');
	
		echo Html::beginTag('div', ['class'=>'col-md-2']);
			echo Html::beginTag('div', ['class'=>'dropdown']);
				echo Html::button('OpenTBS <span class="caret"></span></button>', 
					['type'=>'button', 'class'=>'btn btn-default', 'data-toggle'=>'dropdown']);
				echo Dropdown::widget([
					'items' => [
						['label' => 'EXport DOCX', 'url' => ['open-tbs?filetype=docx']],
						['label' => 'EXport ODT', 'url' => ['open-tbs?filetype=odt']],
						['label' => 'EXport XLSX', 'url' => ['open-tbs?filetype=xlsx']],
					],
				]); 
			echo Html::endTag('div');
		echo Html::endTag('div');
		
		echo Html::beginTag('div', ['class'=>'col-md-8']);
			$form = \yii\bootstrap\ActiveForm::begin([
				'options'=>['enctype'=>'multipart/form-data'],
				'action'=>['import','tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id],
			]);
			echo \kartik\widgets\FileInput::widget([
				'name' => 'importFile', 
				//'options' => ['multiple' => true], 
				'pluginOptions' => [
					'previewFileType' => 'any',
					'uploadLabel'=>"Import Excel",
				]
			]);
			\yii\bootstrap\ActiveForm::end();
		echo Html::endTag('div');
		
	echo Html::endTag('div');
	?>
	
	<?php \yii\widgets\Pjax::end(); ?>
	
</div>
