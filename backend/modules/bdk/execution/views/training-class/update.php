<?php

use yii\helpers\Html;

$this->title = 'Update Training Class: ' . ' ' . $model->class;
$this->params['breadcrumbs'][] = ['label' => 'Training', 'url' => ['training/index']];
$this->params['breadcrumbs'][] = ['label' => 'Class', 'url' => ['index', 'trainingId' => $trainingId]];
$this->params['breadcrumbs'][] = ['label' => $model->class, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="training-class-update">

    <?= $this->render('_form', [
        'model' => $model,
        'trainingId' => $trainingId
    ]) ?>

</div>
