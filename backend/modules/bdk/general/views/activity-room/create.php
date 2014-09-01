<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ActivityRoom */

$this->title = 'Create Activity Room';
$this->params['breadcrumbs'][] = ['label' => 'Activity Rooms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="activity-room-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
