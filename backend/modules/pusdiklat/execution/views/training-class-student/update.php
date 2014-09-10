<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingClassStudent */

$this->title = 'Update Training Class Student: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Training Class Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="training-class-student-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
