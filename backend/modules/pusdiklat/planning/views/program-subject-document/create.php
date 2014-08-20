<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ProgramSubjectDocument */

$this->title = 'Create Program Subject Document';
$this->params['breadcrumbs'][] = ['label'=>'Program','url'=>['program/index']];
$this->params['breadcrumbs'][] = ['label'=>$program_name,'url'=>['program-subject/index','tb_program_id'=>(int)$tb_program_id]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="program-subject-document-create">

    <?= $this->render('_form', [
        'model' => $model,
		'tb_program_id' => $tb_program_id,
		'tb_program_subject_id' => $tb_program_subject_id,
		'program_name' => $program_name,
		'program_subject_name' => $program_subject_name,
    ]) ?>

</div>
