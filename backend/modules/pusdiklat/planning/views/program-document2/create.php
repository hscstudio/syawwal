<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ProgramDocument */

$this->title = 'Create Program Document';
$this->params['breadcrumbs'][] = ['label'=>'Program','url'=>['program2/index']];
$this->params['breadcrumbs'][] = ['label' => \yii\helpers\Inflector::camel2words($program_name), 'url' => ['index','tb_program_id'=>$tb_program_id]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="program-document-create">

    <?= $this->render('_form', [
        'model' => $model,
		'tb_program_id' => $tb_program_id,
    ]) ?>

</div>
