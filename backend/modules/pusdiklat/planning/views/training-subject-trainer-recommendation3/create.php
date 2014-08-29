<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TrainingSubjectTrainerRecommendation */

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label'=>'Training','url'=>['training3/index']];
$this->params['breadcrumbs'][] = ['label'=>\yii\helpers\Inflector::camel2words('Subject : '.$program_name),'url'=>['training-subject3/index','tb_program_id'=>(int)$tb_program_id]];
$this->params['breadcrumbs'][] = ['label' => $program_subject_name, 'url' => ['index','tb_program_id'=>(int)$tb_program_id,'tb_program_subject_id'=>(int)$tb_program_subject_id]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="training-subject-trainer-recommendation-create">

    <?= $this->render('_form', [
        'model' => $model,
		'tb_program_id'=>(int)$tb_program_id,
		'tb_program_subject_id'=>(int)$tb_program_subject_id
    ]) ?>

</div>
