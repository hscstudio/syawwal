<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ProgramSubjectHistory */

$this->title = 'Create Program Subject History';
$this->params['breadcrumbs'][] = ['label' => 'Program Subject Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;

echo \kartik\widgets\AlertBlock::widget([
    'useSessionFlash' => true,
    'type' => \kartik\widgets\AlertBlock::TYPE_ALERT
]);
?>
<div class="program-subject-history-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
