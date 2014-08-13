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
			['icon'=>'fa fa-fw fa-check-square-o','label' => 'Evaluasi Diklat', 'url' => ['/'.$this->uniqueId.'/ed/index'], 'path' => 'evaluation'],
			['icon'=>'fa fa-fw fa-suitcase','label' => 'Pengelola Hasil Diklat', 'url' => ['/'.$this->uniqueId.'/phd/index'], 'path' => 'evaluation'],
			['icon'=>'fa fa-fw fa-legal','label' => 'IPK', 'url' => ['/'.$this->uniqueId.'/ipk/index'], 'path' => 'evaluation'],
		];
	}
}
