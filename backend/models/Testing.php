<?php

namespace backend\models;

use Yii;
																		

/**
 * This is the model class for table "testing".
 *

 * @property integer $id_training
 * @property integer $id_program
 * @property string $name_training
 * @property integer $hours_training
 * @property string $revision_plan_start_training
 * @property string $revision_plan_finish_training
 * @property string $plan_start_training
 * @property string $plan_finish_training
 * @property string $start_training
 * @property string $finish_training
 * @property integer $plan_participant_training
 * @property integer $participant_training
 * @property string $location_training
 * @property string $note_training
 * @property string $update_training
 * @property string $main_user
 * @property string $status_training
 * @property integer $certificate_type
 */
class Testing extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'testing';
    }
	
	

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_program', 'name_training', 'hours_training', 'revision_plan_start_training', 'revision_plan_finish_training', 'plan_start_training', 'plan_finish_training', 'start_training', 'finish_training', 'plan_participant_training', 'participant_training', 'location_training', 'note_training', 'update_training', 'main_user'], 'required'],
            [['id_program', 'hours_training', 'plan_participant_training', 'participant_training', 'certificate_type'], 'integer'],
            [['revision_plan_start_training', 'revision_plan_finish_training', 'plan_start_training', 'plan_finish_training', 'start_training', 'finish_training', 'update_training'], 'safe'],
            [['name_training', 'location_training', 'note_training'], 'string', 'max' => 255],
            [['main_user'], 'string', 'max' => 30],
            [['status_training'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_training' => 'Id Training',
            'id_program' => 'Id Program',
            'name_training' => 'Name Training',
            'hours_training' => 'Hours Training',
            'revision_plan_start_training' => 'Revision Plan Start Training',
            'revision_plan_finish_training' => 'Revision Plan Finish Training',
            'plan_start_training' => 'Plan Start Training',
            'plan_finish_training' => 'Plan Finish Training',
            'start_training' => 'Start Training',
            'finish_training' => 'Finish Training',
            'plan_participant_training' => 'Plan Participant Training',
            'participant_training' => 'Participant Training',
            'location_training' => 'Location Training',
            'note_training' => 'Note Training',
            'update_training' => 'Update Training',
            'main_user' => 'Main User',
            'status_training' => 'Status Training',
            'certificate_type' => 'Certificate Type',
        ];
    }
}
