<?php

namespace frontend\models;

use Yii;
																																									
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_student".
 *

 * @property integer $id
 * @property integer $ref_religion_id
 * @property integer $ref_graduate_id
 * @property integer $ref_rank_class_id
 * @property integer $ref_unit_id
 * @property string $name
 * @property string $nickName
 * @property string $frontTitle
 * @property string $backTitle
 * @property string $nip
 * @property string $password_hash
 * @property string $auth_key
 * @property string $born
 * @property string $birthDay
 * @property integer $gender
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property integer $married
 * @property string $photo
 * @property string $blood
 * @property string $position
 * @property string $education
 * @property string $eselon2
 * @property string $eselon3
 * @property string $eselon4
 * @property string $satker
 * @property string $officePhone
 * @property string $officeFax
 * @property string $officeEmail
 * @property string $officeAddress
 * @property string $noSKPangkat
 * @property string $tmtSKPangkat
 * @property string $fileSKPangkat
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
 * @property Religion $refReligion
 * @property Unit $refUnit
 * @property TrainingClassStudent[] $trainingClassStudents
 * @property TrainingClassSubjectTrainerEvaluation[] $trainingClassSubjectTrainerEvaluations
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tb_student';
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
            [['ref_religion_id', 'ref_graduate_id', 'ref_rank_class_id', 'ref_unit_id', 'gender', 'married', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['name', 'password_hash', 'auth_key'], 'required'],
            [['birthDay', 'tmtSKPangkat', 'created', 'modified', 'deleted'], 'safe'],
            [['satker'], 'string'],
            [['name', 'nickName', 'born', 'phone', 'officePhone', 'officeFax'], 'string', 'max' => 50],
            [['frontTitle', 'backTitle'], 'string', 'max' => 20],
            [['nip'], 'string', 'max' => 18],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['email', 'eselon2', 'eselon3', 'eselon4', 'officeEmail'], 'string', 'max' => 100],
            [['address', 'photo', 'position', 'education', 'officeAddress', 'noSKPangkat', 'fileSKPangkat'], 'string', 'max' => 255],
            [['blood'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref_religion_id' => 'Ref Religion ID',
            'ref_graduate_id' => 'Ref Graduate ID',
            'ref_rank_class_id' => 'Ref Rank Class ID',
            'ref_unit_id' => 'Ref Unit ID',
            'name' => 'Name',
            'nickName' => 'Nick Name',
            'frontTitle' => 'Front Title',
            'backTitle' => 'Back Title',
            'nip' => 'Nip',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'born' => 'Born',
            'birthDay' => 'Birth Day',
            'gender' => 'Gender',
            'phone' => 'Phone',
            'email' => 'Email',
            'address' => 'Address',
            'married' => 'Married',
            'photo' => 'Photo',
            'blood' => 'Blood',
            'position' => 'Position',
            'education' => 'Education',
            'eselon2' => 'Eselon2',
            'eselon3' => 'Eselon3',
            'eselon4' => 'Eselon4',
            'satker' => 'Satker',
            'officePhone' => 'Office Phone',
            'officeFax' => 'Office Fax',
            'officeEmail' => 'Office Email',
            'officeAddress' => 'Office Address',
            'noSKPangkat' => 'No Skpangkat',
            'tmtSKPangkat' => 'Tmt Skpangkat',
            'fileSKPangkat' => 'File Skpangkat',
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
    public function getReligion()
    {
        return $this->hasOne(Religion::className(), ['id' => 'ref_religion_id']);
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
    public function getTrainingClassStudents()
    {
        return $this->hasMany(TrainingClassStudent::className(), ['tb_student_id' => 'id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingClassSubjectTrainerEvaluations()
    {
        return $this->hasMany(TrainingClassSubjectTrainerEvaluation::className(), ['tb_student_id' => 'id']);
    }
}
