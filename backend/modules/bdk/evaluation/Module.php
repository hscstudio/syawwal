<?php

namespace backend\modules\bdk\evaluation;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\bdk\evaluation\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['icon'=>'fa fa-fw fa-briefcase', 'label' => 'Meeting', 'url' => ['/'.$this->uniqueId.'/meeting/index'],'path'=>['meeting/',]],
		];
	}
}
