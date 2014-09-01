<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Testing */

$this->title = 'Update Testing: ' . ' ' . $model->id_training;
$this->params['breadcrumbs'][] = ['label' => 'Testings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_training, 'url' => ['view', 'id' => $model->id_training]];
$this->params['breadcrumbs'][] = 'Update';
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="testing-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
