<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Program */

$this->title = 'Update Program: ' . ' ' . \yii\helpers\Inflector::camel2words($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Programs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => \yii\helpers\Inflector::camel2words($model->name), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="program-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
