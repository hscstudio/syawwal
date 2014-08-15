<?php

namespace backend\modules\pusdiklat\execution;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\pusdiklat\execution\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['icon'=>'fa fa-fw fa-stack-overflow', 'label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index'],'path'=>'training'],
			['icon'=>'fa fa-fw fa-user', 'label' => 'Trainer', 'url' => ['/'.$this->uniqueId.'/trainer/index'],'path'=>'trainer'],
			['icon'=>'fa fa-fw fa-child', 'label' => 'Student', 'url' => ['/'.$this->uniqueId.'/student/index'],'path'=>'student'],
		];
	}
}
