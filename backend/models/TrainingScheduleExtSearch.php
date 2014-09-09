<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * TrainingScheduleSearch represents the model behind the search form about `backend\models\TrainingSchedule`.
 */
class TrainingScheduleExtSearch  extends Model // extends TrainingSchedule
{
    public  $hours, $minutes, $tb_training_class_subject_id, 
			$startDate, $startTime,
			$activity, $pic, $scheduleDate;
	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id', 'tb_training_class_id', , 'tb_activity_room_id', 'session', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            //[['startTime', 'finishTime', 'created', 'modified', 'deleted'], 'safe'],
            //
			[['hours'], 'number'],
			[['tb_training_class_subject_id','minutes'], 'integer'],
			[['activity', 'pic', 'startTime', 'startDate', 'scheduleDate'], 'safe'],
        ];
    }

     public function attributeLabels()
    {
        return [
            'tb_training_class_subject_id' => 'Training Class Subject',
            'activity' => 'Other Activity',
            'pic' => 'Pic',
            'hours' => 'In Hours (JP)',
			'minutes' => 'In Minutes',
            'startTime' => 'Start Time',
            'startDate' => 'Start Date',
			'scheduleDate' => 'Schedule Date',
        ];
    }
}
