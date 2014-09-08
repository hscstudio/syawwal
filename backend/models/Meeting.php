<?php

namespace backend\models;

use Yii;
																	
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_meeting".
 *

 * @property integer $id
 * @property integer $ref_satker_id
 * @property string $executor
 * @property string $name
 * @property string $startTime
 * @property string $finishTime
 * @property string $note
 * @property integer $attendanceCount
 * @property integer $classCount
 * @property integer $hostel
 * @property string $location
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property Satker $refSatker
 */
class Meeting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_meeting';
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
            [['ref_satker_id', 'executor',  'name', 'startTime', 'finishTime'], 'required'],
            [['ref_satker_id', 'attendanceCount', 'classCount', 'hostel', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['startTime', 'finishTime', 'created', 'modified', 'deleted'], 'safe'],
            [['name', 'note', 'location'], 'string', 'max' => 255],
			[['executor'], 'string', 'max' => 50],
			//['finishTime','compare','compareAttribute'=>'startTime','operator'=>'>','message'=>'{attribute} must be greater than {compareValue}.'],
			//\hscstudio\heart\helpers\DateTimeCompareValidator::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref_satker_id' => 'Ref Satker ID',
            'executor' => 'Executor',
			'name' => 'Name',
            'startTime' => 'Start Time',
            'finishTime' => 'Finish Time',
            'note' => 'Note',
            'attendanceCount' => 'Attendance Count',
            'classCount' => 'Class Count',
            'hostel' => 'Hostel',
            'location' => 'Location',
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
    public function getSatker()
    {
        return $this->hasOne(Satker::className(), ['id' => 'ref_satker_id']);
    }
}
