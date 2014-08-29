<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Dropdown;
use kartik\widgets\Select2;

\kartik\grid\GridViewAsset::register($this);
/* @var $searchModel backend\models\TrainingSearch */

$this->title = 'Trainings By Program';
$this->params['breadcrumbs'][] = $this->title;

$controller = $this->context;
$menus = $controller->module->getMenuItems();
$this->params['sideMenu'][$controller->module->uniqueId]=$menus;
?>

<div class="training-index">

<div class="grid-view">    
<div class="panel panel-default">
	<div class="panel-heading">
		 <h3 class="panel-title"><i class="fa fa-fw fa-globe"></i></h3>
	</div>
	<div class="kv-panel-before">
		<div class="pull-left">
			<div class="btn-group" style="margin:5px;">
			<?= Html::a('<i class="fa fa-fw fa-arrow-left"></i> Back To Training', ['training/index'], ['class' => 'btn btn-warning']) ?>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="table-responsive">		
		<table class="table table-hover table-bordered table-striped">
		<thead>
			<tr>
			<th class="kv-align-center kv-align-middle kv-merged-header" style="width:50px;">#</th>
			<th class="kv-align-center kv-align-middle kv-merged-header" style="width:50px;">No</th>
			<th class="kv-sticky-column kv-align-left kv-align-middle">Name</th>
			<th class="kv-sticky-column kv-align-center kv-align-middle">Start</th>
			<th class="kv-sticky-column kv-align-center kv-align-middle">Finish</th>
			<th class="kv-sticky-column kv-align-center kv-align-middle">Student</th>
			<th class="kv-sticky-column kv-align-center kv-align-middle" style="width:100px;">Rev</th>
			<th class="kv-sticky-column kv-align-center kv-align-middle" style="width:80px;">Status</th>
			
		</tr>

		</thead>
		<tbody>
		<?php
		$model = \backend\models\Training::find()->all();
		$program = "";
		$program_idx = 1;
		$training_idx = 1;
		foreach ($model as $data){
			if($program!=$data->program->name){
				echo "<tr>";
				echo "<td class='kv-align-center kv-align-middle'><strong>".$program_idx."</strong></td>";
				echo "<td colspan='7'><strong>".$data->program->name."</strong></td>";
				echo "</tr>";
				$program = $data->program->name;
				$program_idx++;
				$training_idx=1;
			}
			echo "<tr>";
			echo "<td></td>";
			echo "<td class='kv-align-center kv-align-middle'>".$training_idx."</td>";			
			echo "<td>".Html::tag('span', $data->name, ['title'=>$data->note,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer'])."</td>";
			echo "<td class='kv-align-center kv-align-middle'>".date('d M y',strtotime($data->start))."</td>";
			echo "<td class='kv-align-center kv-align-middle'>".date('d M y',strtotime($data->finish))."</td>";
			echo "<td class='kv-align-center kv-align-middle'>".$data->studentCount."</td>";
			echo "<td class='kv-align-center kv-align-middle'>";
			$countRevision = \backend\models\TrainingHistory::find()
								->where(['tb_training_id' => $data->id,])
								->count()-1;
			if($countRevision>0){
				echo Html::a($countRevision.'x', ['training-history/index','tb_training_id'=>$data->id], ['class' => 'label label-danger','data-pjax'=>0]);
			}
			else{
				echo '-';
			}
			echo "</td>";
			if ($data->status==1){
				$icon='<span class="glyphicon glyphicon-check"></span>';
				$label='label label-info';
				$title='READY';
			}	
			else if ($data->status==2){ 
				$icon='<span class="glyphicon glyphicon-refresh"></span>';
				$label='label label-success';
				$title='EXECUTE';
			}
			else if ($data->status==3){ 
				$icon='<span class="glyphicon glyphicon-trash"></span>';
				$label='label label-danger';
				$title='CANCEL';
			}
			else {
				$icon='<span class="glyphicon glyphicon-fire"></span>';
				$label='label label-warning';
				$title='PLAN';
			}
			echo "<td class='kv-align-center kv-align-middle'>".Html::tag('span', $icon, ['class'=>$label,'title'=>$title,'data-toggle'=>"tooltip",'data-placement'=>"top",'style'=>'cursor:pointer'])."</td>";
			echo "</tr>";
			$training_idx++;
		}
		?>
		</tbody>
		</table>
	</div>
</div>
</div>

</div>
