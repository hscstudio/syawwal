<?php

namespace backend\models;

use Yii;
																
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_room".
 *

 * @property integer $id
 * @property integer $ref_satker_id
 * @property string $code
 * @property string $name
 * @property integer $capacity
 * @property integer $owner
 * @property integer $computer
 * @property integer $hostel
 * @property string $address
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property Satker $refSatker
 * @property TrainingSchedule[] $trainingSchedules
 */
class Room extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_room';
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
			'autoAttributeStamp' => [
                'class' => \yii\behaviors\AttributeBehavior::className(),
                'attributes' => [
                    \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => 'id',
                ],
                'value' => function ($event) {
                    /* Enhance oleh om Misbah master */
					return self::find()->max('id')+1;
                },
            ],	
        ];
    }
	

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref_satker_id', 'capacity', 'owner', 'computer', 'hostel', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['code', 'name'], 'required'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['code'], 'string', 'max' => 25],
            [['name', 'address'], 'string', 'max' => 255],
            [['code'], 'unique']
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
            'code' => 'Code',
            'name' => 'Name',
            'capacity' => 'Capacity',
            'owner' => 'Owner',
            'computer' => 'Computer',
            'hostel' => 'Hostel',
            'address' => 'Address',
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
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingSchedules()
    {
        return $this->hasMany(TrainingSchedule::className(), ['tb_room_id' => 'id']);
    }
}
