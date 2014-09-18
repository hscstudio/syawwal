<?php

namespace backend\models;

use Yii;
												
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_training_class_student_attendance".
 *

 * @property integer $id
 * @property integer $tb_training_schedule_id
 * @property integer $tb_training_class_student_id
 * @property string $hours
 * @property string $reason
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property TrainingClassStudent $tbTrainingClassStudent
 * @property TrainingClassStudent $tbTrainingSchedule
 */
class TrainingClassStudentAttendance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_training_class_student_attendance';
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
            [['tb_training_schedule_id', 'tb_training_class_student_id'], 'required'],
            [['tb_training_schedule_id', 'tb_training_class_student_id', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['hours'], 'number'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['reason'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tb_training_schedule_id' => 'Tb Training Schedule ID',
            'tb_training_class_student_id' => 'Tb Training Class Student ID',
            'hours' => 'Hours',
            'reason' => 'Reason',
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
    public function getTrainingClassStudent()
    {
        return $this->hasOne(TrainingClassStudent::className(), ['id' => 'tb_training_class_student_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingSchedule()
    {
        return $this->hasOne(TrainingClassStudent::className(), ['id' => 'tb_training_schedule_id']);
    }
}
