<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use yii\bootstrap\Dropdown;

$this->title = 'Rooms';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="room-index">

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
					'attribute' => 'code',
					'vAlign'=>'middle',
					'width' => '100px',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Code', 'size'=>'md','formOptions'=>['action'=>Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'name',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Name', 'size'=>'md','formOptions'=>['action'=>Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'capacity',
					'vAlign'=>'middle',
					'width' => '80px',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Capacity', 'size'=>'md','formOptions'=>['action'=>Url::to('editable')]]
				],
            
				[
					'class' => '\kartik\grid\BooleanColumn',
			        'trueLabel' => 'Yes', 
			        'falseLabel' => 'No',
					'attribute' => 'owner',
					'vAlign'=>'middle',
					'width' => '80px',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
				],
            
				[
					'class' => '\kartik\grid\BooleanColumn',
			        'trueLabel' => 'Yes', 
			        'falseLabel' => 'No',
					'attribute' => 'computer',
					'vAlign'=>'middle',
					'width' => '80px',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
				],
            
				[
					'class' => '\kartik\grid\BooleanColumn',
			        'trueLabel' => 'Yes', 
			        'falseLabel' => 'No',
					'attribute' => 'hostel',
					'vAlign'=>'middle',
					'width' => '80px',
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
								'title'=> 'See Detail',
								'modal-title' => '<i class="fa fa-fw fa-eye"></i> Detail: '.$model->name
							]);
						},
						'update' => function ($url, $model) {
							$icon='<span class="glyphicon glyphicon-pencil"></span>';
							return Html::a($icon,$url,[
								'class'=>'modal-heart',
								'data-pjax'=>"0",
								'modal-title' => '<i class="fa fa-fw fa-pencil-square-o"></i> Editing: '.$model->name
							]);
						},
					],
            	],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			'before'=>Html::a('<i class="fa fa-fw fa-plus"></i> Create Room', ['create'], [
						'class' => 'modal-heart btn btn-success',
						'data-pjax' => "0",
						'modal-title' => '<i class="fa fa-fw fa-inbox"></i> Create New Room'
					]).
					'<div class="pull-right" style="margin-right:5px;">'.
					Select2::widget([
						'name' => 'status', 
						'data' => ['1'=>'Published','0'=>'Hidden','all'=>'All'],
						'value' => $status,
						'options' => [
							'placeholder' => 'Status ...', 
							'class'=>'form-control', 
							'onchange'=>'
								$.pjax.reload({
									url: "'.Url::to(['/'.$controller->module->uniqueId.'/room/index']).'?status="+$(this).val(), 
									container: "#pjax-gridview", 
									timeout: 1,
								});
							',	
						],
					]).
					'</div>',
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
