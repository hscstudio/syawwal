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
		'id'=>'pjax2-gridview',
	]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
			[
				'attribute' => 'tb_room_id',
				'vAlign'=>'middle',
				//'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'label'=>'Room',
				'value' => function ($data) {
					return $data->room->name;
				}
			], 
			[
				'attribute' => 'startTime',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'175px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data){	
					return date('d-M-Y H:i:s',strtotime($data->startTime));
				}
			],
		
			[
				'attribute' => 'finishTime',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'175px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data){	
					return date('d-M-Y H:i:s',strtotime($data->finishTime));
				}
			],
		
			[
				'format' => 'raw',
				'attribute' => 'status',
				'vAlign'=>'middle',
				'hAlign'=>'center',
				'width'=>'80px',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value' => function ($data){									
					if ($data->status==1){
						$label='label label-info';
						$title='Process';
					}	
					else if ($data->status==2){ 
						$label='label label-success';
						$title='Approved';
					}
					else if ($data->status==3){ 
						$label='label label-danger';
						$title='Rejected';
					}
					else {
						$label='label label-warning';
						$title='Waiting';
					}
					return Html::tag('span', $title, ['class'=>$label,'title'=>$data->note,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer']);
				}
			],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Room</h3>',
			//'type'=>'primary',
			'before'=>'',
			'after'=>Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['room','activity_id'=>$activity->id], ['class' => 'btn btn-info']),
			'showFooter'=>false
		],
		'responsive'=>true,
		'hover'=>true,
    ]); ?>
	<?php \yii\widgets\Pjax::end(); ?>

</div>
