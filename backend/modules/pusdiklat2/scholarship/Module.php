<?php

namespace backend\modules\pusdiklat2\scholarship;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\pusdiklat2\scholarship\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
		];
	}
}
