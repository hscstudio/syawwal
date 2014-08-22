<?php

namespace backend\modules\pusdiklat\planning;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\pusdiklat\planning\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['icon'=>'fa fa-fw fa-code-fork', 'label' => 'Program', 'url' => ['#'], 'items'=>[
				['icon'=>'fa fa-fw fa-list','label' => 'Program', 'url' => ['/'.$this->uniqueId.'/program/index'],'path'=>[
					'program/','program-subject/','program-document/','program-history/','program-subject-document/','program-subject-history/'
				]],
				['icon'=>'fa fa-fw fa-stack-overflow','label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index'],'path'=>['training/']],
			]],
			['icon'=>'fa fa-fw fa-university', 'label' => 'Kurikulum', 'url' => ['#'], 'items'=>[
				['icon'=>'fa fa-fw fa-list','label' => 'Program', 'url' => ['/'.$this->uniqueId.'/program2/index'],'path'=>[
					'program2/','program-subject2/','program-document2/','program-history2/','program-subject-document2/','program-subject-history2/'
				]],
				['icon'=>'fa fa-fw fa-book', 'label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training2/index']],
			]],
			['icon'=>'fa fa-fw fa-users', 'label' => 'Tenaga Pengajar', 'url' => ['#'], 'items'=>[
				['icon'=>'fa fa-fw fa-stack-exchange', 'label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training3/index']],
			]],
		];
	}
}
