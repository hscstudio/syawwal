<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\StudentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ref_religion_id') ?>

    <?= $form->field($model, 'ref_graduate_id') ?>

    <?= $form->field($model, 'ref_rank_class_id') ?>

    <?= $form->field($model, 'ref_unit_id') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'nickName') ?>

    <?php // echo $form->field($model, 'frontTitle') ?>

    <?php // echo $form->field($model, 'backTitle') ?>

    <?php // echo $form->field($model, 'nip') ?>

    <?php // echo $form->field($model, 'password_hash') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'born') ?>

    <?php // echo $form->field($model, 'birthDay') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'married') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'blood') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'positionDesc') ?>

    <?php // echo $form->field($model, 'education') ?>

    <?php // echo $form->field($model, 'eselon2') ?>

    <?php // echo $form->field($model, 'eselon3') ?>

    <?php // echo $form->field($model, 'eselon4') ?>

    <?php // echo $form->field($model, 'satker') ?>

    <?php // echo $form->field($model, 'officePhone') ?>

    <?php // echo $form->field($model, 'officeFax') ?>

    <?php // echo $form->field($model, 'officeEmail') ?>

    <?php // echo $form->field($model, 'officeAddress') ?>

    <?php // echo $form->field($model, 'noSKPangkat') ?>

    <?php // echo $form->field($model, 'tmtSKPangkat') ?>

    <?php // echo $form->field($model, 'fileSKPangkat') ?>

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
