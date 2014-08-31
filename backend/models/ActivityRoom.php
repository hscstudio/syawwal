<?php

namespace backend\models;

use Yii;
												
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_activity_room".
 *

 * @property integer $id
 * @property integer $type
 * @property integer $activity_id
 * @property integer $tb_room_id
 * @property string $startTime
 * @property string $finishTime
 * @property string $note
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 *
 * @property Room $tbRoom
 */
class ActivityRoom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_activity_room';
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
            [['type', 'activity_id', 'tb_room_id', 'startTime', 'finishTime', 'status', 'created', 'createdBy', 'modified', 'modifiedBy'], 'required'],
            [['type', 'activity_id', 'tb_room_id', 'status', 'createdBy', 'modifiedBy'], 'integer'],
            [['startTime', 'finishTime', 'created', 'modified', 'note'], 'safe'],
            [['note'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'activity_id' => 'Activity ID',
            'tb_room_id' => 'Tb Room ID',
            'startTime' => 'Start Time',
            'finishTime' => 'Finish Time',
            'note' => 'Note',
            'status' => 'Status',
            'created' => 'Created',
            'createdBy' => 'Created By',
            'modified' => 'Modified',
            'modifiedBy' => 'Modified By',
        ];
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(Room::className(), ['id' => 'tb_room_id']);
    }
}
