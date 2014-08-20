<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ProgramSubject */

$this->title = 'Create Program Subject';
$this->params['breadcrumbs'][] = ['label'=>'Program','url'=>['program/index']];
$this->params['breadcrumbs'][] = ['label' => 'Program Subjects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="program-subject-create">

    <?= $this->render('_form', [
        'model' => $model,
		'tb_program_id' => $tb_program_id
    ]) ?>

</div>
