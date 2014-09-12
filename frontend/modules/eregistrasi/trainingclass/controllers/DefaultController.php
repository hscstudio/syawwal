<?php

namespace frontend\modules\eregistrasi\trainingclass\controllers;

use yii\web\Controller;
use yii\web\Session;

class DefaultController extends Controller
{
	public $layout = '@hscstudio/heart/views/layouts/column2';	 
	
	public function actionIndex($tb_training_id)
    {
       if(isset($tb_training_id))
	   {
		   $session = new Session;
		   $session['tb_training_id'] = $tb_training_id;
		}
	   return $this->render('index',[
            'tb_training_id' => $tb_training_id
        ]);
    }
}
