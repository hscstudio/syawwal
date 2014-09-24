<?php

use yii\helpers\Html;
use yii\bootstrap\Dropdown;
use yii\helpers\Inflector;
use yii\helpers\Url;
use kartik\grid\GridView;

$this->title = 'Trainer List : ';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>

<div class="training-class-subject-trainer-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            
			[
				'format'=>'raw',
				'attribute' => 'tb_trainer_id',
				'vAlign'=>'middle',
				'label' => 'Trainer',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data) {
					return $data->trainer->name;
				}
			],
			
			[
				'format'=>'raw',
				'label' => 'Trainer Type',
				'attribute' => 'ref_trainer_type_id',
				'vAlign'=>'middle',
				'hAlign'=>'center',				
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data) {
					return '<span class="label label-default">'.$data->trainerType->name.'</span>';
				}
			],

			[
				'format'=>'raw',
				'label' => 'Cost',
				'attribute' => 'cost',
				'vAlign'=>'middle',
				'hAlign'=>'center',				
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data) {
					return '<span class="label label-success">Rp '.number_format($data->cost, 0, ',', '.').'</span>';
				}
			],
		
			[
				'class' => 'kartik\grid\BooleanColumn',
				'attribute' => 'status',
				'trueLabel' => 'Yes', 
        		'falseLabel' => 'No',
        		'width' => '80px',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
            
            ['class' => 'kartik\grid\ActionColumn'],
        ],
		'panel' => [
			'heading' => '<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			
			'before' => '<div class="btn-group">'.
				Html::a('<i class="fa fa-fw fa-arrow-circle-left"></i> Back ', [
					'training-class-subject/index',
					'tb_training_class_id' => $tb_training_class_id
				], ['class' => 'btn btn-primary']).' '.
				Html::a('<i class="fa fa-fw fa-plus"></i> Create', [
					'create',
					'tb_training_class_subject_id' => (int)$tb_training_class_subject_id,
				], ['class' => 'btn btn-success']).
				'</div>',

			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', [
				'index',
				'tb_training_class_subject_id' => (int)$tb_training_class_subject_id,
			], ['class' => 'btn btn-info']),
			
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
