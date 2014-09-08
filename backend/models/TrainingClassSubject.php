<?php

namespace backend\models;

use Yii;
										
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_training_class_subject".
 *

 * @property integer $id
 * @property integer $tb_training_class_id
 * @property integer $tb_program_subject_id
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property TrainingClassStudent[] $trainingClassStudents
 * @property TrainingClass $tbTrainingClass
 * @property ProgramSubject $tbProgramSubject
 * @property TrainingClassSubjectTrainer[] $trainingClassSubjectTrainers
 */
class TrainingClassSubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_training_class_subject';
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
            [['tb_training_class_id', 'tb_program_subject_id'], 'required'],
            [['tb_training_class_id', 'tb_program_subject_id', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
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
            'tb_training_class_id' => 'Tb Training Class ID',
            'tb_program_subject_id' => 'Tb Program Subject ID',
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
    public function getTrainingClassStudents()
    {
        return $this->hasMany(TrainingClassStudent::className(), ['tb_training_class_id' => 'id']);
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
    public function getProgramSubject()
    {
        return $this->hasOne(ProgramSubject::className(), ['id' => 'tb_program_subject_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingClassSubjectTrainers()
    {
        return $this->hasMany(TrainingClassSubjectTrainer::className(), ['tb_training_class_subject_id' => 'id']);
    }
}
