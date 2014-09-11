<?php

namespace backend\modules\bdk\execution\controllers;

use Yii;
use yii\web\Controller;
use backend\models\Training;
use backend\models\TrainingUnitPlan;
use backend\models\Unit;

class DefaultController extends Controller
{
		public $layout = '@hscstudio/heart/views/layouts/column2';
	 
	
	public function actionIndex()
    {
    	// Grafik sebaran data
    	$modelTrainingUnitPlan = TrainingUnitPlan::find()->select('tb_training_id, spread')->all();

    	$arraySpread = [];

    	foreach ($modelTrainingUnitPlan as $row) {
    		if ($row->training->ref_satker_id == Yii::$app->user->identity->employee->ref_satker_id) {
    			$arraySpread[] = explode('|', $row->spread);
    		}
    	}

    	$spreadTotal = [0,0,0,0,0,0,0,0,0,0,0,0,0];

    	for ($i = 0; $i < count($arraySpread); $i++) {
    		for ($z = 0; $z < count($arraySpread[$i]); $z++) {
    			$spreadTotal[$z] += $arraySpread[$i][$z];
    		}
    	}

    	$series = [];
    	$cat = [];
    	$modelUnit = Unit::find()->where('id != :id', [':id' => 0])->asArray()->all();

    	for ($i = 0; $i < count($spreadTotal); $i++) {
    		$spreadTotal[$i] = (int)$spreadTotal[$i];
    		$series[] = [
    			'type' => 'column',
    			'name' => $modelUnit[$i]['shortname'],
    			'data' => [$spreadTotal[$i]]
    		];
    		$cat[] = $modelUnit[$i]['shortname'];
    	}
    	//dah

    	// Grafik anggaran & realisasi
    	/*$modelTraining = Training::find()
    		->where([
    			'ref_satker_id' => Yii::$app->user->identity->employee->ref_satker_id,
    		])
    		->all();

    	$cost = [];
    	foreach ($modelTraining as $row) {
    		$cost[date('Y', strtotime($row->start))]['budget'] += $row->costPlan;
    		$cost[date('Y', strtotime($row->start))]['realisation'] += $row->costRealisation;
    	}


    	$catYear = [];
    	$tmpYear = array_keys($cost);
    	for ($i = 0; $i < count($tmpYear); $i++) {
    		$catYear[] = $tmpYear[$i];
    	}
    	
    	$seriesCost = [];
    	for ($i = 0; $i < count($catYear); $i++) {
    		$seriesCost[] = [
    			'type' => 'column',
    			'name' => 'budget',
    			'data' => [ $cost[$tmpYear[$i]]['budget'] ]
    		];
    		$seriesCost[] = [
    			'type' => 'column',
    			'name' => 'realisation',
    			'data' => [ $cost[$tmpYear[$i]]['realisation'] ]
    		];
    	}*/
    	// dah

        return $this->render('index', [
        		'modelTrainingUnitPlan' => $modelTrainingUnitPlan,
        		'series' => $series,
        		'cat' => $cat,
        		/*'seriesCost' => $seriesCost,
        		'catYear' => $catYear*/
        	]);
    }
}
