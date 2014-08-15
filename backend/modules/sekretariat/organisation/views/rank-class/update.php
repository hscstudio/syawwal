<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RankClass */

$this->title = 'Update Rank Class: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rank Classes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="rank-class-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
