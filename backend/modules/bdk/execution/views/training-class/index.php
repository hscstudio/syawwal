<?php

use yii\helpers\Html;
use yii\bootstrap\Dropdown;
use yii\helpers\Url;
use kartik\grid\GridView;

$this->title = 'Training Class of '.$currentTraining->name;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => Url::to(['training/index'])];
$this->params['breadcrumbs'][] = 'Class';

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

// Mbikin trio button header before
$buttonHeaderBefore = '<div class="btn-group">';
$buttonHeaderBefore .= Html::a('<i class="fa fa-fw fa-arrow-circle-left"></i>Done', Url::to(['training/index']), [
						'class' => 'btn btn-primary',
						'data-pjax' => "0"
					]);
if ($classCount == 0) {
	$buttonHeaderBefore .= Html::a('<i class="fa fa-fw fa-gear fa-spin"></i> Auto Generate', [
		'auto', 
		'trainingId' => $currentTraining->id
	], [
		'class' => 'btn btn-danger'
	]);
}
$buttonHeaderBefore .= Html::a('<i class="fa fa-fw fa-plus"></i> Create Training Class', [
		'create', 
		'trainingId' => $currentTraining->id
	], [
		'class' => 'btn btn-success modal-heart',
		'data-pjax' => "0",
		'modal-title' => '<i class="fa fa-fw fa-cubes"></i> Create New Class'
	]);
$buttonHeaderBefore .= '</div>';

?>

<div class="training-class-index">
	
	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview',
	]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
	        ['class' => 'kartik\grid\SerialColumn'],
            
			[
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'class',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'editableOptions'=>['header'=>'Class', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
        
			[
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'label' => 'Subject',
				'width' => '80px',
				'format' => 'raw',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function($data) {
					return Html::a('<strong>'.$data->getTrainingClassSubjects()->count().'</strong>', Url::to(['training-class-subject/index', 'tb_training_class_id' => $data->id]), [
							'class' => 'btn btn-info btn-xs',
							'data-pjax' => "0"
						]);
				}
			],

			[
				'format' => 'raw',
				'label' => 'Schedule',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'80px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($model){
					return Html::a('<strong>SET</strong>',
						Url::to(['schedule','tb_training_class_id'=>$model->id]),
						[
							'class'=>'btn btn-default btn-xs',
							'data-pjax' => '0'
						]);
				}
			],

			[
				'class' => '\kartik\grid\BooleanColumn',
				'attribute' => 'status',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],

        	[
        		'class' => 'kartik\grid\ActionColumn',
        		'buttons' => [
					'view' => function ($url, $model) {
						$icon='<span class="glyphicon glyphicon-eye-open"></span>';
						return Html::a($icon,$url,[
							'class'=>'modal-heart',
							'data-pjax'=>"0",
							'source'=>'.table-responsive',
							'modal-title' => '<i class="fa fa-fw fa-eye"></i> Detail: '.$model->class
						]);
					},
					'update' => function ($url, $model) {
						$icon='<span class="glyphicon glyphicon-pencil"></span>';
						return Html::a($icon,$url,[
							'class'=>'modal-heart',
							'data-pjax'=>"0",
							'modal-title' => '<i class="fa fa-fw fa-pencil-square-o"></i> Editing: '.$model->class
						]);
					},
				],
        	],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			'before'=> $buttonHeaderBefore,
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],
		'responsive'=>true,
		'hover'=>true,
    ]); ?>

    <?php \yii\widgets\Pjax::end(); ?>
    <?php
		echo \hscstudio\heart\widgets\Modal::widget(['modalSize'=>'modal-lg']);
	?>

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
				'action'=>['import'],
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

</div>
