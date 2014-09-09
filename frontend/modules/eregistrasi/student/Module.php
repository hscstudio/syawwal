<?php

namespace frontend\modules\eregistrasi\student;
use Yii;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\eregistrasi\student\controllers';

    public function init()
    {
        parent::init();
    }	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			// Add here your items module
			['icon'=>'fa fa-fw fa-user', 'label' => 'Student', 'url' => ['/'.$this->uniqueId.'/student/update?id='.Yii::$app->user->identity->id],'path'=>'/student/'],
			['icon'=>'fa fa-fw fa-book', 'label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training-class-student/index'],'path'=>'/training-class-student/'],
		];
	}
}
