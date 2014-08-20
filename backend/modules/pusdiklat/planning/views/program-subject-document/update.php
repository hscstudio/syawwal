<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ProgramSubjectDocument */

$tb_program_id = $model->programSubject->tb_program_id;
$tb_program_subject_id = $model->programSubject->id;
$program_name=$model->programSubject->program->name;
$program_subject_name=$model->programSubject->name;
$this->title = 'Update Program Subject Document: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label'=>'Program','url'=>['program/index']];
$this->params['breadcrumbs'][] = ['label'=> $program_name,'url'=>['program-subject/index','tb_program_id'=>(int)$tb_program_id]];
$this->params['breadcrumbs'][] = ['label' => $program_subject_name, 'url' => ['index','tb_program_id'=>(int)$tb_program_id,'tb_program_subject_id'=>(int)$tb_program_subject_id]];
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
		'tb_program_id' => $tb_program_id,
		'tb_program_subject_id' => $tb_program_subject_id,
		'program_name' => $program_name,
		'program_subject_name' => $program_subject_name,
    ]) ?>

</div>
