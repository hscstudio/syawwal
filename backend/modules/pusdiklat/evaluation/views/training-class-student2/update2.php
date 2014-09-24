<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingClassStudentCertificate */

$this->title = 'Update Training Class Student Certificate: ' . ' ' . $model->tb_training_class_student_id;
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training2/index'])];
$this->params['breadcrumbs'][] = ['label' => 'Training Class', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class2/index','tb_training_id'=>$tb_training_id])];
$this->params['breadcrumbs'][] = ['label' => 'Training Certificates', 'url' => ['certificate','tb_training_id'=>$tb_training_id,'tb_training_class_id'=>$tb_training_class_id]];
$this->params['breadcrumbs'][] = 'Update';
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="training-class-student-certificate-update">

    <?= $this->render('_form2', [
        'model' => $model,
		'tb_training_id'=>$tb_training_id,
		'tb_training_class_id'=>$tb_training_class_id,
    ]) ?>

</div>
