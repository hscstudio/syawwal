<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;

/* @var $searchModel backend\models\TrainingSearch */

$this->title = 'Trainings';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            	['class' => 'kartik\grid\SerialColumn'],
                        
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'name',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Name', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'start',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Start', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'finish',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Finish', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'note',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'Note', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
            
				[
					'class' => 'kartik\grid\EditableColumn',
					'attribute' => 'studentCount',
					'vAlign'=>'middle',
					'headerOptions'=>['class'=>'kv-sticky-column'],
					'contentOptions'=>['class'=>'kv-sticky-column'],
					'editableOptions'=>['header'=>'StudentCount', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
				],
				[
					'format' => 'html',
					'vAlign'=>'middle',
					'hAlign'=>'center',
					'label' => 'Status',
					'value' => function ($data)
					{
						if ($data->approvedStatus === null)
						{
							return '<p class="label label-warning"><i class="fa fa-fw fa-square"></i> Waiting for approval</p>';
						}
						elseif ($data->approvedStatus === 0) {
							return '<p class="label label-danger"><i class="fa fa-fw fa-minus-square"></i> Rejected</p>';
						}
						else
						{
							return '<p class="label label-success"><i class="fa fa-fw fa-check-square"></i> Approved</p>';
						}
					}
				],
				[
					'format' => 'html',
					'vAlign'=>'middle',
					'hAlign'=>'center',
					'label' => 'Revision',
					'value' => function ($data) {
						$countRevision = \backend\models\TrainingHistory::find()
									->where(['tb_training_id' => $data->id,])
									->count()-1;
						if($countRevision>0){
							return Html::a($countRevision.' x', ['training-history/','tb_training_id'=>$data->id], ['class' => 'label label-danger']);
						}
						else{
							return '<span class="label label-danger">0</span>';
						}
					}
				],

            ['class' => 'kartik\grid\ActionColumn'],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			'before'=>Html::a('<i class="fa fa-fw fa-plus"></i> Create Training', ['create'], ['class' => 'btn btn-success']),
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
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
