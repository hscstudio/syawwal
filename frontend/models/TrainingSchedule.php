<?php

namespace frontend\models;

use Yii;
																	
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_training_schedule".
 *

 * @property integer $id
 * @property integer $tb_training_class_id
 * @property integer $tb_training_class_subject_id
 * @property integer $tb_activity_room_id
 * @property string $activity
 * @property string $pic
 * @property string $hours
 * @property string $startTime
 * @property string $finishTime
 * @property integer $session
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property TrainingClass $tbTrainingClass
 * @property TrainingScheduleTrainer[] $trainingScheduleTrainers
 */
class TrainingSchedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_training_schedule';
    }
	
    /**
     * @inheritdoc
     */	
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                        \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created','modified'],
                        \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => 'modified',
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                        \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['createdBy','modifiedBy'],
                        \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => 'modifiedBy',
                ],
            ],
        ];
    }
	

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tb_training_class_id', 'tb_training_class_subject_id', 'tb_activity_room_id', 'session'], 'required'],
            [['tb_training_class_id', 'tb_training_class_subject_id', 'tb_activity_room_id', 'session', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['hours'], 'number'],
            [['startTime', 'finishTime', 'created', 'modified', 'deleted'], 'safe'],
            [['activity'], 'string', 'max' => 255],
            [['pic'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tb_training_class_id' => 'Tb Training Class ID',
            'tb_training_class_subject_id' => 'Tb Training Class Subject ID',
            'tb_activity_room_id' => 'Tb Activity Room ID',
            'activity' => 'Activity',
            'pic' => 'Pic',
            'hours' => 'Hours',
            'startTime' => 'Start Time',
            'finishTime' => 'Finish Time',
            'session' => 'Session',
            'status' => 'Status',
            'created' => 'Created',
            'createdBy' => 'Created By',
            'modified' => 'Modified',
            'modifiedBy' => 'Modified By',
            'deleted' => 'Deleted',
            'deletedBy' => 'Deleted By',
        ];
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingClass()
    {
        return $this->hasOne(TrainingClass::className(), ['id' => 'tb_training_class_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingScheduleTrainers()
    {
        return $this->hasMany(TrainingScheduleTrainer::className(), ['tb_training_schedule_id' => 'id']);
    }
}
