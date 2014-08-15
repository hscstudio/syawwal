<?php

namespace backend\models;

use Yii;
																			
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_program_history".
 *

 * @property integer $tb_program_id
 * @property integer $revision
 * @property integer $ref_satker_id
 * @property string $number
 * @property string $name
 * @property integer $hours
 * @property integer $days
 * @property integer $test
 * @property integer $type
 * @property string $note
 * @property integer $validationStatus
 * @property string $validationNote
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 */
class ProgramHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_program_history';
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
            [['tb_program_id', 'revision', 'name', 'type', 'note'], 'required'],
            [['tb_program_id', 'revision', 'ref_satker_id', 'hours', 'days', 'test', 'type', 'validationStatus', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['number'], 'string', 'max' => 15],
            [['name', 'note', 'validationNote'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tb_program_id' => 'Tb Program ID',
            'revision' => 'Revision',
            'ref_satker_id' => 'Ref Satker ID',
            'number' => 'Number',
            'name' => 'Name',
            'hours' => 'Hours',
            'days' => 'Days',
            'test' => 'Test',
            'type' => 'Type',
            'note' => 'Note',
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
}
