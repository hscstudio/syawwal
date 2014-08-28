<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
/* @var $this yii\web\View */
/* @var $model backend\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="employee-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i> BACK',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		Employee	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		//'type' => ActiveForm::TYPE_HORIZONTAL,
		'type' => ActiveForm::TYPE_VERTICAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>   
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          Data Account
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
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
          <div class="col-md-6">
          <?= $form->field($model, 'nip')->textInput(['maxlength' => 18]) ?>
          </div>
          <div class="col-md-6">
          <?= $form->field($model, 'nickName')->textInput(['maxlength' => 50]) ?>
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
			$data = ArrayHelper::map(\backend\models\Religion::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
			echo $form->field($model, 'ref_religion_id')->widget(Select2::classname(), [
				'data' => $data,
				'options' => ['placeholder' => 'Choose Religion ...'],
				'pluginOptions' => [
				'allowClear' => true
				],
			]); ?>
      </div>
    </div>   
    <div class="row">
      <div class="col-md-6">
      <?= '' ?>
			<?php
			$data = ArrayHelper::map(\backend\models\Satker::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
				// Nambah dropdown eselon 2
				echo $form->field($model, 'ref_satker_id')->widget(Select2::classname(), [
				    'data' => $data,
				    'options' => [
				    	'placeholder' => 'Choose Satker ID ...',
				    	'class' => 'col-md-10 form-control',
				    	'id' => 'ref_satker_id',
				    	'onchange' => '	$.post("'.Yii::$app->urlManager->createUrl(['sekretariat-hrd/employee/subcat']).'", 
				    					{ ref_satker_id: $(this).val() })
				    					.done(function( data ) {
				       						$( "select#ref_sub_satker" ).html( data );
				        				})'
					],
				    'pluginOptions' => [
				        'allowClear' => true
				    ],
				]);
			?>
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
       <?= '' ?>

			<?php
			$data = ArrayHelper::map(\backend\models\StaUnit::find()->select(['id','induk','name'])->where(['induk' =>$model->ref_satker_id])->all(), 'id', 'name');
			echo $form->field($model, 'ref_sub_satker')->widget(Select2::classname(), [
				'data' => $data,
				'options' => [
						'id' => 'ref_sub_satker',
						'placeholder' => 'Choose Sta Unit ...',
						'onchange' => '	$.post("'.Yii::$app->urlManager->createUrl(['sekretariat-hrd/employee/prod']).'", 
				    					{ ref_sub_satker: $(this).val() })
				    					.done(function( data ) {
				       						$( "select#ref_sub_satker_2" ).html( data );
				        				})'
					],
				'pluginOptions' => [
						'allowClear' => true
				],
			]);
			?>
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
       <?= '' ?>
    
    		<?php
			$data = ArrayHelper::map(\backend\models\StaUnit::find()->select(['id','induk','name'])->where(['id' =>$model->ref_sta_unit_id])->all(), 'id', 'name');
			echo $form->field($model, 'ref_sub_satker_2')->widget(Select2::classname(), [
				'data' => $data,
				'options' => [
						'id' => 'ref_sub_satker_2',
						'placeholder' => 'Choose Sta Unit 2...',
					],
				'pluginOptions' => [
						'allowClear' => true
				],
			]);
			?>
      </div>
      <div class="col-md-6">
       <?= $form->field($model, 'education')->textInput(['maxlength' => 255]) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
      <?= $form->field($model, 'position')->textInput(['maxlength' => 255]) ?>
      </div>
      <div class="col-md-6">
      <?= $form->field($model, 'blood')->textInput(['maxlength' => 10]) ?>
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
      <div class="col-md-6">
      <?= $form->field($model, 'born')->textInput(['maxlength' => 50]) ?>
      </div>
      <div class="col-md-6">
      <?= $form->field($model, 'birthDay')->widget(\kartik\datecontrol\DateControl::classname(), [
					'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
				]); ?>
      </div>
    </div>  
	<div class="row">
      <div class="col-md-4">
      <?= $form->field($model, 'phone')->textInput(['maxlength' => 50]) ?>
      </div>
      <div class="col-md-4">      
      <?= $form->field($model, 'officePhone')->textInput(['maxlength' => 50]) ?>    
      </div>
      <div class="col-md-4">
      <?= $form->field($model, 'officeFax')->textInput(['maxlength' => 50]) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
      <?= $form->field($model, 'email', [
					 'addon' => ['prepend' => ['content'=>'@']]
				 ]); ?>
      </div>
      <div class="col-md-6">
      <?= $form->field($model, 'officeEmail')->textInput(['maxlength' => 100]) ?>
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
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          Document
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse">
      <div class="panel-body">
        <?= $form->field($model, 'bio')->textarea(['rows' => 6]) ?>    

    <?= $form->field($model, 'photo')->widget(\kartik\widgets\FileInput::classname(), [
					'pluginOptions' => [
						'previewFileType' => 'any',
						'showUpload' => false,
						]
					]); ?>

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
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          Another Data Account
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse">
      <div class="panel-body">
        <?= $form->field($model, 'public_email')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'gravatar_email')->textInput(['maxlength' => 255]) ?>
    
        <?= $form->field($model, 'location')->textInput(['maxlength' => 255]) ?>
    
        <?= $form->field($model, 'website')->textInput(['maxlength' => 255]) ?>
    
        <?= $form->field($model, 'gravatar_id')->textInput(['maxlength' => 32]) ?>
      </div>
    </div>
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
