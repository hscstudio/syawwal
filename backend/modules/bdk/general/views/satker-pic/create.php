<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\SatkerPic */

$this->title = 'Create Satker Pic';
$this->params['breadcrumbs'][] = ['label' => 'Satker Pics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="satker-pic-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
