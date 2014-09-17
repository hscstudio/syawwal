<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\TrainingExecutionEvaluation */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="training-execution-evaluation-form">
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="pull-right">
		<?= Html::a('<i class="fa fa-arrow-left"></i> BACK',['index'],
						['class'=>'btn btn-xs btn-primary',
						 'title'=>'Back to Index',
						]) ?>
		</div>
		<i class="fa fa-fw fa-globe"></i> 
		<?php //echo \frontend\models\Training::findOne(15)->name ;?>	</div>
	<div style="margin:10px">
    <?php $form = ActiveForm::begin([
		'type' => ActiveForm::TYPE_HORIZONTAL,
		'options'=>['enctype'=>'multipart/form-data']
	]); ?>
	<?= $form->errorSummary($model) ?>    

    <?php //echo $toke; ?>

    <?php /*$form->field($model, 'status')->widget(\kartik\widgets\SwitchInput::classname(), [
					'pluginOptions' => [
						'onText' => 'On',
						'offText' => 'Off',
					]
				])*/ ?>

   <?php /////////////;?>
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
	foreach($group_arr as $idx=>$group){
		echo "<tr>";
		echo "<th colspan='7'>".$group."</th>";
		echo "</tr>";
		foreach($item_arr[$idx] as $num=>$item){
			echo "<tr>";
			if($idx==0 and $num==1) echo "<td style='width:10px;'>".$num."</td>"; else echo "<td>".$num."</td>";
			if($idx==0 and $num==1)echo "<td style=';'>".$item; else echo "<td>".$item;
			if($num>=34){
				echo " <a href='#' class='tooltip-soft' rel='tooltip' title=''><i class='icon-question-sign'></i></a>";
			}
			echo "</td>";
			if($idx==7)
			{
				$i=$num-33;
				echo "<td colspan='5'>".$form->field($model, 'text'.$i)->textInput(['maxlength' => 500])->label('')."</td>";				
			}
			else{
				if($num==1) echo "<td style='width:60%;'>"; else echo "<td>";
				echo $form->field($model, 'value['.$num.']')->radioList(
																				  [1 => '1.Tidak baik',
																				   2 => '2.Kurang Baik',
																				   3 => '3.Cukup',
																				   4 => '4.Baik',
																				   5 => '5.Sangat Baik'],
																				  ['inline'=>true]);
				echo "</td>";
			}
			echo "</tr>";
		}
	}
	echo "</table>";
	
	echo "<table class='table table-condensed table-striped'>";
	echo "<tr>";
	echo "<th>Secara keseluruhan, bagaimana penilaian Anda terhadap penyelenggaraan diklat ini</th>";
	echo "</tr>";
	echo "<tr>";	
	echo "<td>".$form->field($model, 'overall')->radioList([
															1 => '<img src='.Yii::getAlias('@web').'/emotions/1.png>',
															2 => '<img src='.Yii::getAlias('@web').'/emotions/2.png>', 
															3 => '<img src='.Yii::getAlias('@web').'/emotions/3.png>', 
															4 => '<img src='.Yii::getAlias('@web').'/emotions/4.png>', 
															5 => '<img src='.Yii::getAlias('@web').'/emotions/5.png>'
														],['inline'=>true,'encode'=>false])."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<th style='text-align:left;'>KRITIK & SARAN</th>";
	echo "</tr>";	
	echo "<tr>";
	echo "<td colspan='20'>'".$form->field($model, 'comment')->textInput(['maxlength' => 3000])->label('Komentar')."'";
	//echo "<div class='message'></div>";
	echo "</td>";
	echo "</tr>";	
	echo "</table>";   
   ?>

    <div class="form-group">
		<label class="col-md-2 control-label"></label>
		<div class="col-md-10">
        <?= Html::submitButton(
			$model->isNewRecord ? '<span class="fa fa-fw fa-save"></span> '.'Create' : '<span class="fa fa-fw fa-save"></span> '.'Update', 
			['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
	</div>
	
    <?php ActiveForm::end(); ?>
	</div>
</div>
</div>
