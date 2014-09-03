<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;

/* @var $searchModel backend\models\RoomSearch */

$this->title = 'Rooms';
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
				'class' => 'kartik\grid\ActionColumn',
				'template'=> '{view} {update} {delete}',
				'buttons' => [
					'update' => function ($url, $model) {
								$icon='<span class="glyphicon glyphicon-pencil"></span>';
								if($model->ref_satker_id==Yii::$app->user->identity->employee->ref_satker_id){
									return Html::a($icon,$url,['data-pjax'=>"0",]);
								}
								else{
									return '';
								}								
							},
					'delete' => function ($url, $model) {
								$icon='<span class="glyphicon glyphicon-trash"></span>';
								if($model->ref_satker_id==Yii::$app->user->identity->employee->ref_satker_id){
									return Html::a($icon,$url,[
										'title'=>"Delete",'data-confirm'=>"Are you sure to delete this item?",'data-method'=>"post",
										'data-pjax'=>"0",
									]);
								}
								else{
									return '';
								}	
								
							},
				],			
			],
        ],
		'panel' => [
			//'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i> Room</h3>',
			'heading'=>'<h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>',
			//'type'=>'primary',
			'before'=>Html::a('<i class="fa fa-fw fa-plus"></i> Create Room', ['create'], ['class' => 'btn btn-success']).
				'<div class="pull-right" style="margin-right:5px;">'.
				Select2::widget([
					'name' => 'status', 
					'data' => ['1'=>'Published','0'=>'Unpublished','all'=>'All'],
					'value' => $status,
					'options' => [
						'placeholder' => 'Status ...', 
						'class'=>'form-control', 
						'onchange'=>'
							$.pjax.reload({
								url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/room/index']).'?ref_satker_id='.$ref_satker_id.'&status="+$(this).val(), 
								container: "#pjax-gridview", 
								timeout: 1,
							});
						',	
					],
				]).
				'</div>'.
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
								url: "'.\yii\helpers\Url::to(['/'.$controller->module->uniqueId.'/room/index']).'?status='.$status.'&ref_satker_id="+$(this).val(), 
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
