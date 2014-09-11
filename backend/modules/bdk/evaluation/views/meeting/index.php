<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;

$this->title = 'Meetings';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="meeting-index">

	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview',
	]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

			[
				'attribute' => 'name',
				'format'=>'raw',
				'vAlign'=>'middle',
				'hAlign'=>'left',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data){
					return Html::tag('span', $data->name, ['title'=>$data->note,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer']);
				},
			],

			[
				'attribute' => 'startTime',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'format' => 'raw',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data) {
					return '<span class="label label-info">'.date('D, d M Y',strtotime($data->startTime)).'</span> 
							<span class="label label-default">'.date('H:i:s',strtotime($data->startTime)).'</span>';
				}
			],
			[
				'attribute' => 'finishTime',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'format' => 'raw',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data) {
					return '<span class="label label-info">'.date('D, d M Y',strtotime($data->finishTime)).'</span> 
							<span class="label label-default">'.date('H:i:s',strtotime($data->finishTime)).'</span>';
				}
			],
            
			[
				'attribute' => 'attendanceCount',
				'label' => 'Peserta',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],

			],
			[
				'attribute' => 'classCount',
				'label'=>'Class',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
			[
				'format' => 'raw',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'label' => 'Room',
				'width'=>'100px',
				'value' => function ($data) {
					$activityRoom = \backend\models\ActivityRoom::find()
								->where('activity_id=:activity_id',
								[
									':activity_id' => $data->id
								]);		
					if($activityRoom->count()==0){ 
						return '<span class="label label-warning">Waiting</span>';
					}		
					else{
						return Html::a('<span class="label label-primary">'.$activityRoom->count().'</span>',['room','activity_id'=>$data->id,],['class'=>'modal-heart','data-pjax'=>0,'source'=>'','title'=>'Room : '.$data->name]);
					}
				}
			],

            [
				'class' => 'kartik\grid\ActionColumn',
				'buttons' => [
					'view' => function ($url, $model) {
						$icon='<span class="glyphicon glyphicon-eye-open"></span>';
						return Html::a($icon,$url,[
							'data-pjax'=>"0",
							'class'=>'modal-heart',
							'source'=>'.table-responsive',
							'title'=>$model->name,
						]);
					},
					'update' => function ($url, $model) {
								$activityRoom = \backend\models\ActivityRoom::find()
											->where('activity_id=:activity_id',
											[
												':activity_id' => $model->id
											]);		
								if($activityRoom->count()==0){ 
									$icon='<span class="glyphicon glyphicon-pencil"></span>';
									return Html::a($icon,$url,[
										'data-pjax'=>"0",
										'class' => 'modal-heart',
										'modal-title' => '<i class="fa fa-fw fa-pencil-square"></i> Edit Meeting'
									]);
								}		
								else{
									return "";
								}
								
							},
					'delete' => function ($url, $model) {
								$activityRoom = \backend\models\ActivityRoom::find()
											->where('activity_id=:activity_id',
											[
												':activity_id' => $model->id
											]);		
								if($activityRoom->count()==0){ 
									$icon='<span class="glyphicon glyphicon-trash"></span>';
									return Html::a($icon,$url,[
										'title'=>"Delete",'data-confirm'=>"Are you sure to delete this item?",'data-method'=>"post",
										'data-pjax'=>"0",
									]);
								}		
								else{
									return "";
								}								
							},
				],			
			],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			'before'=>Html::a('<i class="fa fa-fw fa-plus"></i> Create Meeting', ['create'], [
					'class' => 'btn btn-success modal-heart',
					'data-pjax' => '0',
					'modal-title' => '<i class="fa fa-fw fa-plus-circle"></i> Create New Meeting'
				]).
				'<div class="pull-right" style="margin-right:5px;">'.
				Select2::widget([
					'name' => 'status', 
					'data' => ['all'=>'All','0'=>'Drafted','1'=>'Published'],
					'value' => $status,
					'options' => [
						'placeholder' => 'Status ...', 
						'class'=>'form-control', 
						'onchange'=>'
							$.pjax.reload({
								url: "'.\yii\helpers\Url::to(['index']).'?status="+$(this).val(), 
								container: "#pjax-gridview", 
								timeout: 1000,
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
	
	<?php 
	$this->registerCss('.select2-container { width: 200px !important; }');
	?>
	<?= \hscstudio\heart\widgets\Modal::widget(['modalSize'=>'modal-lg']); ?>
	<?php \yii\widgets\Pjax::end(); ?>
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
