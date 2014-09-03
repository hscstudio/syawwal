<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;

/* @var $searchModel backend\models\RoomSearch */

$this->title = $activity->name;
$this->params['breadcrumbs'][] = ['label' => 'Meetings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="room-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	<?php \yii\widgets\Pjax::begin([
		'id'=>'pjax-gridview',
	]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
			[
				'attribute' => 'code',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],            
			[
				'attribute' => 'name',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
			],
            
			[
				//'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'capacity',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				//'editableOptions'=>['header'=>'Capacity', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
		
			[
				//'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'computer',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				//'editableOptions'=>['header'=>'Computer', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
		
			[
				//'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'hostel',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'100px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				//'editableOptions'=>['header'=>'Hostel', 'size'=>'md','formOptions'=>['action'=>\yii\helpers\Url::to('editable')]]
			],
			[
				'format' => 'raw',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'label' => 'Waiting',
				'width'=>'80px',
				'value' => function ($data) {
					$countWaiting = \backend\models\ActivityRoom::find()
								->where(['tb_room_id' => $data->id,'status' => 0])
								->count();
					if($data->ref_satker_id==Yii::$app->user->identity->employee->ref_satker_id){
						return Html::a($countWaiting, ['activity-room/index','tb_room_id'=>$data->id], ['class' => 'label label-warning','data-pjax'=>0]).
							' '.
							Html::a('<span class="fa fa-calendar"></span>',['activity-room/calendar','tb_room_id'=>$data->id],['data-pjax'=>"0",]);
					}
					else{
						return '-';
					}
				}
			],
			[
				'format' => 'raw',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'label' => 'Availability',
				'width'=>'80px',
				'value' => function ($data) use ($activity) {
					/*
					SELECT * FROM tb_room 
						WHERE id NOT IN (
							SELECT tb_room_id FROM tb_meeting_room
							WHERE 
								(start between $meeting_start AND $meeting_finish)
								OR
								(finish between $meeting_start AND $meeting_finish)
						)*/
					$start = $activity->startTime;
					$finish = $activity->finishTime;
					$activityCount = \backend\models\ActivityRoom::find()
								->where('
									tb_room_id = :tb_room_id 
									AND
									((startTime between :start AND :finish)
										OR (finishTime between :start AND :finish))
									AND 
									status = :status
								',
								[
									'tb_room_id' => $data->id,
									'start' => $start,
									'finish' => $finish,
									'status' => 1
								])
								->count();
					if($activityCount==0) 
						return 
							Html::a('<span class="fa fa-check-square"></span>', ['activity-room/set','tb_room_id'=>$data->id], ['class' => 'label label-primary','data-pjax'=>0]).' '.
							Html::a('<span class="fa fa-times"></span>', ['activity-room/index','tb_room_id'=>$data->id], ['class' => 'label label-danger','data-pjax'=>0]);
					else
						return "-";
					
					/*					
					if($data->ref_satker_id==Yii::$app->user->identity->employee->ref_satker_id){
						return Html::a($countWaiting, ['activity-room/index','tb_room_id'=>$data->id], ['class' => 'label label-warning','data-pjax'=>0]).
							' '.
							Html::a('<span class="fa fa-calendar"></span>',['activity-room/calendar','tb_room_id'=>$data->id],['data-pjax'=>"0",]);
					}
					else{
						return '-';
					}*/
				}
			],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Set Room</h3>',
			//'type'=>'primary',
			'before'=>
				'<div class="pull-right" style="margin-right:5px;">'.
				Select2::widget([
					'name' => 'ref_satker_id', 
					'data' => $satkers,
					'value' => $ref_satker_id,
					'options' => [
						'width'=> '200px;',
						'placeholder' => 'Satker ...', 
						'class'=>'form-control', 
						'onchange'=>'
							$.pjax.reload({
								url: "'.\yii\helpers\Url::to(['room','activity_id'=>$activity_id]).'&ref_satker_id="+$(this).val(), 
								container: "#pjax-gridview", 
								timeout: 1,
							});
						',	
					],
				]).
				'</div>',
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['room','activity_id'=>$activity_id,'ref_satker_id'=>$ref_satker_id], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],
		'responsive'=>true,
		'hover'=>true,
    ]); ?>
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
		
		
		
	echo Html::endTag('div');
	?>

</div>
