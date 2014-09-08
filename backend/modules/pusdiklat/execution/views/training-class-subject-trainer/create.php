<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrainingClassSubjectTrainer */

$this->title = 'Create Training Class Subject Trainer';
$this->params['breadcrumbs'][] = ['label' => 'Training Class Subject Trainers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="training-class-subject-trainer-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
