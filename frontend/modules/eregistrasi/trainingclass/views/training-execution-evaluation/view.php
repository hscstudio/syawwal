<?php

use yii\helpers\Html;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrainingExecutionEvaluation */

$this->title = 'Training Execution Evaluation';
$this->params['breadcrumbs'][] = ['label'=>'Trainings','url'=>['../eregistrasi-student/training/index']];
$this->params['breadcrumbs'][] = ['label' => 'Training Class Student', 'url' => ['/eregistrasi-training/default/index?tb_training_id='.\hscstudio\heart\helpers\Kalkun::AsciiToHex(base64_encode($tb_training_id))]];
$this->params['breadcrumbs'][] = $this->title;
$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>
<div class="training-execution-evaluation-view">
<div class="panel panel-default">
	<div class="panel-heading">
        <i class="fa fa-fw fa-globe"></i><?php echo \frontend\models\Training::findOne($tb_training_id)->name ;?></div> 
<?= DetailView::widget([
        'model' => $model,
		'mode'=>DetailView::MODE_VIEW,
		'attributes' => [
				
			],
		]) ?>                       
<?php
$group_arr=array(
					0=>"I. <strong>KURIKULUM</strong> - penilaian Anda atas kurikulum yang kami sajikan",
					1=>"II.	<strong>CAPAIAN BELAJAR</strong> - penilaian atas capaian belajar setelah Anda mendapatkan materi",
					2=>"III. <strong>PELAYANAN PANITIA</strong> - penilaian Anda pada layanan panitia diklat",
					3=>"IV.	<strong>TEMPAT BELAJAR</strong> - penilaian Anda terhadap tempat belajar",
					4=>"V.	<strong>KONSUMSI</strong> - penilaian Anda terhadap konsumsi",
					5=>"VI.	<strong>FASILITAS PENDUKUNG</strong> - penilaian Anda terhadap fasilitas pendukung",
					6=>"VII. <strong>ASRAMA (jika diasramakan)</strong> - penilaian Anda terhadap asrama yang disediakan",
					7=>"VIII. <strong>LAIN-LAIN</strong>",
				);

	$item_arr[0]=array(
				1=>"Kesesuaian materi dengan waktu yang dialokasikan",
				2=>"Kesesuaian materi dengan tujuan diklat",
				3=>"Ketersediaan media pembelajaran",
				4=>"Ketersediaan bahan ajar",
				5=>"Kualitas bahan  ajar",
				6=>"Alokasi waktu ujian",
				7=>"Ketepatan soal ujian dengan materi yang diajarkan",
			);

	$item_arr[1]=array(
				8=>"Peningkatan pengetahuan",
				9=>"Peningkatan Keterampilan",
			);

	$item_arr[2]=array(
				10=>"Layanan administrasi diklat",
				11=>"Keramahan Panitia",
				12=>"Kesigapan Panitia",
				13=>"Penampilan panitia (kerapian, tanda pengenal, dll)",
			);
	
	$item_arr[3]=array(
				14=>"Kenyamanan",
				15=>"Kebersihan",
				16=>"Keamanan",
				17=>"Kelengkapan fasilitas",
			);
	$item_arr[4]=array(
				18=>"Kuantitas",
				19=>"Kualitas",
				20=>"Variasi",
				21=>"Kebersihan",
				22=>"Lainnya",
			);
	$item_arr[5]=array(
				23=>"Ketersediaan pelayanan kesehatan",
				24=>"Ketersediaan sarana ibadah",
				25=>"Ketersediaan sarana olahraga",
				26=>"Ketersediaan perpustakaan",
				27=>"Ketersediaan ruang makan",
				28=>"Kebersihan kamar kecil",
				29=>"Kenyamanan lingkungan luar kelas",
			);
	$item_arr[6]=array(
				30=>"Kenyamanan",
				31=>"Kebersihan",
				32=>"Keamanan",
				33=>"Kelengkapan Fasilitas",
			);
	$item_arr[7]=array(
				34=>"Mata Pelajaran yang perlu dikurangi waktunya",
				35=>"Mata Pelajaran yang perlu ditambah waktunya",
				36=>"Mata Pelajaran yang materi/silabusnya perlu dibenahi",
				37=>"Mata Pelajaran yang sebaiknya dihapus",
				38=>"Mata Pelajaran yang perlu ditambahkan selain mata pelajaran yang sudah ada",
			);
	echo "<table class='table table-condensed table-striped table-bordered1'>";
	$model->value=explode("|",$model->value);
	$no=0;
	foreach($group_arr as $idx=>$group){				
					echo "<tr>";
					echo "<th colspan='7'>".$group."</th>";
					echo "</tr>";		
				foreach($item_arr[$idx] as $num=>$item){
					echo "<tr>";
					if($idx==0 and $num==1) echo "<td style='width:10px;'>".$num."</td>"; else echo "<td>".$num."</td>";
					if($idx==0 and $num==1)	echo "<td style='width:530px;'>".$item; else echo "<td>".$item;
					echo "</td>";
					if($idx==7){
						$i=$num-33;
						echo "<td colspan='5'>".$model['text'.$i]."</td>";
					}
					else{
						echo "<td>";
						if($model->value[$no]==1) echo "Tidak baik";
						if($model->value[$no]==2) echo "Kurang baik";
						if($model->value[$no]==3) echo "Cukup";
						if($model->value[$no]==4) echo "Baik";
						if($model->value[$no]==5) echo "Sangat baik";
						echo "</td>";
						$no++;
					}
					echo "</tr>";
				}
			}
	echo "</table>";
	echo "<table class='table table-condensed table-striped'>";
	echo "<tr>";
	echo "<th colspan='5'>Secara keseluruhan, bagaimana penilaian Anda terhadap penyelenggaraan diklat ini</th>";
	echo "</tr>";
	echo "<tr>";
	if($model->overall==1) echo "<td><img src=".Yii::getAlias('@web')."/emotions/1.png></td>";
	if($model->overall==2) echo "<td><img src=".Yii::getAlias('@web')."/emotions/2.png></td>";
	if($model->overall==3) echo "<td><img src=".Yii::getAlias('@web')."/emotions/3.png></td>";
	if($model->overall==4) echo "<td><img src=".Yii::getAlias('@web')."/emotions/4.png></td>";
	if($model->overall==5) echo "<td><img src=".Yii::getAlias('@web')."/emotions/5.png></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<th colspan='5' style='text-align:left;'>KRITIK & SARAN</th>";
	echo "</tr>";	
	echo "<tr>";
	echo "<td colspan='5'>".$model->comment."</td>";
	echo "</tr>";	
	echo "</table>";
?></div>
</div>