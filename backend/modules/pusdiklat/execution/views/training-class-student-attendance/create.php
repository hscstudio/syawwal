<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrainingClassStudentAttendance */

$this->title = 'Create Training Class Student Attendance';
$this->params['breadcrumbs'][] = ['label' => 'Training Class Student Attendances', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="training-class-student-attendance-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
