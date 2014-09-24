<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingClassStudentCertificateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-class-student-certificate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'tb_training_class_student_id') ?>

    <?= $form->field($model, 'ref_unit_id') ?>

    <?= $form->field($model, 'ref_graduate_id') ?>

    <?= $form->field($model, 'ref_rank_class_id') ?>

    <?= $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'seri') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'education') ?>

    <?php // echo $form->field($model, 'eselon2') ?>

    <?php // echo $form->field($model, 'eselon3') ?>

    <?php // echo $form->field($model, 'eselon4') ?>

    <?php // echo $form->field($model, 'satker') ?>

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
