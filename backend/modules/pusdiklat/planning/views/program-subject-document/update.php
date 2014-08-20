<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramSubjectDocument */

$this->title = 'Update Program Subject Document: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Program Subject Documents', 'url' => ['index']];
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
<div class="program-subject-document-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
