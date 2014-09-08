<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ActivityRoom */

$this->title = 'Update Activity Room: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label'=>'Room','url'=>['room/index']];
$this->params['breadcrumbs'][] = ['label' => 'Activity Rooms', 'url' => ['index','tb_room_id'=>$tb_room_id]];
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
<div class="activity-room-update">

    <?= $this->render('_form', [
        'model' => $model,
		'tb_room_id'=>$tb_room_id
    ]) ?>

</div>
