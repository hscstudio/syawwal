<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TrainingScheduleTrainerAttendance;

/**
 * TrainingScheduleTrainerAttendanceSearch represents the model behind the search form about `backend\models\TrainingScheduleTrainerAttendance`.
 */
class TrainingScheduleTrainerAttendanceSearch extends TrainingScheduleTrainerAttendance
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tb_training_schedule_trainer_id', 'hours', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['reason', 'created', 'modified', 'deleted'], 'safe'],
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
        $query = TrainingScheduleTrainerAttendance::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tb_training_schedule_trainer_id' => $this->tb_training_schedule_trainer_id,
            'hours' => $this->hours,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
        ]);

        $query->andFilterWhere(['like', 'reason', $this->reason]);

        return $dataProvider;
    }
}
