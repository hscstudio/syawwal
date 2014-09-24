<?php

namespace backend\models;

use Yii;
																	
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_training_class_student".
 *

 * @property integer $id
 * @property integer $tb_training_class_id
 * @property integer $tb_training_student_id
 * @property string $number
 * @property integer $headClass
 * @property string $activity
 * @property string $presence
 * @property string $pretest
 * @property string $posttest
 * @property string $test
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property TrainingClassSubject $tbTrainingClass
 * @property Student $tbStudent
 * @property TrainingClassStudentAttendance[] $trainingClassStudentAttendances
 * @property TrainingClassStudentCertificate[] $trainingClassStudentCertificates
 * @property TrainingExecutionEvaluation[] $trainingExecutionEvaluations
 */
class TrainingClassStudent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_training_class_student';
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
            [['tb_training_class_id', 'tb_training_student_id'], 'required'],
            [['tb_training_class_id', 'tb_training_student_id', 'headClass', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['activity', 'presence', 'pretest', 'posttest', 'test'], 'number'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['number'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tb_training_class_id' => 'Tb Training Class ID',
            'tb_training_student_id' => 'Tb Training Student ID',
            'number' => 'Number',
            'headClass' => 'Head Class',
            'activity' => 'Activity',
            'presence' => 'Presence',
            'pretest' => 'Pretest',
            'posttest' => 'Posttest',
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
    public function getTraining()
    {
        return $this->hasOne(Training::className(), ['id' => 'tb_training_id']);
    }
	
	public function getTrainingClass()
    {
        return $this->hasOne(TrainingClassSubject::className(), ['id' => 'tb_training_class_id']);
    }
	
	/**
	* @return \yii\db\ActiveQuery
	*/
	public function getTrainingClassStudentCertificate()
	{
		return $this->hasOne(TrainingClassStudentCertificate::className(), ['tb_training_class_student_id' => 'id']);
	}

	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingStudent()
    {
        return $this->hasOne(TrainingStudent::className(), ['id' => 'tb_training_student_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingClassStudentAttendances()
    {
        return $this->hasMany(TrainingClassStudentAttendance::className(), ['tb_training_schedule_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingExecutionEvaluations()
    {
        return $this->hasMany(TrainingExecutionEvaluation::className(), ['tb_training_class_student_id' => 'id']);
    }
}
