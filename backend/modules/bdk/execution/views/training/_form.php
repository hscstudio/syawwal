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

<?php $form = ActiveForm::begin([
	'type' => ActiveForm::TYPE_VERTICAL,
	'options'=>['enctype'=>'multipart/form-data']
]); ?>
	<div class="panel panel-default">
		
		<div class="panel-heading">
			<div class="pull-right">
				<?= Html::a('<i class="fa fa-arrow-left"></i> Back to training',['index','status' => $model->status],['class'=>'btn btn-xs btn-default']) ?>
		    	<?php
		    		if ($model->isNewRecord)
		    		{
		    			echo Html::submitButton('<span class="fa fa-fw fa-save"></span> '.'Create', ['class' => 'btn btn-xs btn-primary']);
		    		}
		    		else
		    		{
		    			echo Html::submitButton('<span class="fa fa-fw fa-save"></span> '.'Update', ['class' => 'btn btn-xs btn-primary']);
		    			echo ' ';
		    			echo Html::submitButton('<span class="fa fa-fw fa-clipboard"></span> '.'Save as Revision', ['class' => 'btn btn-xs btn-danger',
		    				'name' => 'create_revision']);
		    		}
				?>
			</div>
			<i class="fa fa-fw fa-globe"></i> 
			Training	
		</div>

		<div class="panel-body" style="margin:10px">
			<?= $form->errorSummary($model) ?>
			
		    <?= '' ?>

			<?php
				echo '<div class="container-fluid">';

				// row 1
				echo	'<div class="row">';

					echo '<div class="col-md-6">';
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
					echo '</div>';

					echo '<div class="col-md-6">';
							$data = ArrayHelper::map(\backend\models\Program::find()
								->select(['id','name'])
								->where(['status' => 1])
								->asArray()
								->all(), 
							'id', 'name');
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
					echo '</div>';

				echo	'</div>';
				// end row 1

				// row 2
				echo	'<div class="row">';

					echo '<div class="col-md-12">';
						echo $form->field($model, 'name')->textInput(['maxlength' => 255]);
					echo '</div>';

				echo	'</div>';
				// end row 2

				// row 3
				echo	'<div class="row">';

					echo '<div class="col-md-2">';
						echo $form->field($model, 'studentCount')->textInput();
					echo '</div>';

					echo '<div class="col-md-2">';
						echo $form->field($model, 'classCount')->textInput(['maxlength' => 3]);
					echo '</div>';

					echo '<div class="col-md-4">';
						echo $form->field($model, 'costPlan')->textInput();
					echo '</div>';

					echo '<div class="col-md-4">';
						echo $form->field($model, 'costRealisation')->textInput();
					echo '</div>';

				echo	'</div>';
				// end row 3

				// row 4
				echo	'<div class="row">';

					echo '<div class="col-md-3">';
						echo $form->field($model, 'hostel')->label('Hostel', ['class' => 'col-md-12'])->widget(\kartik\widgets\SwitchInput::classname(), [
							'pluginOptions' => [
								'onText' => 'On',
								'offText' => 'Off',
							]
						]);
					echo '</div>';

					echo '<div class="col-md-3">';
						echo $form->field($model, 'reguler')->label('Reguler', ['class' => 'col-md-12'])->widget(\kartik\widgets\SwitchInput::classname(), [
							'pluginOptions' => [
								'onText' => 'On',
								'offText' => 'Off',
							]
						]);
					echo '</div>';

					echo '<div class="col-md-3">';
						echo $form->field($model, 'start')->widget(\kartik\datecontrol\DateControl::classname(), [
							'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
						]);
					echo '</div>';

					echo '<div class="col-md-3">';
						echo $form->field($model, 'finish')->widget(\kartik\datecontrol\DateControl::classname(), [
							'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
						]);
					echo '</div>';

				echo	'</div>';
				// end row 4

				// row 5
				echo	'<div class="row">';

					echo '<div class="col-md-4">';
						echo $form->field($model, 'location')->textInput(['maxlength' => 255]);
					echo '</div>';

					echo '<div class="col-md-4">';
						echo $form->field($model, 'stakeholder')->textInput(['maxlength' => 255]);
					echo '</div>';

					echo '<div class="col-md-4">';
						echo $form->field($model, 'note')->textInput(['maxlength' => 255]);
					echo '</div>';

				echo	'</div>';
				// end row 5

				// row 6
				echo	'<div class="row">';

					echo '<div class="col-md-4">';
						echo $form->field($model, 'executionSK')->textInput(['maxlength' => 255]);
					echo '</div>';

					echo '<div class="col-md-4">';
						echo $form->field($model, 'resultSK')->textInput(['maxlength' => 255]);
					echo '</div>';

					echo '<div class="col-md-4">';
						echo $form->field($model, 'sourceCost')->textInput(['maxlength' => 255]);
					echo '</div>';

				echo	'</div>';
				// end row 6

				echo '</div>';
			?>
			
		</div>
	</div>
<?php ActiveForm::end(); ?>
</div>
