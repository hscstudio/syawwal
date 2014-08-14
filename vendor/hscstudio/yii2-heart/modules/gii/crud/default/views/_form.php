<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
//use yii\bootstrap\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i>',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="glyphicon glyphicon-globe"></i> 
		<?= StringHelper::basename($generator->modelClass) ?>
	</div>
	<div style="margin:10px">
    <?= "<?php " ?>$form = ActiveForm::begin([
		'type' => ActiveForm::TYPE_HORIZONTAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= "<?=" ?> $form->errorSummary($model) ?> <!-- ADDED HERE -->
	
<?php foreach ($safeAttributes as $attribute) {
    echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
} ?>
    <div class="form-group">
		<label class="col-md-2 control-label"></label>
		<div class="col-md-10">
        <?= "<?= " ?>Html::submitButton(
			$model->isNewRecord ? '<span class="glyphicon glyphicon-floppy-disk"></span> '.<?= $generator->generateString('Create') ?> : '<span class="glyphicon glyphicon-floppy-disk"></span> '.<?= $generator->generateString('Update') ?>, 
			['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	</div>
	
    <?= "<?php " ?>ActiveForm::end(); ?>
	</div>
</div>
</div>
