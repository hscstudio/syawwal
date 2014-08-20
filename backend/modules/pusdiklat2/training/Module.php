<?php

namespace backend\modules\pusdiklat2\training;

class Module extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\pusdiklat2\training\controllers';

    public function init()
    {
        parent::init();
    }
	
	public function getMenuItems(){
		return [
			['icon'=>'fa fa-fw fa-dashboard','label' => 'Dashboard', 'url' => ['/'.$this->uniqueId.'/default']],
			['icon'=>'fa fa-calendar fa-fw', 'label' => 'Planning', 'url' => ['#'],'items'=>
				[['icon'=>'fa fa-fw fa-code-fork', 'label' => 'Program', 'url' => ['#'], 'items'=>[
					['icon'=>'fa fa-fw fa-list','label' => 'Program', 'url' => ['/'.$this->uniqueId.'/program/index'],'path'=>'program'],
					['icon'=>'fa fa-fw fa-stack-overflow','label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index'],'path'=>'training'],
				]],
				['icon'=>'fa fa-fw fa-university', 'label' => 'Kurikulum', 'url' => ['#'], 'items'=>[
					['icon'=>'fa fa-fw fa-book', 'label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training2/index']],
				]],
				['icon'=>'fa fa-fw fa-users', 'label' => 'Tenaga Pengajar', 'url' => ['#'], 'items'=>[
					['icon'=>'fa fa-fw fa-stack-exchange', 'label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training3/index']],
				]],
			]],
			['icon'=>'fa fa-paper-plane fa-fw', 'label' => 'Execution', 'url' => ['#'],'items'=>
				[['icon'=>'fa fa-fw fa-stack-overflow', 'label' => 'Training', 'url' => ['#']],
				['icon'=>'fa fa-fw fa-user', 'label' => 'Trainer', 'url' => ['#']],
				['icon'=>'fa fa-fw fa-child', 'label' => 'Student', 'url' => ['#']],
			]],
			['icon'=>'fa fa-check-square-o fa-fw', 'label' => 'Evaluation', 'url' => ['#'],'items'=>
				[['icon'=>'fa fa-fw fa-check-square-o','label' => 'Evaluasi Diklat', 'url' => ['#'],'items'=>[
					['icon'=>'fa fa-fw fa-book', 'label' => 'Training', 'url' => ['/'.$this->uniqueId.'/training/index'],'path'=>'training']
				]],
				['icon'=>'fa fa-fw fa-cloud','label' => 'PHD', 'url' => ['#'],'items'=>[
					['icon'=>'fa fa-fw fa-stack-overflow', 'label' => 'Training2', 'url' => ['/'.$this->uniqueId.'/training2/index'],'path'=>'training2']
				]],
				['icon'=>'fa fa-fw fa-book','label' => 'IPK', 'url' => ['#'],'items'=>[
					['icon'=>'fa fa-fw fa-stack-exchange', 'label' => 'Training3', 'url' => ['/'.$this->uniqueId.'/training3/index'],'path'=>'training3']
				]],
			]],
		];
	}
}
