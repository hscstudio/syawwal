<?php

namespace backend\modules\sekretariat\hrd\controllers;

use Yii;
use backend\models\Employee;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeController implements the CRUD actions for Employee model.
 */
class EmployeeController extends Controller
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
     * Lists all Employee models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Employee::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employee model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Employee model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Employee();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Employee model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $currentFiles=[];
                $currentFiles[0]=$model->photo;
                            $currentFiles[1]=$model->document1;
                            $currentFiles[2]=$model->document2;
                    
        if ($model->load(Yii::$app->request->post())) {
            $files=[];
								
				$files[0] = \yii\web\UploadedFile::getInstance($model, 'photo');
				$model->photo=isset($currentFiles[0])?$currentFiles[0]:'';
				if(!empty($files[0])){
					$ext = end((explode(".", $files[0]->name)));
					$model->photo = uniqid() . '.' . $ext;
					$path = '';
					if(isset(Yii::$app->params['uploadPath'])){
						$path = Yii::$app->params['uploadPath'].'/employee/'.$model->id.'/';
					}
					else{
						$path = Yii::getAlias('@common').'/../files/employee/'.$model->id.'/';
					}
					@mkdir($path, 0777, true);
					@chmod($path, 0777);
					$paths[0] = $path . $model->photo;
					if(isset($currentFiles[0])) @unlink($path . $currentFiles[0]);
				}
											
				$files[1] = \yii\web\UploadedFile::getInstance($model, 'document1');
				$model->document1=isset($currentFiles[1])?$currentFiles[1]:'';
				if(!empty($files[1])){
					$ext = end((explode(".", $files[1]->name)));
					$model->document1 = uniqid() . '.' . $ext;
					$path = '';
					if(isset(Yii::$app->params['uploadPath'])){
						$path = Yii::$app->params['uploadPath'].'/employee/'.$model->id.'/';
					}
					else{
						$path = Yii::getAlias('@common').'/../files/employee/'.$model->id.'/';
					}
					@mkdir($path, 0777, true);
					@chmod($path, 0777);
					$paths[1] = $path . $model->document1;
					if(isset($currentFiles[1])) @unlink($path . $currentFiles[1]);
				}
											
				$files[2] = \yii\web\UploadedFile::getInstance($model, 'document2');
				$model->document2=isset($currentFiles[2])?$currentFiles[2]:'';
				if(!empty($files[2])){
					$ext = end((explode(".", $files[2]->name)));
					$model->document2 = uniqid() . '.' . $ext;
					$path = '';
					if(isset(Yii::$app->params['uploadPath'])){
						$path = Yii::$app->params['uploadPath'].'/employee/'.$model->id.'/';
					}
					else{
						$path = Yii::getAlias('@common').'/../files/employee/'.$model->id.'/';
					}
					@mkdir($path, 0777, true);
					@chmod($path, 0777);
					$paths[2] = $path . $model->document2;
					if(isset($currentFiles[2])) @unlink($path . $currentFiles[2]);
				}
						
            if($model->save()){
				$idx=0;
                foreach($files as $file){
					if(isset($paths[$idx])){
						$file->saveAs($paths[$idx]);
					}
					$idx++;
				}
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                // error in saving model
            }            
        }
		else{
			//return $this->render(['update', 'id' => $model->id]);
			return $this->render('update', [
                'model' => $model,
            ]);
		}
    }

    /**
     * Deletes an existing Employee model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employee model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Employee the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employee::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionEditable() {
		$model = new Employee; // your model can be loaded here
		// Check if there is an Editable ajax request
		if (isset($_POST['hasEditable'])) {
			// read your posted model attributes
			if ($model->load($_POST)) {
				// read or convert your posted information
				$model2 = $this->findModel($_POST['editableKey']);
				$name=key($_POST['Employee'][$_POST['editableIndex']]);
				$value=$_POST['Employee'][$_POST['editableIndex']][$name];
				$model2->$name = $value ;
				$model2->save();
				// return JSON encoded output in the below format
				echo \yii\helpers\Json::encode(['output'=>$value, 'message'=>'']);
				// alternatively you can return a validation error
				// echo \yii\helpers\Json::encode(['output'=>'', 'message'=>'Validation error']);
			}
			// else if nothing to do always return an empty JSON encoded output
			else {
				echo \yii\helpers\Json::encode(['output'=>'', 'message'=>'']);
			}
		return;
		}
		// Else return to rendering a normal view
		return $this->render('view', ['model'=>$model]);
	}
}
