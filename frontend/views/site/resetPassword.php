<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = 'Reset password';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row" style="margin-top:15px;">
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
            </div>
            <div class="panel-body">
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
             </div>
        </div>
                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-primary btn-block']) ?>
                </div>
            <?php ActiveForm::end(); ?>
    </div>
</div>
