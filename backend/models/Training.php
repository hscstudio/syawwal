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
 * @property integer $tb_program_revision
 * @property integer $ref_satker_id
 * @property string $name
 * @property string $start
 * @property string $finish
 * @property string $note
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
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 * @property integer $approvedStatus
 * @property string $approvedStatusNote
 * @property string $approvedStatusDate
 * @property integer $approvedStatusBy
 *
 * @property Satker $refSatker
 * @property Program $tbProgram
 * @property TrainingCertificate[] $trainingCertificates
 * @property TrainingDocument[] $trainingDocuments
 * @property TrainingPic[] $trainingPics
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
            [['tb_program_id', 'tb_program_revision', 'ref_satker_id', 'name'], 'required'],
            [['tb_program_id', 'tb_program_revision', 'ref_satker_id', 'studentCount', 'classCount', 'costPlan', 'costRealisation', 'hostel', 'reguler', 'status', 'createdBy', 'modifiedBy', 'deletedBy', 'approvedStatus', 'approvedStatusBy'], 'integer'],
            [['start', 'finish', 'created', 'modified', 'deleted', 'approvedStatusDate'], 'safe'],
            [['name', 'note', 'executionSK', 'resultSK', 'sourceCost', 'stakeholder', 'location', 'approvedStatusNote'], 'string', 'max' => 255]
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
            'tb_program_revision' => 'Tb Program Revision',
            'ref_satker_id' => 'Ref Satker ID',
            'name' => 'Name',
            'start' => 'Start',
            'finish' => 'Finish',
            'note' => 'Note',
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
            'status' => 'Status',
            'created' => 'Created',
            'createdBy' => 'Created By',
            'modified' => 'Modified',
            'modifiedBy' => 'Modified By',
            'deleted' => 'Deleted',
            'deletedBy' => 'Deleted By',
            'approvedStatus' => 'Approved Status',
            'approvedStatusNote' => 'Approved Status Note',
            'approvedStatusDate' => 'Approved Status Date',
            'approvedStatusBy' => 'Approved Status By',
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
    public function getTrainingUnitPlans()
    {
        return $this->hasMany(TrainingUnitPlan::className(), ['tb_training_id' => 'id']);
    }
	/**
     * @inheritdoc
     * @return ProgramQuery
     */
    public static function find()
    {
        return new TrainingQuery(get_called_class());
    }
}

class TrainingQuery extends \yii\db\ActiveQuery
{
    public function currentSatker()
    {
        $this->andWhere(['ref_satker_id'=>(int)Yii::$app->user->identity->employee->ref_satker_id]);
        return $this;
    }
	
	public function active($status=1)
    {
        $this->andWhere(['status'=>$status]);
        return $this;
    }
}
