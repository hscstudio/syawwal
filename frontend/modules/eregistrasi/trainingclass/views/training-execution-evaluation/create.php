<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TrainingExecutionEvaluation */

$this->title = 'Form Training Execution Evaluation';
$this->params['breadcrumbs'][] = ['label'=>'Trainings','url'=>['../eregistrasi-student/training/index']];
$this->params['breadcrumbs'][] = ['label' => 'Training Class Student', 'url' => ['/eregistrasi-training/default/index?tb_training_id=4d54553d']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="training-execution-evaluation-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
