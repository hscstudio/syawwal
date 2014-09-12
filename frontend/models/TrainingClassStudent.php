<?php

namespace frontend\models;

use Yii;
																	
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_training_class_student".
 *

 * @property integer $id
 * @property integer $tb_training_class_id
 * @property integer $tb_student_id
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
	 public $name;
	 public $nip;
	 public $telp;
	 public $email;
	 public $unit;
	 
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
            [['tb_training_class_id', 'tb_student_id', 'number', 'presence', 'pretest', 'posttest'], 'required'],
            [['tb_training_class_id', 'tb_student_id', 'headClass', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
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
			'tb_training_id' => 'Training',
            'tb_training_class_id' => 'Training Class',
            'tb_student_id' => 'Tb Student ID',
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
    public function getTrainingClass()
    {
        return $this->hasOne(TrainingClass::className(), ['id' => 'tb_training_class_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'tb_student_id']);
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
    public function getTrainingClassStudentCertificates()
    {
        return $this->hasMany(TrainingClassStudentCertificate::className(), ['tb_training_class_student_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingExecutionEvaluations()
    {
        return $this->hasMany(TrainingExecutionEvaluation::className(), ['tb_training_class_student_id' => 'id']);
    }
	
	/**  
	* @return \yii\db\ActiveQuery  
	*/  
	public function getUser($id)  
	{  
	  return User::findOne($id);  
	} 
	
	/**
     * @inheritdoc
     * @return ProgramQuery
     */
    public static function find()
    {
        return new TrainingClassStudentQuery(get_called_class());
    }
}
class TrainingClassStudentQuery extends \yii\db\ActiveQuery
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
