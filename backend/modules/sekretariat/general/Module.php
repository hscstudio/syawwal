<?php

namespace backend\modules\sekretariat\general;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\sekretariat\general\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['icon'=>'fa fa-fw fa-stack-overflow', 'label' => 'Meeting', 'url' => ['/'.$this->uniqueId.'/meeting/index'],'path'=>['meeting/',
			]],
			['icon'=>'fa fa-fw fa-inbox', 'label' => 'Room', 'url' => ['/'.$this->uniqueId.'/room/index'],'path'=>'room/'],
			['icon'=>'fa fa-fw fa-stack-overflow', 'label' => 'Room Request', 'url' => ['/'.$this->uniqueId.'/meeting-request/index'],'path'=>['meeting-request/',
				]],
		];
	}
}
