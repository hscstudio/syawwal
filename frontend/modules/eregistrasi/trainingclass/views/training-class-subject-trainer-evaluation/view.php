<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrainingClassSubjectTrainerEvaluation */

$this->title = 'View Training Class Subject Trainer Evaluation';
$this->params['breadcrumbs'][] = ['label' => 'Trainings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Training Class Subject', 'url' => ['training-class-subject/index?tb_training_id='.\hscstudio\heart\helpers\Kalkun::AsciiToHex(base64_encode($tb_training_id))]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-class-subject-trainer-evaluation-view">
<div class="panel panel-default">
	<div class="panel-heading">
        <i class="fa fa-fw fa-globe"></i><?php echo \frontend\models\Training::findOne($tb_training_id)->name; ?> - <?php echo \frontend\models\TrainingClassSubject::findOne($tb_training_class_subject_id)->programSubject->name; ?> - <?php echo \frontend\models\Trainer::findOne($tb_trainer_id)->name; ?></div>
    <?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,					 
        'attributes' => [
            //'value',
            //'comment',
        ],
	]) ?>
    <?php
	$group_arr=array(
					0=>"I. Sikap Widyaiswara",
					1=>"II. Teknik Presentasi dan Komunikasi",
					2=>"III. Kompetensi Widyaiswara"
				);

	$item_arr[0]=array(
				1=>"Kedisiplinan Kehadiran",
				2=>"Sikap dan Perilaku",
				3=>"Pemberian motivasi kepada peserta",
				4=>"Penampilan",
			);

	$item_arr[1]=array(
				5=>"Nada dan Suara",
				6=>"Sistematika Penyajian",
				7=>"Metode mengajar",
				8=>"Penguasaan sarana diklat",
			);

	$item_arr[2]=array(
				9=>"Kemampuan menyajikan materi",
				10=>"Cara menjawab pertanyaan",
				11=>"Kesesuaian materi dengan SAP dan GBPP",
				12=>"Update terhadap pengetahuan terbaru",
			);
	
	echo "<table class='table table-condensed table-striped table-bordered'>";
	$model->value=explode("|",$model->value);
	$no=0;
	foreach($group_arr as $idx=>$group){
		echo "<tr>";
		echo "<th colspan='2'>".$group."</th>";
		echo "<th>";
		if($idx==0) echo "Skala Penilaian";
		echo "</th>";
		echo "</tr>";
		foreach($item_arr[$idx] as $num=>$item){
			echo "<tr>";
			if($num==1) echo "<td style='width:10px;'>".$num."</td>"; else echo "<td>".$num."</td>";
			if($num==1) echo "<td style=';'>".$item."</td>"; else echo "<td>".$item."</td>";
			if($num==1) echo "<td style='width:60%;'>"; else echo "<td>";
			if($model->value[$no]==1) echo "Tidak baik";
			if($model->value[$no]==2) echo "Kurang baik";
			if($model->value[$no]==3) echo "Cukup";
			if($model->value[$no]==4) echo "Baik";
			if($model->value[$no]==5) echo "Sangat baik";
			echo "</td></tr>";
			$no++;
		}
	}
	echo "<tr>";
	echo "<th colspan='3' style='text-align:left;'>IV. KESAN & SARAN</th>";
	echo "</tr>";	
	echo "<tr>";
	echo "<td colspan='3'>".$model->comment."</textarea>";
	echo "<div class='message'></div>";
	echo "</td>";
	echo "</tr>";	
	echo "</table>";
    ?>

</div>
