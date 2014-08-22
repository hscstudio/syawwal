<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramSubjectHistory */

$this->title = 'Update Program Subject History: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Program Subject Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'tb_program_subject_id' => $model->tb_program_subject_id, 'tb_program_id' => $model->tb_program_id, 'revision' => $model->revision]];
$this->params['breadcrumbs'][] = 'Update';
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="program-subject-history-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
