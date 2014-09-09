<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;

$this->title = 'Edit Class Count';
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="training-class">

<?php $form = ActiveForm::begin([
	'type' => ActiveForm::TYPE_VERTICAL,
]); ?>
	<div class="panel panel-default">
		
		<div class="panel-heading">
			<div class="pull-right">
				<?= Html::a('<i class="fa fa-fw fa-times-circle"></i> Cancel',['index','status' => $modelTraining->status],['class'=>'btn btn-xs btn-default']) ?>
		    	<?php
	    			echo Html::submitButton('<span class="fa fa-fw fa-save"></span> '.'Update', ['class' => 'btn btn-xs btn-primary']);
				?>
			</div>
			<i class="fa fa-fw fa-globe"></i> 
			Training Class Count
		</div>

		<div class="panel-body" style="margin:10px">
			<?= $form->errorSummary($modelTraining) ?>
			
			<?php
				echo '<div class="container-fluid">';

				// row 1
				echo	'<div class="row">';

					echo '<div class="col-md-12">';
						// Nambah dropdown eselon 2
						echo $form->field($modelTraining, 'classCount')->textInput(['class' => 'form-control']);
					echo '</div>';

				echo	'</div>';
				// end row 1
			?>
			
		</div>
	</div>
<?php ActiveForm::end(); ?>
</div>
