<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TestingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="testing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_training') ?>

    <?= $form->field($model, 'id_program') ?>

    <?= $form->field($model, 'name_training') ?>

    <?= $form->field($model, 'hours_training') ?>

    <?= $form->field($model, 'revision_plan_start_training') ?>

    <?php // echo $form->field($model, 'revision_plan_finish_training') ?>

    <?php // echo $form->field($model, 'plan_start_training') ?>

    <?php // echo $form->field($model, 'plan_finish_training') ?>

    <?php // echo $form->field($model, 'start_training') ?>

    <?php // echo $form->field($model, 'finish_training') ?>

    <?php // echo $form->field($model, 'plan_participant_training') ?>

    <?php // echo $form->field($model, 'participant_training') ?>

    <?php // echo $form->field($model, 'location_training') ?>

    <?php // echo $form->field($model, 'note_training') ?>

    <?php // echo $form->field($model, 'update_training') ?>

    <?php // echo $form->field($model, 'main_user') ?>

    <?php // echo $form->field($model, 'status_training') ?>

    <?php // echo $form->field($model, 'certificate_type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
