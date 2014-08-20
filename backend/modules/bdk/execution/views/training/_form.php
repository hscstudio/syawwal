<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;

/* @var $this yii\web\View */
/* @var $model backend\models\Training */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="training-form">

	<div class="panel panel-default">
		
		<div class="panel-heading">
			<div class="pull-right">
			<?= Html::a('<i class="fa fa-arrow-left"></i>',['index'],
							['class'=>'btn btn-xs btn-primary',
							 'title'=>'Back to Index',
							]) ?>
			</div>
			<i class="fa fa-fw fa-globe"></i> 
			Training	
		</div>

		<div class="panel-body" style="margin:10px">
		    <?php $form = ActiveForm::begin([
				'type' => ActiveForm::TYPE_VERTICAL,
				'options'=>['enctype'=>'multipart/form-data']
			]); ?>
			<?= $form->errorSummary($model) ?>
			
		    <?= '' ?>

			<?php
				// Nambah dropdown eselon 2
				echo '
					<div class="form-group field-training-eselon">
						<label class="control-label" for="eselon">Eselon 2</label>';
				echo Select2::widget([
				    'name' => 'eselon',
				    'data' => $dataEs2,
				    'options' => [
				    	'placeholder' => 'Choose eselon 2 ...',
				    	'class' => 'col-md-10 form-control',
				    	'id' => 'eselon',
				    	'onchange' => '	$.post("'.Yii::$app->urlManager->createUrl(['bdk-execution/training/program']).'", 
				    					{ eselon: $(this).val() })
				    					.done(function( data ) {
				       						$( "select#training-tb_program_id" ).html( data );
				        				})'
					],
				    'pluginOptions' => [
				        'allowClear' => true
				    ],
				]);
				echo '</div>';
			?>

			<?php
				$data = ArrayHelper::map(\backend\models\Program::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
				echo $form->field($model, 'tb_program_id')->widget(Select2::classname(), [
					'data' => $data,
					'options' => [
						'id' => 'training-tb_program_id',
						'placeholder' => 'Choose Program ...',
					],
					'pluginOptions' => [
						'allowClear' => true
					],
				]); 
			?>

		    <?php 

		    	if ($model->isNewRecord)
		    	{

			    	echo $form->field($model, 'revision')->widget(DepDrop::classname(), [
					    'type' => DepDrop::TYPE_SELECT2,
					    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
					    'options'=>[
					    	'id' => 'training-revision',
					    ],
					    'pluginOptions'=>[
					        'depends'=>['training-tb_program_id'],
					        'placeholder'=>'Select a revision of a program...',
					        'url'=>Yii::$app->urlManager->createUrl(['bdk-execution/training/rev']),
					        'loadingText' => 'Finding revision ...',
					    ]
					]);
		    	}
		    	else
		    	{
			    	$data = \backend\models\ProgramHistory::find()
					        ->select(['revision', 'name'])
					        ->where(['tb_program_id' => $model->tb_program_id, 'revision' => $model->revision])
					        ->one();

			    	echo $form->field($model, 'revision')->widget(DepDrop::classname(), [
			    		'data'=> [ $data->revision => $data->name ],
					    'type' => DepDrop::TYPE_SELECT2,
					    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
					    'options'=>[
					    	'id' => 'training-revision',
					    ],
					    'pluginOptions'=>[
					        'depends'=>['training-tb_program_id'],
					        'placeholder'=>'Select a revision of a program...',
					        'url'=>Yii::$app->urlManager->createUrl(['bdk-execution/training/rev']),
					        'loadingText' => 'Finding revision ...',
					        'initialize' => true
					    ]
					]);
		    	}
		    ?>

		    <?= '' ?>

					<?php
					$data = ArrayHelper::map(\backend\models\Satker::find()->select(['id','name'])->asArray()->all(), 'id', 'name');
					echo $form->field($model, 'ref_satker_id')->widget(Select2::classname(), [
						'data' => $data,
						'options' => ['placeholder' => 'Choose Satker ...'],
						'pluginOptions' => [
						'allowClear' => true
						],
					]); ?>

		    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

		    <?= $form->field($model, 'approvedStatus')->widget(\kartik\widgets\SwitchInput::classname(), [
							'pluginOptions' => [
								'onText' => 'On',
								'offText' => 'Off',
							]
						]) ?>

		    <?= $form->field($model, 'approvedStatusNote')->textInput(['maxlength' => 255]) ?>

		    <?= $form->field($model, 'approvedStatusDate')->widget(\kartik\datecontrol\DateControl::classname(), [
							'type' => \kartik\datecontrol\DateControl::FORMAT_DATETIME,
						]); ?>

		    <?= $form->field($model, 'approvedStatusBy')->textInput() ?>

		    <?= $form->field($model, 'studentCount')->textInput() ?>

		    <?= $form->field($model, 'classCount')->textInput(['maxlength' => 3]) ?>

		    <?= $form->field($model, 'costPlan')->textInput() ?>

		    <?= $form->field($model, 'costRealisation')->textInput() ?>

		    <?= $form->field($model, 'hostel')->widget(\kartik\widgets\SwitchInput::classname(), [
							'pluginOptions' => [
								'onText' => 'On',
								'offText' => 'Off',
							]
						]) ?>

		    <?= $form->field($model, 'reguler')->widget(\kartik\widgets\SwitchInput::classname(), [
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

		    <?= $form->field($model, 'start')->widget(\kartik\datecontrol\DateControl::classname(), [
							'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
						]); ?>

		    <?= $form->field($model, 'finish')->widget(\kartik\datecontrol\DateControl::classname(), [
							'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
						]); ?>

		    <?= ""//created ?>

		    <?= ""//modified ?>

		    <?= ""//deleted ?>

		    <?= $form->field($model, 'note')->textInput(['maxlength' => 255]) ?>

		    <?= $form->field($model, 'executionSK')->textInput(['maxlength' => 255]) ?>

		    <?= $form->field($model, 'resultSK')->textInput(['maxlength' => 255]) ?>

		    <?= $form->field($model, 'sourceCost')->textInput(['maxlength' => 255]) ?>

		    <?= $form->field($model, 'stakeholder')->textInput(['maxlength' => 255]) ?>

		    <?= $form->field($model, 'location')->textInput(['maxlength' => 255]) ?>

			<div class="btn-group">
		    	<?php
		    		if ($model->isNewRecord)
		    		{
		    			echo Html::submitButton('<span class="fa fa-fw fa-save"></span> '.'Create', ['class' => 'btn btn-primary']);
		    		}
		    		else
		    		{
		    			echo Html::submitButton('<span class="fa fa-fw fa-save"></span> '.'Update', ['class' => 'btn btn-primary']);
		    			echo Html::submitButton('<span class="fa fa-fw fa-clipboard"></span> '.'Save as Revision', ['class' => 'btn btn-danger',
		    				'name' => 'create_revision']);
		    		}
				?>
			</div>
			
		    <?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
