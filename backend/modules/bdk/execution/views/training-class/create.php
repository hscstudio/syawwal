<?php

use yii\helpers\Html;

$this->title = 'Create Training Class';
$this->params['breadcrumbs'][] = ['label' => 'Training', 'url' => ['training/index']];
$this->params['breadcrumbs'][] = ['label' => 'Class', 'url' => ['index', 'trainingId' => $trainingId]];
$this->params['breadcrumbs'][] = 'Create';
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="training-class-create">

    <?= $this->render('_form', [
        'model' => $model,
        'trainingId' => $trainingId
    ]) ?>

</div>
