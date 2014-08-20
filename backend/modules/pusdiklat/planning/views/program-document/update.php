<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramDocument */

$this->title = 'Update Program Document: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Program','url'=>['program/index']];
$this->params['breadcrumbs'][] = ['label' => $program_name, 'url' => ['index','tb_program_id'=>$model->tb_program_id]];
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
<div class="program-document-update">

    <?= $this->render('_form', [
        'model' => $model,
		'tb_program_id' => $tb_program_id,
    ]) ?>

</div>
