<?php

namespace backend\models;

use Yii;
													
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_program_subject_document".
 *

 * @property integer $id
 * @property integer $tb_program_subject_id
 * @property string $name
 * @property string $type
 * @property string $filename
 * @property string $description
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 */
class ProgramSubjectDocument extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_program_subject_document';
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
            [['tb_program_subject_id', 'name', 'type', 'filename'], 'required'],
            [['tb_program_subject_id', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['name', 'filename', 'description'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tb_program_subject_id' => 'Tb Program Subject ID',
            'name' => 'Name',
            'type' => 'Type',
            'filename' => 'Filename',
            'description' => 'Description',
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
     * @inheritdoc
     * @return ProgramQuery
     */
    public static function find()
    {
        return new ProgramSubjectDocumentQuery(get_called_class());
    }
}

class ProgramSubjectDocumentQuery extends \yii\db\ActiveQuery
{
	public function active($status=1)
    {
        $this->andWhere(['status'=>$status]);
        return $this;
    }
}

