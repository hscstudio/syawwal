<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingHistory */

$this->title = 'Update Training History: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Training Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'tb_training_id' => $model->tb_training_id, 'revision' => $model->revision]];
$this->params['breadcrumbs'][] = 'Update';
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="training-history-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
