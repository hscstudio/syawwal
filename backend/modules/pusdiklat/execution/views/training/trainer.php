<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Training */

$this->title = \yii\helpers\Inflector::camel2words($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-view">
	<div class="table-responsive">
	<table class="table table-striped table-condensed">
	<tr>
		<th style="width:50px;">NO</th>
		<th>NAMA LENGKAP</th>
		<th></th>
	</tr>
    <?php
	$idx=1;
	foreach ($trainingTrainers as $trainingTrainer){
		echo '<tr>';
		echo '<td>'.$idx.'</td>';
		echo '<td>';
		echo $trainingTrainer->trainer->name.' ['.$trainingTrainer->trainer->phone.' | '.$trainingTrainer->trainer->organization.' | '.$trainingTrainer->trainer->email.']';
		echo '</td>';
		echo '</tr>';
		$idx++;
	}	
	?>
	</table>
</div>
