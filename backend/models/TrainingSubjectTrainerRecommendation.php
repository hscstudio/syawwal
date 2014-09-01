<?php

namespace backend\models;

use Yii;
														
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_training_subject_trainer_recommendation".
 *

 * @property integer $id
 * @property integer $tb_training_id
 * @property integer $tb_program_subject_id
 * @property integer $tb_trainer_id
 * @property integer $type
 * @property string $note
 * @property integer $sort
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property ProgramSubject $tbProgramSubject
 * @property Trainer $tbTrainer
 */
class TrainingSubjectTrainerRecommendation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_training_subject_trainer_recommendation';
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
            [['tb_training_id', 'tb_program_subject_id', 'tb_trainer_id'], 'required'],
            [['tb_training_id', 'tb_program_subject_id', 'tb_trainer_id', 'ref_trainer_type_id', 'sort', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['created', 'modified', 'deleted'], 'safe'],
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
            'tb_training_id' => 'Tb Training ID',
            'tb_program_subject_id' => 'Tb Program Subject ID',
            'tb_trainer_id' => 'Tb Trainer ID',
            'ref_trainer_type_id' => 'Subject Type',
            'note' => 'Note',
            'sort' => 'Sort',
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
    public function getProgramSubject()
    {
        return $this->hasOne(ProgramSubject::className(), ['id' => 'tb_program_subject_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainer()
    {
        return $this->hasOne(Trainer::className(), ['id' => 'tb_trainer_id']);
    }
	
	/** 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getTrainerType() 
   { 
       return $this->hasOne(TrainerType::className(), ['id' => 'ref_trainer_type_id']); 
   } 
}
