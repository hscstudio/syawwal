<?php

namespace backend\models;

use Yii;
															
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_program_subject_history".
 *

 * @property integer $tb_program_subject_id
 * @property integer $tb_program_id
 * @property integer $revision
 * @property integer $type
 * @property string $name
 * @property integer $hours
 * @property integer $sort
 * @property integer $test
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 */
class ProgramSubjectHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_program_subject_history';
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
            [['tb_program_subject_id', 'tb_program_id', 'revision', 'name', 'hours', 'sort'], 'required'],
            [['tb_program_subject_id', 'tb_program_id', 'revision', 'type', 'hours', 'sort', 'test', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
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
            'tb_program_subject_id' => 'Tb Program Subject ID',
            'tb_program_id' => 'Tb Program ID',
            'revision' => 'Revision',
            'type' => 'Type',
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
	
}
