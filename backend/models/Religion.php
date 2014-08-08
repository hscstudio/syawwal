<?php

namespace backend\models;

use Yii;
									
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "ref_religion".
 *

 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property Employee[] $employees
 * @property Student[] $students
 * @property Trainer[] $trainers
 */
class Religion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_religion';
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
            [['id', 'name'], 'required'],
            [['id', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique']
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
    public function getEmployees()
    {
        return $this->hasMany(Employee::className(), ['ref_religion_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['ref_religion_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainers()
    {
        return $this->hasMany(Trainer::className(), ['ref_religion_id' => 'id']);
    }
}
