<?php

namespace backend\models;

use Yii;
																															
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_training_history".
 *

 * @property integer $tb_training_id
 * @property integer $tb_program_id
 * @property integer $tb_program_revision
 * @property integer $revision
 * @property integer $ref_satker_id
 * @property string $number  
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
 */
class TrainingHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_training_history';
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
            [['tb_training_id', 'tb_program_id', 'tb_program_revision', 'revision', 'start', 'finish', 'ref_satker_id', 'name'], 'required'],
            [['tb_training_id', 'tb_program_id', 'tb_program_revision', 'revision', 'ref_satker_id', 'studentCount', 'classCount', 'costPlan', 'costRealisation', 'hostel', 'reguler', 'status', 'createdBy', 'modifiedBy', 'deletedBy', 'approvedStatus', 'approvedStatusBy'], 'integer'],
            [['start', 'finish', 'created', 'modified', 'deleted', 'approvedStatusDate'], 'safe'],
			[['number'], 'string', 'max' => 30],
            [['name', 'note', 'executionSK', 'resultSK', 'sourceCost', 'stakeholder', 'location', 'approvedStatusNote'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tb_training_id' => 'Tb Training ID',
            'tb_program_id' => 'Tb Program ID',
            'tb_program_revision' => 'Tb Program Revision',
            'revision' => 'Revision',
            'ref_satker_id' => 'Ref Satker ID',
            'number' => 'Number',
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
	
	public static function getRevision($id){
		return self::find()->where(['tb_training_id' => $id,])->max('revision');
	}


    public function getTraining()
    {
        return $this->hasOne(Training::className(), ['id' => 'tb_training_id']);
    }
}
