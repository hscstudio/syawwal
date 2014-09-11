<?php

namespace backend\modules\bdk\general;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\bdk\general\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['icon'=>'fa fa-fw fa-briefcase', 'label' => 'Meeting', 'url' => ['/'.$this->uniqueId.'/meeting-request/index'],'path'=>['meeting-request/',]],
			['icon'=>'fa fa-fw fa-calendar','label' => 'Room Request Center', 'url' => ['/'.$this->uniqueId.'/activity-room/list'], 'path' => 'activity-room/'],
			['icon'=>'fa fa-fw fa-inbox','label' => 'Room Management', 'url' => ['/'.$this->uniqueId.'/room/index'], 'path' => '/room/'],
		];
	}
}
