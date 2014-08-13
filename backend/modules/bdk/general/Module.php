<?php

namespace backend\modules\bdk\general;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\bdk\general\controllers';

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['icon'=>'fa fa-book','label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index'], 'path' => 'training'],
		];
	}
}
