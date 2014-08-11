<?php

namespace backend\modules\pusdiklat\evaluation\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
		public $layout = '@hscstudio/heart/views/layouts/column2';
	 
	
	public function actionIndex()
    {
        return $this->render('index');
    }
}
