<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Training */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="training-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i> BACK',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		Training Student Unit Plan</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		//'type' => ActiveForm::TYPE_HORIZONTAL,
		//'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>
	
	<div class="row">
	<?php
	$units = \backend\models\Unit::find()->select(['id','shortname'])->where('id>:id',[':id'=>0])->all();
	$idx=0;
	foreach($units as $unit){
		echo "<div class='col-md-3'>";
		$student=0;
		if(isset($model->studentCount[$idx])) $student=$model->studentCount[$idx];
		echo $form->field($model, 'studentCount[]',['template' => '<label class="control-label">'.$unit->shortname.'</label>{input}'])->textInput(['value'=>$student]);
		$idx++;
		echo "</div>";
	}
	?>	
	</div>
	<div class="col-md-3">
	<?= Html::submitButton(
		$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update', 
		['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>
	    
	<div class="clearfix"></div>	
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
