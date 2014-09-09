<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="student-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<i class="fa fa-fw fa-globe"></i> 
		Student
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		Please Fill This Form Correctly !</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		'type' => ActiveForm::TYPE_VERTICAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>
<div class="row">
  <div class="col-md-4">
  <?= $form->field($model, 'frontTitle')->textInput(['maxlength' => 20]) ?>
  </div>
  <div class="col-md-4">
  <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>
  </div>
  <div class="col-md-4">
  <?= $form->field($model, 'backTitle')->textInput(['maxlength' => 20]) ?>
  </div>
</div>	
<div class="row">
  <div class="col-md-4">
  <?= $form->field($model, 'nickName')->textInput(['maxlength' => 50]) ?>
  </div>
  <div class="col-md-4">
  <?= $form->field($model, 'nip')->textInput(['maxlength' => 18]) ?>
  </div>
  <div class="col-md-4">
  <?= $form->field($model, 'password')->textInput(['maxlength' => 60,'placeholder'=>'Biarkan Kosong Jika Tidak Ingin Di Ubah...']) ?>
  </div>
</div>	
<div class="row">
  <div class="col-md-6">
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
  </div>
  <div class="col-md-6">
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
  </div>
</div>
<div class="row">
  <div class="col-md-6">
  <?= $form->field($model, 'eselon2')->textInput(['maxlength' => 100]) ?>
  </div>
  <div class="col-md-6">
  <?= $form->field($model, 'position')->textInput(['maxlength' => 255]) ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
  <?= $form->field($model, 'eselon3')->textInput(['maxlength' => 100]) ?>
  </div>
  <div class="col-md-6">
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
  </div>
</div>
<div class="row">
  <div class="col-md-6">
   <?= $form->field($model, 'eselon4')->textInput(['maxlength' => 100]) ?>
  </div>
  <div class="col-md-6">
  <?= $form->field($model, 'education')->textInput(['maxlength' => 255]) ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
  <?= $form->field($model, 'satker')->dropDownList([ 2 => '2', 3 => '3', 4 => '4', ], ['prompt' => '']) ?>
  </div>
  <div class="col-md-6">
  <?= $form->field($model, 'blood')->textInput(['maxlength' => 10]) ?>
  </div>
</div>
<div class="row">
  <div class="col-md-4">
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

  </div>
  <div class="col-md-4">
  <?= $form->field($model, 'born')->textInput(['maxlength' => 50]) ?>
  </div>
  <div class="col-md-4">
  <?= $form->field($model, 'birthDay')->widget(\kartik\datecontrol\DateControl::classname(), [
					'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
				]); ?>
  </div>
</div>	
<div class="row">
      <div class="col-md-4">
      <?= $form->field($model, 'gender')->widget(\kartik\widgets\SwitchInput::classname(), [
                        'pluginOptions' => [
                            'onText' => 'Male',
                            'offText' => 'Female',
                        ]
                    ]) ?>
      </div>
      <div class="col-md-4">
      <?= $form->field($model, 'married')->widget(\kartik\widgets\SwitchInput::classname(), [
                        'pluginOptions' => [
                            'onText' => 'On',
                            'offText' => 'Off',
                        ]
                    ]) ?>
      </div>
      <div class="col-md-4">
      <?= $form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [
                        'pluginOptions' => [
                            'onText' => 'On',
                            'offText' => 'Off',
                        ]
                    ]) ?>
    
      </div>
</div>
<div class="row">
  <div class="col-md-4">
  <?= $form->field($model, 'tmtSKPangkat')->widget(\kartik\datecontrol\DateControl::classname(), [
					'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
				]); ?>
  </div>
  <div class="col-md-4">
  <?= $form->field($model, 'noSKPangkat')->textInput(['maxlength' => 255]) ?>
  </div>
  <div class="col-md-4">
  <?= $form->field($model, 'fileSKPangkat')->widget(\kartik\widgets\FileInput::classname(), [
					'pluginOptions' => [
						'previewFileType' => 'any',
						'showUpload' => false,
						]
					]); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
  <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>
  </div>
  <div class="col-md-6">
  <?= $form->field($model, 'officeAddress')->textInput(['maxlength' => 255]) ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
  <?= $form->field($model, 'phone')->textInput(['maxlength' => 50]) ?>
  </div>
  <div class="col-md-6">
  <?= $form->field($model, 'officePhone')->textInput(['maxlength' => 50]) ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
  <?= $form->field($model, 'email', [
					 'addon' => ['prepend' => ['content'=>'@']]
				 ]); ?>
  </div>
  <div class="col-md-6">
  <?= $form->field($model, 'officeEmail',[
					 'addon' => ['prepend' => ['content'=>'@']]
				 ]); ?>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
  <?= $form->field($model, 'photo')->widget(\kartik\widgets\FileInput::classname(), [
					'pluginOptions' => [
						'previewFileType' => 'any',
						'initialPreview'=>[							
							Html::img(\yii\helpers\Url::to(['/file/download','file'=>'student/'.$model->id.'/'.$model->photo]), ['class'=>'file-preview-image', 'alt'=>$model->photo, 'title'=>$model->photo]),
							],
						'showUpload' => false,
						]
					]); ?>
  </div>
  <div class="col-md-6">
  <?= $form->field($model, 'officeFax')->textInput(['maxlength' => 50]) ?>
  </div>
</div>   

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
