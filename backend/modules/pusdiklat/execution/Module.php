<?php

namespace backend\modules\pusdiklat\execution;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\pusdiklat\execution\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			// Add here your items module
			['label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index']],
			['label' => 'Trainer', 'url' => ['/'.$this->uniqueId.'/trainer/index']],
			['label' => 'Student', 'url' => ['/'.$this->uniqueId.'/student/index']],
		];
	}
}
