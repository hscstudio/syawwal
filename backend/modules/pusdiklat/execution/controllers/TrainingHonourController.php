<?php

namespace backend\modules\pusdiklat\execution\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \backend\models\TrainingScheduleTrainer;
use \backend\models\TrainingSchedule;
use \backend\models\Trainer;
use \backend\models\Employee;
use \backend\models\TrainingClass;
use \backend\models\Sbu;
use \yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/**
 * TrainingClassSubjectController implements the CRUD actions for TrainingClassSubject model.
 */
class TrainingHonourController extends Controller
{
	public $layout = '@hscstudio/heart/views/layouts/column2';
	 
 	
	public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TrainingClassSubject models.
     * @return mixed
     */
    public function actionIndex($tb_training_id)
    {
		$searchModel = new \backend\models\TrainingClassSearch(); 
		$queryParams['TrainingClassSearch']=[				
			'tb_training_id'=>$tb_training_id,
		];
		$queryParams=yii\helpers\ArrayHelper::merge(Yii::$app->request->getQueryParams(),$queryParams);
		$dataProvider = $searchModel->search($queryParams); 
		
		$training=\backend\models\Training::findOne($tb_training_id);
		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'training' => $training, 
        ]);
    }

    public function actionPrepare($tb_training_class_id)
    {				
		$dataProvider = new \yii\data\ActiveDataProvider([
			'query' => \backend\models\TrainingScheduleTrainer::find()
				->joinWith(['trainingSchedule'])
				->where([
					'tb_training_schedule_id'=>\backend\models\TrainingSchedule::find()
						->select('id')
						->where([
							'tb_training_class_id'=>$tb_training_class_id,
							'status'=>1,					
						])
						->andWhere('tb_training_class_subject_id>0')
						->groupBy('tb_training_class_subject_id')
						->column(),
					TrainingScheduleTrainer::tableName().'.status'=>1,
					'ref_trainer_type_id'=>[0], //Only PENGAJAR not ASISTEN & PENCERAMAH
				])
				->groupBy('tb_training_class_subject_id,tb_trainer_id'),				
			'pagination' => [
				'pageSize' => 20,
			],
			'sort'=> ['defaultOrder' => ['tb_training_schedule_id'=>SORT_ASC]]
		]);
		$trainingClass=\backend\models\TrainingClass::findOne($tb_training_class_id);
		$sbu = \backend\models\Sbu::find()->where(['name'=>'honor_persiapan_mengajar','status'=>1])->one();
        return $this->render('prepare', [
			'dataProvider' => $dataProvider,
			'trainingClass' => $trainingClass, 
			'sbu' => $sbu,
        ]);
    }
	
	public function actionTransport($tb_training_class_id)
    {			
		$ref_satker_id = Yii::$app->user->identity->employee->ref_satker_id;
		$dataProvider = new ActiveDataProvider([
			'query' => TrainingScheduleTrainer::find()
				->select(TrainingScheduleTrainer::tableName().'.*,'.Employee::tableName().'.ref_satker_id')
				->joinWith(['trainer', 'trainer.employee','trainingSchedule'])
				->where([
					'tb_training_schedule_id'=>TrainingSchedule::find()
						->select('id')
						->where([
							'tb_training_class_id'=>$tb_training_class_id,
							'status'=>1,					
						])
						->andWhere('tb_training_class_subject_id>0')
						//->groupBy('tb_training_class_subject_id')
						->column(),
					TrainingScheduleTrainer::tableName().'.status'=>1,
				])
				->andWhere(
					'('.Employee::tableName().'.ref_satker_id IS NOT NULL AND '.Employee::tableName().'.ref_satker_id!='.$ref_satker_id.')'.
					' OR '.
					Employee::tableName().'.ref_satker_id IS NULL'
				)
				->groupBy('tb_training_class_subject_id,tb_trainer_id')
				,	
			'pagination' => [
				'pageSize' => 20,
			],
			'sort'=> ['defaultOrder' => ['tb_training_schedule_id'=>SORT_ASC]]
		]);
		$trainingClass=TrainingClass::findOne($tb_training_class_id);
		$sbu = Sbu::find()->where(['name'=>'honor_transport_dalam_kota','status'=>1])->one();
        return $this->render('transport', [
			'dataProvider' => $dataProvider,
			'trainingClass' => $trainingClass, 
			'sbu' => $sbu,
        ]);
    }
	
	public function actionTraining($tb_training_class_id)
    {			
		$ref_satker_id = Yii::$app->user->identity->employee->ref_satker_id;
		$dataProvider = new ActiveDataProvider([
			'query' => TrainingScheduleTrainer::find()
				->joinWith(['trainer', 'trainer.employee','trainingSchedule'])
				->where([
					'tb_training_schedule_id'=>TrainingSchedule::find()
						->select('id')
						->where([
							'tb_training_class_id'=>$tb_training_class_id,
							'status'=>1,					
						])
						->andWhere('tb_training_class_subject_id>0')
						//->groupBy('tb_training_class_subject_id')
						->column(),
					TrainingScheduleTrainer::tableName().'.status'=>1,
				])
				->groupBy('tb_training_class_subject_id,tb_trainer_id')
				,		
			'pagination' => [
				'pageSize' => 20,
			],
			'sort'=> ['defaultOrder' => ['tb_training_schedule_id'=>SORT_ASC,'ref_trainer_type_id'=>SORT_ASC]]
		]);

		$trainingClass=TrainingClass::findOne($tb_training_class_id);
		$sbus = ArrayHelper::map(Sbu::find()->where(['status'=>1])->all(),'name','value');
        return $this->render('training', [
			'dataProvider' => $dataProvider,
			'trainingClass' => $trainingClass, 
			'sbus' => $sbus,
        ]);
    }
}
	