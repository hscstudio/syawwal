<?php

namespace backend\models;

use Yii;
																													
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_training".
 *

 * @property integer $id
 * @property integer $tb_program_id
 * @property integer $ref_satker_id
 * @property string $name
 * @property integer $hours
 * @property integer $days
 * @property string $start
 * @property string $finish
 * @property string $note
 * @property integer $type
 * @property integer $studentCount
 * @property integer $classCount
 * @property string $executionSK
 * @property string $resultSK
 * @property integer $costPlan
 * @property integer $costRealisation
 * @property string $sourceCost
 * @property integer $hostel
 * @property integer $reguler
 * @property string $stakeholder
 * @property string $location
 * @property integer $test
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property Satker $refSatker
 * @property Program $tbProgram
 * @property TrainingCertificate[] $trainingCertificates
 * @property TrainingDocument[] $trainingDocuments
 * @property TrainingPic[] $trainingPics
 * @property TrainingSubject[] $trainingSubjects
 * @property TrainingUnitPlan[] $trainingUnitPlans
 */
class Training extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_training';
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
            [['tb_program_id', 'ref_satker_id', 'name'], 'required'],
            [['tb_program_id', 'ref_satker_id', 'hours', 'days', 'type', 'studentCount', 'classCount', 'costPlan', 'costRealisation', 'hostel', 'reguler', 'test', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['start', 'finish', 'created', 'modified', 'deleted'], 'safe'],
            [['name', 'note', 'executionSK', 'resultSK', 'sourceCost', 'stakeholder', 'location'], 'string', 'max' => 255]
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
            'ref_satker_id' => 'Ref Satker ID',
            'name' => 'Name',
            'hours' => 'Hours',
            'days' => 'Days',
            'start' => 'Start',
            'finish' => 'Finish',
            'note' => 'Note',
            'type' => 'Type',
            'studentCount' => 'Student Count',
            'classCount' => 'Class Count',
            'executionSK' => 'Execution Sk',
            'resultSK' => 'Result Sk',
            'costPlan' => 'Cost Plan',
            'costRealisation' => 'Cost Realisation',
            'sourceCost' => 'Source Cost',
            'hostel' => 'Hostel',
            'reguler' => 'Reguler',
            'stakeholder' => 'Stakeholder',
            'location' => 'Location',
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
    public function getSatker()
    {
        return $this->hasOne(Satker::className(), ['id' => 'ref_satker_id']);
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
    public function getTrainingCertificates()
    {
        return $this->hasMany(TrainingCertificate::className(), ['tb_training_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingDocuments()
    {
        return $this->hasMany(TrainingDocument::className(), ['tb_training_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingPics()
    {
        return $this->hasMany(TrainingPic::className(), ['tb_training_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingSubjects()
    {
        return $this->hasMany(TrainingSubject::className(), ['tb_training_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingUnitPlans()
    {
        return $this->hasMany(TrainingUnitPlan::className(), ['tb_training_id' => 'id']);
    }
}
