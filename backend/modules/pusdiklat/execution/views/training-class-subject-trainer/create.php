<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrainingClassSubjectTrainer */

$program = $trainingClassSubject->trainingClass->training->tb_program_id;
$program_revision = $trainingClassSubject->trainingClass->training->tb_program_revision;
$programSubjects=\backend\models\ProgramSubjectHistory::find()
	->where([
		'tb_program_subject_id'=>$trainingClassSubject->tb_program_subject_id,'tb_program_id'=>$program,
		'revision'=>$program_revision,'status'=>1
	])
	->one();
$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training/index'])];
$this->params['breadcrumbs'][] = ['label' => \yii\helpers\Inflector::camel2words($trainingClassSubject->trainingClass->training->name), 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class/index','tb_training_id'=>$trainingClassSubject->trainingClass->tb_training_id])];
$this->params['breadcrumbs'][] = ['label' => $trainingClassSubject->trainingClass->class, 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class-subject/index','tb_training_class_id'=>$trainingClassSubject->trainingClass->id])];
$this->params['breadcrumbs'][] = ['label' => $programSubjects->name, 'url' => \yii\helpers\Url::to(['/'.$this->context->module->uniqueId.'/training-class-subject-trainer/index','tb_training_class_subject_id'=>$trainingClassSubject->id])];
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
		'trainingClassSubject' => $trainingClassSubject,
    ]) ?>

</div>
