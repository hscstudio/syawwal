<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramHistorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="program-history-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tb_program_id') ?>

    <?= $form->field($model, 'revision') ?>

    <?= $form->field($model, 'ref_satker_id') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'hours') ?>

    <?php // echo $form->field($model, 'days') ?>

    <?php // echo $form->field($model, 'test') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'validationStatus') ?>

    <?php // echo $form->field($model, 'validationNote') ?>

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
