<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\ActivityRoom */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="activity-room-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i>',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		ActivityRoom	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		'type' => ActiveForm::TYPE_HORIZONTAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>
	
    <?= $form->field($model, 'type')->textInput(['maxlength' => 3]) ?>

    <?= $form->field($model, 'activity_id')->textInput() ?>

    <?= '' ?>

			<?php
			$data = ArrayHelper::map(\backend\models\Room::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
			echo $form->field($model, 'tb_room_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose Room ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= $form->field($model, 'startTime')->widget(\kartik\datecontrol\DateControl::classname(), [
					'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
				]); ?>

    <?= $form->field($model, 'finishTime')->widget(\kartik\datecontrol\DateControl::classname(), [
					'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
				]); ?>

    <?= $form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				]) ?>

    <?= ""//createdBy ?>

    <?= ""//modifiedBy ?>

    <?= ""//created ?>

    <?= ""//modified ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
		<label class="col-md-2 control-label"></label>
		<div class="col-md-10">
        <?= Html::submitButton(
			$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update', 
			['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	</div>
	
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
