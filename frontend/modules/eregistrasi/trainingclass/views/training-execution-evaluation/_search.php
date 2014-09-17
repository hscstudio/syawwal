<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrainingExecutionEvaluationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-execution-evaluation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tb_training_class_student_id') ?>

    <?= $form->field($model, 'value') ?>

    <?= $form->field($model, 'text1') ?>

    <?= $form->field($model, 'text2') ?>

    <?php // echo $form->field($model, 'text3') ?>

    <?php // echo $form->field($model, 'text4') ?>

    <?php // echo $form->field($model, 'text5') ?>

    <?php // echo $form->field($model, 'overall') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'createdBy') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'modifiedBy') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'deletedBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
