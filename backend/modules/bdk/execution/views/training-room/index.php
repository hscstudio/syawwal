<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Dropdown;
use kartik\grid\GridView;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use kartik\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;
use backend\models\ActivityRoom;
use backend\models\Room;

$this->title = 'Request Room for '.$trainingCurrent->name;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => Url::to(['training/index'])];
$this->params['breadcrumbs'][] = 'Room Request';

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>

<div class="training-room-index">

	<div class="container-fluid" style="margin:15px;">

		<div class="row">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="alert alert-info">
						<p>
							<i class="fa fa-fw fa-info-circle"></i>Use this tools below to select a room.
							After that, just wait until General decide what to do with your request.
						</p>
					</div>
					<?php
						$form = ActiveForm::begin([
					        'id' => 'order-room-form',
					        'action' => Url::to(['training-room/save']),
					        'type' => ActiveForm::TYPE_VERTICAL
					    ]);

					    echo Html::hiddenInput('tb_training_id', $trainingCurrent->id);
					?>

					<div class="col-md-3">
					<?php
						echo '<div class="form-group">';
						echo $form->field($roomModel, 'id')->label('Room List')->widget(Select2::classname(), [
						    'data' => $roomList,
						    'options' => ['placeholder' => 'Select a room ...'],
						    'pluginOptions' => [
						        'allowClear' => true
						    ],
						]);
						echo '</div>';
					?>
					</div>

					<div class="col-md-3">
					<?php
						echo '<div class="form-group">';
						echo '<label class="control-label">Start Date</label>';
						echo DateTimePicker::widget([
						    'name' => 'startTime',
						    'value' => date('d-M-Y H:i:s', strtotime($trainingCurrent->start)),
						    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
						    'pluginOptions' => [
						        'autoclose'=>true,
						        'format' => 'dd-M-yyyy H:i:s'
						    ]
						]);
						echo '</div>';
					?>
					</div>

					<div class="col-md-3">
					<?php
						echo '<div class="form-group">';
						echo '<label class="control-label">Finish Date</label>';
						echo DateTimePicker::widget([
						    'name' => 'finishTime',
						    'value' => date('d-M-Y H:i:s', strtotime($trainingCurrent->finish)),
						    'type' => DateTimePicker::TYPE_COMPONENT_APPEND,
						    'pluginOptions' => [
						        'autoclose'=>true,
						        'format' => 'dd-M-yyyy H:i:s'
						    ]
						]);
						echo '</div>';
					?>
					</div>

					<div class="col-md-3">
					<?php
						echo '<div class="form-group" style="margin-bottom:0; margin-top:24px;">';
						echo Html::submitButton('<i class="fa fa-fw fa-play"></i>Request Room', [
								'class' => 'btn btn-primary',
							]);
						echo ' ';
						echo Html::a('<i class="fa fa-fw fa-sign-out"></i>Done', Url::to(['training/index']), ['class' => 'btn btn-default']);
						echo '</div>';
					?>
					</div>

					<?php 

						ActiveForm::end();
					?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="panel panel-default">
				<div class="panel-body">
					<?php
						$gridColumns = [
							[
								'class' => 'kartik\grid\SerialColumn',
							],
							[
								'format' => 'raw',
								'label' => 'Room Name',
								'vAlign'=>'middle',
								'headerOptions'=>['class'=>'kv-sticky-column'],
								'contentOptions'=>['class'=>'kv-sticky-column'],
								'value' => function ($model){
									$room = Room::find()->where(['id' => $model->tb_room_id])->one();
									return '<div class="">'.$room->name.'</div>';
								}
							],

							[
								'format' => 'raw',
								'label' => 'Start Date',
								'vAlign'=>'middle',
								'headerOptions'=>['class'=>'kv-sticky-column'],
								'contentOptions'=>['class'=>'kv-sticky-column'],
								'value' => function ($model){
									return '<div class="">'.date('D, d M Y (H:i:s)', strtotime($model->startTime)).'</div>';
								}
							],

							[
								'format' => 'raw',
								'label' => 'End Date',
								'vAlign'=>'middle',
								'headerOptions'=>['class'=>'kv-sticky-column'],
								'contentOptions'=>['class'=>'kv-sticky-column'],
								'value' => function ($model){
									return '<div class="">'.date('D, d M Y (H:i:s)', strtotime($model->finishTime)).'</div>';
								}
							],

							[
								'format' => 'raw',
								'label' => 'Status',
								'vAlign'=>'middle',
								'hAlign' => 'center',
								'headerOptions'=>['class'=>'kv-sticky-column'],
								'contentOptions'=>['class'=>'kv-sticky-column'],
								'value' => function ($model){
									if ($model->status == 0)
									{
										return '<div class="label label-warning" data-toggle="tooltip" data-placement="top" title="Waiting for approval..."><i class="fa fa-fw fa-spinner fa-spin"></i></div>';
									}
									if ($model->status == 1)
									{
										return '<div class="label label-info" data-toggle="tooltip" data-placement="top" title="Processing..."><i class="fa fa-fw fa-play"></i></div>';
									}
									if ($model->status == 2)
									{
										return '<div class="label label-success" data-toggle="tooltip" data-placement="top" title="Approved!"><i class="fa fa-fw fa-check"></i></div>';
									}
									if ($model->status == 3)
									{
										return '<div class="label label-danger" data-toggle="tooltip" data-placement="top" title="Rejected!"><i class="fa fa-fw fa-times"></i></div>';
									}
								}
							],

				            [
								'class' => 'kartik\grid\ActionColumn',
								'buttons' => [
									'view' => function ($url, $model) {
												return '';
											},
									'update' => function ($url, $model) {
												return '';
											},
									'delete' => function ($url, $model) {
												if ($model->status == 0)
												{
													$icon='<i class="fa fa-fw fa-trash-o"></i>';
													return Html::a($icon,$url,[
													'title'=>"Delete",'data-confirm'=>"Are you sure to delete this item?",'data-method'=>"post",
													]);
												}
											},
								],			
							],
						];
						echo GridView::widget([
						    'dataProvider'=> $activityRoomDP,
						    'columns' => $gridColumns,
						    'rowOptions' => function($model)
						    {
						    	if ($model->status == 0)
						    	{
						    		return ['class' => 'warning'];
						    	}

						    	if ($model->status == 1)
						    	{
						    		return ['class' => 'info'];
						    	}
						    	
						    	if ($model->status == 2)
						    	{
						    		return ['class' => 'success'];
						    	}
						    	
						    	if ($model->status == 3)
						    	{
						    		return ['class' => 'danger'];
						    	}
						    },
						    'striped' => false
						]);
					?>
				</div>
			</div>
		</div>

	</div>

</div>
