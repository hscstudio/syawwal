<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\TrainingClassSubjectTrainerEvaluation */

$this->title = 'Form Training Class Subject Trainer Evaluation';
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Training Class Subject', 'url' => ['training-class-subject/index?tb_training_id='.\hscstudio\heart\helpers\Kalkun::AsciiToHex(base64_encode($tb_training_id))]];
//$this->params['breadcrumbs'][] = ['label' => 'Training Class Subject Trainer Evaluations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="training-class-subject-trainer-evaluation-create">

    <?= $this->render('_form', [
        'model' => $model,
		'tb_training_id' => $tb_training_id,
		'tb_training_class_subject_id' => $tb_training_class_subject_id,
		'tb_trainer_id' => $tb_trainer_id,
    ]) ?>

</div>
