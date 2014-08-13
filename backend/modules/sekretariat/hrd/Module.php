<?php

namespace backend\modules\sekretariat\hrd;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\sekretariat\hrd\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['icon'=>'fa fa-fw fa-users','label' => 'Employee', 'url' => ['/'.$this->uniqueId.'/employee/index'],'path'=>'employee'],
		];
	}
}
