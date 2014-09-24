<?php

namespace frontend\models;

use Yii;
																	
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_training_execution_evaluation".
 *

 * @property integer $id
 * @property integer $tb_training_class_student_id
 * @property string $value
 * @property string $text1
 * @property string $text2
 * @property string $text3
 * @property string $text4
 * @property string $text5
 * @property integer $overall
 * @property string $comment
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property TrainingClassStudent $tbTrainingClassStudent
 */
class TrainingExecutionEvaluation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	//public $text;
    public static function tableName()
    {
        return 'tb_training_execution_evaluation';
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
            [['tb_training_class_student_id'], 'required'],
            [['tb_training_class_student_id', 'overall', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['value'], 'string', 'max' => 255],
            [['text1', 'text2', 'text3', 'text4', 'text5'], 'string', 'max' => 500],
            [['comment'], 'string', 'max' => 3000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tb_training_class_student_id' => 'Tb Training Class Student ID',
            'value' => '',
            'text1' => 'Text1',
            'text2' => 'Text2',
            'text3' => 'Text3',
            'text4' => 'Text4',
            'text5' => 'Text5',
            'overall' => '',
            'comment' => 'Comment',
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
    public function getTrainingClassStudent()
    {
        return $this->hasOne(TrainingClassStudent::className(), ['id' => 'tb_training_class_student_id']);
    }
}
