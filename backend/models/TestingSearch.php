<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Testing;

/**
 * TestingSearch represents the model behind the search form about `backend\models\Testing`.
 */
class TestingSearch extends Testing
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_training', 'id_program', 'hours_training', 'plan_participant_training', 'participant_training', 'certificate_type'], 'integer'],
            [['name_training', 'revision_plan_start_training', 'revision_plan_finish_training', 'plan_start_training', 'plan_finish_training', 'start_training', 'finish_training', 'location_training', 'note_training', 'update_training', 'main_user', 'status_training'], 'safe'],
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
        $query = Testing::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_training' => $this->id_training,
            'id_program' => $this->id_program,
            'hours_training' => $this->hours_training,
            'revision_plan_start_training' => $this->revision_plan_start_training,
            'revision_plan_finish_training' => $this->revision_plan_finish_training,
            'plan_start_training' => $this->plan_start_training,
            'plan_finish_training' => $this->plan_finish_training,
            'start_training' => $this->start_training,
            'finish_training' => $this->finish_training,
            'plan_participant_training' => $this->plan_participant_training,
            'participant_training' => $this->participant_training,
            'update_training' => $this->update_training,
            'certificate_type' => $this->certificate_type,
        ]);

        $query->andFilterWhere(['like', 'name_training', $this->name_training])
            ->andFilterWhere(['like', 'location_training', $this->location_training])
            ->andFilterWhere(['like', 'note_training', $this->note_training])
            ->andFilterWhere(['like', 'main_user', $this->main_user])
            ->andFilterWhere(['like', 'status_training', $this->status_training]);

        return $dataProvider;
    }
}
