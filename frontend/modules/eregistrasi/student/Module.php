<?php

namespace frontend\modules\eregistrasi\student;

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
			['icon'=>'fa fa-fw fa-user', 'label' => 'Student', 'url' => ['/'.$this->uniqueId.'/student/index']],
		];
	}
}
