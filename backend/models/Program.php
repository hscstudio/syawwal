<?php

namespace backend\models;

use Yii;
																
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_program".
 *

 * @property integer $id
 * @property integer $ref_satker_id
 * @property string $number
 * @property string $name
 * @property integer $hours
 * @property integer $days
 * @property integer $test
 * @property integer $validationStatus
 * @property string $validationNote
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property Satker $refSatker
 * @property ProgramDocument[] $programDocuments
 * @property ProgramSubject[] $programSubjects
 * @property Training[] $trainings
 */
class Program extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_program';
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
            [['ref_satker_id', 'hours', 'days', 'test', 'validationStatus', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['name'], 'required'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['number'], 'string', 'max' => 15],
            [['name', 'validationNote'], 'string', 'max' => 255]
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
            'number' => 'Number',
            'name' => 'Name',
            'hours' => 'Hours',
            'days' => 'Days',
            'test' => 'Test',
            'validationStatus' => 'Validation Status',
            'validationNote' => 'Validation Note',
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
    public function getProgramDocuments()
    {
        return $this->hasMany(ProgramDocument::className(), ['tb_program_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramSubjects()
    {
        return $this->hasMany(ProgramSubject::className(), ['tb_program_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainings()
    {
        return $this->hasMany(Training::className(), ['tb_program_id' => 'id']);
    }
}
