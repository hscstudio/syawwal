<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ActivityRoom */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label'=>'Room','url'=>['room/index']];
$this->params['breadcrumbs'][] = ['label' => 'Activity Rooms', 'url' => ['index','tb_room_id'=>$tb_room_id]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="activity-room-view">
	<div class="row" style="margin:0;padding:0;">	
	<?= (Yii::$app->request->isAjax)?'<div class="col-md-8">':''; ?>
	
	<?php
	$activity_name = '';
	if($model->type==0){
		$training = \backend\models\Training::findOne($model->activity_id);
		$activity_name = $training->name;
	}
	
	if ($model->status==2){
		$label='label label-success';
		$title='Approved';
	}	
	else if ($model->status==3){ 
		$label='label label-danger';
		$title='Rejected';
	}
	else {
		$label='label label-info';
		$title='Process';
	}
	$status = Html::tag('span', $title, ['class'=>$label,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer']);
	?>
	<?php
	if(Yii::$app->request->isAjax){
		$panel = [];
	}
	else{
		$panel['heading']='<i class="fa fa-fw fa-globe"></i> '.'Activity Rooms # ' . $model->id;
		$panel['type']=DetailView::TYPE_DEFAULT;
	}
	?>
    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'panel'=>$panel,
		'buttons1'=> Html::a('<i class="fa fa-fw fa-arrow-left"></i> BACK',['index','tb_room_id'=>$tb_room_id],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]).' ',
					 /*Html::a('<i class="fa fa-fw fa-trash-o"></i> DELETE',['#'],
						['class'=>'btn btn-xs btn-danger kv-btn-delete',
						 'title'=>'Delete', 'data-method'=>'post', 'data-confirm'=>'Are you sure you want to delete this item?']),*/
        'attributes' => [
            'id',
            [
				'attribute' => 'activity_id',
				'label' => 'Activity',
				'value' => $activity_name,
			],
            [
				'attribute' => 'tb_room_id',
				'value' => $model->room->name,
			],
            'startTime',
            'finishTime',
            'note',
			[
				'format'=>'raw',
				'attribute' => 'status',
				'value' => $status,
			],
            'created',
            'createdBy',
            'modified',
            'modifiedBy',
        ],
    ]) ?>
	
	<?= (Yii::$app->request->isAjax)?'</div>':''; ?>
	
	<?php
	if(Yii::$app->request->isAjax){
		echo "<div class='col-md-4'>";
		?>
		
		<?php 
		$form = ActiveForm::begin([
			'action' => ['update','id'=>$model->id],
			'enableAjaxValidation' => false,
			'enableClientValidation' => true,
			'beforeSubmit' => "function(form) {
				if($(form).find('.has-error').length) {
					return false;
				}					
				$.ajax({
					url: form.attr('action'),
					type: 'post',
					data: form.serialize(),
					success: function(data) {
						$.pjax.reload({
							url: '".\yii\helpers\Url::to(['calendar','tb_room_id'=>$tb_room_id])."', 
							container: '#pjax-gridview', 
							timeout: 3000,
						});
						$.growl(data, {	type: 'success'	});
						$('#modal-heart').modal('hide');
					}
				});					
				return false;
			}",
		]); 
		?>
		<?= $form->field($model, 'startTime')->widget(\kartik\datecontrol\DateControl::classname(), [
						'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
					]); ?>
		<?= $form->field($model, 'finishTime')->widget(\kartik\datecontrol\DateControl::classname(), [
						'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
					]); ?>
		<?= $form->field($model, 'note')->textInput(['maxlength' => 255]) ?>
		<?= $form->field($model, 'status')->dropDownList(
			['1'=>'Process','2'=>'Approved','3'=>'Rejected'],[]
		);
		?>
		<?= Html::submitButton(
				$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update', 
				['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		<?php ActiveForm::end(); ?>
		
		<?php
		echo "</div>";
	}
	?>
	</div>
</div>
