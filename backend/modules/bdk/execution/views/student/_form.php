<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="student-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i>',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		Student	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		'type' => ActiveForm::TYPE_HORIZONTAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>
	
    <?= '' ?>

			<?php
			$data = ArrayHelper::map(\backend\models\Religion::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
			echo $form->field($model, 'ref_religion_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose Religion ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= '' ?>

			<?php
			$data = ArrayHelper::map(\backend\models\Graduate::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
			echo $form->field($model, 'ref_graduate_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose Graduate ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= '' ?>

			<?php
			$data = ArrayHelper::map(\backend\models\RankClass::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
			echo $form->field($model, 'ref_rank_class_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose RankClass ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= '' ?>

			<?php
			$data = ArrayHelper::map(\backend\models\Unit::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
			echo $form->field($model, 'ref_unit_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose Unit ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= $form->field($model, 'gender')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'Male',
						'offText' => 'Female',
					]
				]) ?>

    <?= $form->field($model, 'married')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				]) ?>

    <?= $form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				]) ?>

    <?= ""//createdBy ?>

    <?= ""//modifiedBy ?>

    <?= ""//deletedBy ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'birthDay')->widget(\kartik\datecontrol\DateControl::classname(), [
					'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
				]); ?>

    <?= $form->field($model, 'tmtSKPangkat')->widget(\kartik\datecontrol\DateControl::classname(), [
					'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
				]); ?>

    <?= ""//created ?>

    <?= ""//modified ?>

    <?= ""//deleted ?>

    <?= $form->field($model, 'nickName')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'born')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'officePhone')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'officeFax')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'frontTitle')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'backTitle')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'nip')->textInput(['maxlength' => 18]) ?>

    <?= $form->field($model, 'email', [
					 'addon' => ['prepend' => ['content'=>'@']]
				 ]); ?>

    <?= $form->field($model, 'eselon2')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'eselon3')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'eselon4')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'officeEmail')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'photo')->widget(\kartik\widgets\FileInput::classname(), [
					'pluginOptions' => [
						'previewFileType' => 'any',
						'showUpload' => false,
						]
					]); ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'education')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'officeAddress')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'noSKPangkat')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'fileSKPangkat')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'blood')->textInput(['maxlength' => 10]) ?>

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
