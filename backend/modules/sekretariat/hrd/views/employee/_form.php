<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
	<?= $form->errorSummary($model) ?> <!-- ADDED HERE -->
	
    <?= '' ?>

			<?php
			$data = \yii\helpers\ArrayHelper::getColumn(\backend\models\Satker::find()->select('id,name')->all(), 'name');
			echo $form->field($model, 'ref_satker_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose Satker ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= '' ?>

			<?php
			$data = \yii\helpers\ArrayHelper::getColumn(\backend\models\Unit::find()->select('id,name')->all(), 'name');
			echo $form->field($model, 'ref_unit_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose Unit ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= '' ?>

			<?php
			$data = \yii\helpers\ArrayHelper::getColumn(\backend\models\Religion::find()->select('id,name')->all(), 'name');
			echo $form->field($model, 'ref_religion_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose Religion ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= '' ?>

			<?php
			$data = \yii\helpers\ArrayHelper::getColumn(\backend\models\RankClass::find()->select('id,name')->all(), 'name');
			echo $form->field($model, 'ref_rank_class_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose RankClass ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= '' ?>

			<?php
			$data = \yii\helpers\ArrayHelper::getColumn(\backend\models\Graduate::find()->select('id,name')->all(), 'name');
			echo $form->field($model, 'ref_graduate_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose Graduate ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>

    <?= '' ?>

			<?php
			$data = \yii\helpers\ArrayHelper::getColumn(\backend\models\StaUnit::find()->select('id,name')->all(), 'name');
			echo $form->field($model, 'ref_sta_unit_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose StaUnit ...'],
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
					 'inputTemplate' => '<div class="input-group"><span class="input-group-addon">@</span>{input}</div>',
				 ]); ?>

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

    <?= $form->field($model, 'document1')->widget(\kartik\widgets\FileInput::classname(), [
					'pluginOptions' => [
						'previewFileType' => 'any',
						'showUpload' => false,
						]
					]); ?>

    <?= $form->field($model, 'document2')->widget(\kartik\widgets\FileInput::classname(), [
					'pluginOptions' => [
						'previewFileType' => 'any',
						'showUpload' => false,
						]
					]); ?>

    <?= $form->field($model, 'blood')->textInput(['maxlength' => 10]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
