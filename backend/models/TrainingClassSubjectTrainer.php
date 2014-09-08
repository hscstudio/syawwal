<?php

namespace backend\models;

use Yii;
												
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_training_class_subject_trainer".
 *

 * @property integer $id
 * @property integer $tb_training_class_subject_id
 * @property integer $tb_trainer_id
 * @property integer $ref_trainer_type
 * @property integer $cost
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property TrainingClassSubject $tbTrainingClassSubject
 * @property Trainer $tbTrainer
 * @property TrainerType $refTrainerType
 * @property TrainingClassSubjectTrainerAttendance[] $trainingClassSubjectTrainerAttendances
 * @property TrainingClassSubjectTrainerEvaluation[] $trainingClassSubjectTrainerEvaluations
 */
class TrainingClassSubjectTrainer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_training_class_subject_trainer';
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
            [['tb_training_class_subject_id', 'tb_trainer_id', 'ref_trainer_type', 'cost'], 'required'],
            [['tb_training_class_subject_id', 'tb_trainer_id', 'ref_trainer_type', 'cost', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['created', 'modified', 'deleted'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tb_training_class_subject_id' => 'Tb Training Class Subject ID',
            'tb_trainer_id' => 'Tb Trainer ID',
            'ref_trainer_type' => 'Ref Trainer Type',
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
    public function getTrainingClassSubject()
    {
        return $this->hasOne(TrainingClassSubject::className(), ['id' => 'tb_training_class_subject_id']);
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
        return $this->hasOne(TrainerType::className(), ['id' => 'ref_trainer_type']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingClassSubjectTrainerAttendances()
    {
        return $this->hasMany(TrainingClassSubjectTrainerAttendance::className(), ['tb_training_class_subject_trainer_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingClassSubjectTrainerEvaluations()
    {
        return $this->hasMany(TrainingClassSubjectTrainerEvaluation::className(), ['tb_training_class_subject_trainer_id' => 'id']);
    }
}
