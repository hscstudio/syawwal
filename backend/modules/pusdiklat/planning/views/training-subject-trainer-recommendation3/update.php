<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingSubjectTrainerRecommendation */

$this->title = 'Update : #'.$model->id;
$this->params['breadcrumbs'][] = ['label'=>'Training','url'=>['training3/index']];
$this->params['breadcrumbs'][] = ['label'=>\yii\helpers\Inflector::camel2words('Subject : '.$model->training->name),'url'=>['training-subject3/index','tb_training_id'=>(int)$model->tb_training_id]];
$this->params['breadcrumbs'][] = ['label' => $model->programSubject->name, 'url' => ['index','tb_training_id'=>(int)$model->tb_training_id,'tb_program_subject_id'=>(int)$model->tb_program_subject_id]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="training-subject-trainer-recommendation-update">

    <?= $this->render('_form', [
        'model' => $model,
		'tb_training_id'=>(int)$model->tb_training_id,
		'tb_program_subject_id'=>(int)$model->tb_program_subject_id
    ]) ?>

</div>
