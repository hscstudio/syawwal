<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrainingExecutionEvaluation */

$this->title = 'Update Training Execution Evaluation: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Training Execution Evaluations', 'url' => ['index']];
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
<div class="training-execution-evaluation-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
