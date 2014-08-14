<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tb_program_id') ?>

    <?= $form->field($model, 'revision') ?>

    <?= $form->field($model, 'ref_satker_id') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'start') ?>

    <?php // echo $form->field($model, 'finish') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'studentCount') ?>

    <?php // echo $form->field($model, 'classCount') ?>

    <?php // echo $form->field($model, 'executionSK') ?>

    <?php // echo $form->field($model, 'resultSK') ?>

    <?php // echo $form->field($model, 'costPlan') ?>

    <?php // echo $form->field($model, 'costRealisation') ?>

    <?php // echo $form->field($model, 'sourceCost') ?>

    <?php // echo $form->field($model, 'hostel') ?>

    <?php // echo $form->field($model, 'reguler') ?>

    <?php // echo $form->field($model, 'stakeholder') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'createdBy') ?>

    <?php // echo $form->field($model, 'modified') ?>

    <?php // echo $form->field($model, 'modifiedBy') ?>

    <?php // echo $form->field($model, 'deleted') ?>

    <?php // echo $form->field($model, 'deletedBy') ?>

    <?php // echo $form->field($model, 'approvedStatus') ?>

    <?php // echo $form->field($model, 'approvedStatusNote') ?>

    <?php // echo $form->field($model, 'approvedStatusDate') ?>

    <?php // echo $form->field($model, 'approvedStatusBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
