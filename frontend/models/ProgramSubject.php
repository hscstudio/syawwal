<?php

namespace frontend\models;

use Yii;
														
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_program_subject".
 *

 * @property integer $id
 * @property integer $tb_program_id
 * @property integer $ref_subject_type_id
 * @property string $name
 * @property string $hours
 * @property integer $sort
 * @property integer $test
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property Program $tbProgram
 * @property SubjectType $refSubjectType
 * @property ProgramSubjectDocument[] $programSubjectDocuments
 * @property ProgramSubjectHistory[] $programSubjectHistories
 * @property TrainingClassSubject[] $trainingClassSubjects
 * @property TrainingSubjectTrainerRecommendation[] $trainingSubjectTrainerRecommendations
 */
class ProgramSubject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_program_subject';
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
            [['tb_program_id', 'ref_subject_type_id', 'name', 'hours', 'sort'], 'required'],
            [['tb_program_id', 'ref_subject_type_id', 'sort', 'test', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['hours'], 'number'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tb_program_id' => 'Tb Program ID',
            'ref_subject_type_id' => 'Ref Subject Type ID',
            'name' => 'Name',
            'hours' => 'Hours',
            'sort' => 'Sort',
            'test' => 'Test',
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
    public function getProgram()
    {
        return $this->hasOne(Program::className(), ['id' => 'tb_program_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubjectType()
    {
        return $this->hasOne(SubjectType::className(), ['id' => 'ref_subject_type_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramSubjectDocuments()
    {
        return $this->hasMany(ProgramSubjectDocument::className(), ['tb_program_subject_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramSubjectHistories()
    {
        return $this->hasMany(ProgramSubjectHistory::className(), ['tb_program_subject_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingClassSubjects()
    {
        return $this->hasMany(TrainingClassSubject::className(), ['tb_program_subject_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingSubjectTrainerRecommendations()
    {
        return $this->hasMany(TrainingSubjectTrainerRecommendation::className(), ['tb_program_subject_id' => 'id']);
    }
}
