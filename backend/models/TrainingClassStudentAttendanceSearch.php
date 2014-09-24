<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TrainingClassStudentAttendance;

/**
 * TrainingClassStudentSearch represents the model behind the search form about `backend\models\TrainingClassStudent`.
 */
class TrainingClassStudentAttendanceSearch extends TrainingClassStudentAttendance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tb_training_schedule_id', 'tb_training_class_student_id'], 'required'],
            [['tb_training_schedule_id', 'tb_training_class_student_id', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['hours'], 'number'],
            [['created', 'modified', 'deleted'], 'safe'],
            [['reason'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TrainingClassStudentAttendance::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([

            'id' => 'ID',
            'tb_training_schedule_id' => $this->tb_training_schedule_id,
            'tb_training_class_student_id' => $this->tb_training_class_student_id,
            'hours' => $this->hours,
            'reason' => $this->reason,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' =>$this->created_by,
            'modified' => $this->modified,
            'modifiedBy' => $this->modified_by,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deleted_by,
        
        ]);

        return $dataProvider;
    }
}
