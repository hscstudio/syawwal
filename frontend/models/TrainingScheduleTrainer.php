<?php

namespace frontend\models;

use Yii;
												
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_training_schedule_trainer".
 *

 * @property integer $id
 * @property integer $tb_training_schedule_id
 * @property integer $tb_trainer_id
 * @property integer $ref_trainer_type_id
 * @property integer $cost
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property TrainerType $refTrainerType
 * @property TrainingSchedule $tbTrainingSchedule
 * @property Trainer $tbTrainer
 */
class TrainingScheduleTrainer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $MP;
	 
    public static function tableName()
    {
        return 'tb_training_schedule_trainer';
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
            [['tb_training_schedule_id', 'tb_trainer_id', 'ref_trainer_type_id'], 'required'],
            [['tb_training_schedule_id', 'tb_trainer_id', 'ref_trainer_type_id', 'cost', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['tb_training_schedule_id', 'tb_trainer_id'], 'unique', 'targetAttribute' => ['tb_training_schedule_id', 'tb_trainer_id'], 'message' => 'The combination of Tb Training Schedule ID and Tb Trainer ID has already been taken.']
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
            'tb_trainer_id' => 'Tb Trainer ID',
            'ref_trainer_type_id' => 'Ref Trainer Type ID',
            'cost' => 'Cost',
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
    public function getTrainerType()
    {
        return $this->hasOne(TrainerType::className(), ['id' => 'ref_trainer_type_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingSchedule()
    {
        return $this->hasOne(TrainingSchedule::className(), ['id' => 'tb_training_schedule_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainer()
    {
        return $this->hasOne(Trainer::className(), ['id' => 'tb_trainer_id']);
    }
}
