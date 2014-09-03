<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;

/* @var $searchModel backend\models\ActivityRoomSearch */

$this->title = 'Activity Rooms : '.$room->name;
$this->params['breadcrumbs'][] = ['label'=>'Room','url'=>['room/index']];
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="activity-room-index">

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
				'class' => 'kartik\grid\EditableColumn',
				'attribute' => 'activity_id',
				'label'=>'Activity',
				'vAlign'=>'middle',
				'headerOptions'=>['class'=>'kv-sticky-column'],
				'contentOptions'=>['class'=>'kv-sticky-column'],
				'value'=>  function ($data){
					if($data->type==0){
						$training = \backend\models\Training::findOne($data->activity_id);
						return $training->name;
					}
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
						$label='label label-success';
						$title='Approved';
					}	
					else if ($data->status==2){ 
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

            ['class' => 'kartik\grid\ActionColumn'],
        ],
		'panel' => [
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			'before'=>Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Room', ['room/index'], ['class' => 'btn btn-warning']).' '.
				Html::a('<i class="fa fa-fw fa-plus"></i> Create Activity Room', ['create'], ['class' => 'btn btn-success']).
				'<div class="pull-right" style="margin-right:5px;">'.
				Select2::widget([
					'name' => 'status', 
					'data' => ['all'=>'All','0'=>'Waiting','1'=>'Approved','2'=>'Rejected'],
					'value' => $status,
					'options' => [
						'placeholder' => 'Status ...', 
						'class'=>'form-control', 
						'onchange'=>'
							$.pjax.reload({
								url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/activity-room/index']).'?tb_room_id='.$tb_room_id.'&status="+$(this).val(), 
								container: "#pjax-gridview", 
								timeout: 1000,
							});
						',	
					],
				]).
				'</div>',
			'after'=>
			Html::a('<i class="fa fa-fw fa-calendar"></i> Calendar', ['calendar','tb_room_id'=>$tb_room_id], ['class' => 'btn btn-warning','data-pjax'=>0]).' '.
			Html::a('<i class="fa fa-fw fa-repeat"></i> Reset Grid', ['index','tb_room_id'=>$tb_room_id], ['class' => 'btn btn-info']),
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
