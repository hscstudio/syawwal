<?php

namespace backend\models;

use Yii;
																					
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_training_class_student_certificate".
 *

 * @property integer $tb_training_class_student_id
 * @property integer $ref_unit_id
 * @property integer $ref_graduate_id
 * @property integer $ref_rank_class_id
 * @property string $number
 * @property string $seri
 * @property string $date
 * @property integer $position
 * @property string $positionDesc
 * @property string $education
 * @property string $eselon2
 * @property string $eselon3
 * @property string $eselon4
 * @property string $satker
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 *
 * @property Graduate $refGraduate
 * @property RankClass $refRankClass
 * @property Unit $refUnit
 * @property TrainingClassStudent $tbTrainingClassStudent
 */
class TrainingClassStudentCertificate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_training_class_student_certificate';
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
            [['tb_training_class_student_id', 'ref_unit_id', 'ref_graduate_id', 'ref_rank_class_id', 'position', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['date', 'created', 'modified', 'deleted'], 'safe'],
            [['satker'], 'string'],
            [['number', 'seri'], 'string', 'max' => 50],
            [['positionDesc'], 'string', 'max' => 255],
            [['education', 'eselon2', 'eselon3', 'eselon4'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tb_training_class_student_id' => 'Tb Training Class Student ID',
            'ref_unit_id' => 'Ref Unit ID',
            'ref_graduate_id' => 'Ref Graduate ID',
            'ref_rank_class_id' => 'Ref Rank Class ID',
            'number' => 'Number',
            'seri' => 'Seri',
            'date' => 'Date',
            'position' => 'Position',
            'positionDesc' => 'Position Desc',
            'education' => 'Education',
            'eselon2' => 'Eselon2',
            'eselon3' => 'Eselon3',
            'eselon4' => 'Eselon4',
            'satker' => 'Satker',
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
    public function getGraduate()
    {
        return $this->hasOne(Graduate::className(), ['id' => 'ref_graduate_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRankClass()
    {
        return $this->hasOne(RankClass::className(), ['id' => 'ref_rank_class_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'ref_unit_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingClassStudent()
    {
        return $this->hasOne(TrainingClassStudent::className(), ['id' => 'tb_training_class_student_id']);
    }
}
