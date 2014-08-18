<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Training */

$this->title = 'Create Training';
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="training-create">

    <?= $this->render('_form', [
        'model' => $model,
        'dataEs2' => $dataEs2
    ]) ?>

</div>
