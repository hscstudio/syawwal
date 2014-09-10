<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Meeting */

$this->title = 'Create Meeting';
$this->params['breadcrumbs'][] = ['label' => 'Meetings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="meeting-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
