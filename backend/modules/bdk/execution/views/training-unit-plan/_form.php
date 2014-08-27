<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingUnitPlan */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="training-unit-plan-form">

<?php $form = ActiveForm::begin([
	'type' => ActiveForm::TYPE_VERTICAL,
	'options'=>['enctype'=>'multipart/form-data']
]); ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<div class="pull-right">
			<?= Html::a('<i class="fa fa-arrow-left"></i>Back to Index',['index'],
							['class'=>'btn btn-xs btn-default',
							 'title'=>'Back to Index',
							]) ?>
			<?= Html::submitButton(
				$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update', 
				['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-xs btn-primary']) ?>
			</div>
			<i class="fa fa-fw fa-globe"></i> 
			TrainingUnitPlan	</div>
		<div style="margin:10px">
		<?= $form->errorSummary($model) ?>
		
	    <?php
	    	$arrSpread = explode('|', $model->spread);
	    	$unit = ['Setjen', 'Itjen', 'DJA', 'DJP', 'DJBC', 'DJPBn', 'DJKN', 'DJPK', 'DJPU', 'BKF', 'Bapepam', 'BPPK', 'Lainnya'];
	    	if (count($arrSpread) == 13)
	    	{
	    		echo '<div class="row">';
	    		foreach ($arrSpread as $key => $value) {
	    			echo '<div class="col-md-1">';
	    			echo $form->field($model, 'spread')
	    				->textInput(['name' => 'TrainingUnitPlan[spread][]', 'value' => $value])
	    				->label($unit[$key]);
	    			echo '</div>';
	    		}
	    		echo '</div>';
	    	}
	    ?>
		
		</div>
</div>

<?php ActiveForm::end(); ?>
</div>
