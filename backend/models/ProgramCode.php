<?php

namespace backend\models;

use Yii;
											
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "ref_program_code".
 *

 * @property integer $id
 * @property string $name
 * @property string $code
 * @property integer $parent_id
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 */
class ProgramCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_program_code';
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
            [['name', 'code'], 'required'],
            [['parent_id', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 25],
            [['code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'code' => 'Code',
            'parent_id' => 'Parent ID',
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
