<?php

use yii\helpers\Html;

$this->title = 'Update : #'.$model->id;
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="training-class-subject-trainer-update">

    <?= $this->render('_form', [
        'model' => $model,
		'tb_training_class_subject_id' => $tb_training_class_subject_id,
    ]) ?>

</div>
