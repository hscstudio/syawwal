<?php

namespace backend\models;

use Yii;
		
use yii\db\ActiveRecord;								
use yii\behaviors\TimestampBehavior;
use yii\behaviors\AttributeBehavior;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "tb_employee".
 *

 * @property integer $id
 * @property integer $ref_satker_id
 * @property integer $ref_unit_id
 * @property integer $ref_religion_id
 * @property integer $ref_rank_class_id
 * @property integer $ref_graduate_id
 * @property integer $ref_sta_unit_id
 * @property string $name
 * @property string $nickName
 * @property string $frontTitle
 * @property string $backTitle
 * @property string $nip
 * @property string $born
 * @property string $birthDay
 * @property integer $gender
 * @property string $phone
 * @property string $email
 * @property string $address
 * @property integer $married
 * @property string $photo
 * @property string $blood
 * @property integer $position
 * @property string $positionDesc
 * @property string $education
 * @property string $officePhone
 * @property string $officeFax
 * @property string $officeEmail
 * @property string $officeAddress
 * @property string $document1
 * @property string $document2
 * @property integer $status
 * @property string $created
 * @property integer $createdBy
 * @property string $modified
 * @property integer $modifiedBy
 * @property string $deleted
 * @property integer $deletedBy
 * @property integer $user_id
 * @property string $public_email
 * @property string $gravatar_email
 * @property string $gravatar_id
 * @property string $location
 * @property string $bio
 * @property string $website
 *
 * @property Admin[] $admins
 * @property Graduate $refGraduate
 * @property RankClass $refRankClass
 * @property Religion $refReligion
 * @property Satker $refSatker
 * @property StaUnit $refStaUnit
 * @property Unit $refUnit
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	public $ref_sub_satker;
	public $ref_sub_satker_2;
	 
    public static function tableName()
    {
        return 'tb_employee';
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
            [['ref_satker_id', 'ref_unit_id', 'ref_religion_id', 'ref_rank_class_id', 'ref_graduate_id', 'ref_sta_unit_id', 'position', 'gender', 'married', 'status', 'createdBy', 'modifiedBy', 'deletedBy', 'user_id'], 'integer'],
            [['name', 'user_id'], 'required'],
            [['birthDay', 'created', 'modified', 'deleted','ref_sub_satker','ref_sub_satker_2'], 'safe'],
            [['bio'], 'string'],
            [['name', 'nickName', 'born', 'phone', 'officePhone', 'officeFax'], 'string', 'max' => 50],
            [['frontTitle', 'backTitle'], 'string', 'max' => 20],
            [['nip'], 'string', 'max' => 18],
            [['email', 'officeEmail'], 'string', 'max' => 100],
            [['address', 'photo', 'positionDesc', 'education', 'officeAddress', 'document1', 'document2', 'public_email', 'gravatar_email', 'location', 'website'], 'string', 'max' => 255],
            [['blood'], 'string', 'max' => 10],
            [['gravatar_id'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ref_satker_id' => 'Ref Satker ID',
            'ref_unit_id' => 'Ref Unit ID',
            'ref_religion_id' => 'Ref Religion ID',
            'ref_rank_class_id' => 'Ref Rank Class ID',
            'ref_graduate_id' => 'Ref Graduate ID',
            'ref_sta_unit_id' => 'Ref Sta Unit ID',
            'name' => 'Name',
            'nickName' => 'Nick Name',
            'frontTitle' => 'Front Title',
            'backTitle' => 'Back Title',
            'nip' => 'Nip',
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
			'positionDesc' => 'Position Description',
            'education' => 'Education',
            'officePhone' => 'Office Phone',
            'officeFax' => 'Office Fax',
            'officeEmail' => 'Office Email',
            'officeAddress' => 'Office Address',
            'document1' => 'Document1',
            'document2' => 'Document2',
            'status' => 'Status',
            'created' => 'Created',
            'createdBy' => 'Created By',
            'modified' => 'Modified',
            'modifiedBy' => 'Modified By',
            'deleted' => 'Deleted',
            'deletedBy' => 'Deleted By',
            'user_id' => 'User ID',
            'public_email' => 'Public Email',
            'gravatar_email' => 'Gravatar Email',
            'gravatar_id' => 'Gravatar ID',
            'location' => 'Location',
            'bio' => 'Bio',
            'website' => 'Website',
        ];
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmins()
    {
        return $this->hasMany(Admin::className(), ['tb_employee_id' => 'id']);
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
    public function getSatker()
    {
        return $this->hasOne(Satker::className(), ['id' => 'ref_satker_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaUnit()
    {
        return $this->hasOne(StaUnit::className(), ['id' => 'ref_sta_unit_id']);
    }
	    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::className(), ['id' => 'ref_unit_id']);
    }
	
	public function getTrainer()
    {
        return $this->hasOne(Trainer::className(), ['nip' => 'nip'])->onCondition('LENGTH('.Trainer::tableName().'.nip)>=9');
    }
	
	public function getStudent()
    {
        return $this->hasOne(Student::className(), ['nip' => 'nip'])->onCondition('LENGTH('.Student::tableName().'.nip)>=9');
    }
}
