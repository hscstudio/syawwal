<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Training;

/**
 * TrainingSearch represents the model behind the search form about `backend\models\Training`.
 */
class TrainingSearch extends Training
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tb_program_id', 'ref_satker_id', 'hours', 'days', 'type', 'studentCount', 'classCount', 'costPlan', 'costRealisation', 'hostel', 'reguler', 'test', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['name', 'start', 'finish', 'note', 'executionSK', 'resultSK', 'sourceCost', 'stakeholder', 'location', 'created', 'modified', 'deleted'], 'safe'],
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
        $query = Training::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tb_program_id' => $this->tb_program_id,
            'ref_satker_id' => $this->ref_satker_id,
            'hours' => $this->hours,
            'days' => $this->days,
            'start' => $this->start,
            'finish' => $this->finish,
            'type' => $this->type,
            'studentCount' => $this->studentCount,
            'classCount' => $this->classCount,
            'costPlan' => $this->costPlan,
            'costRealisation' => $this->costRealisation,
            'hostel' => $this->hostel,
            'reguler' => $this->reguler,
            'test' => $this->test,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'executionSK', $this->executionSK])
            ->andFilterWhere(['like', 'resultSK', $this->resultSK])
            ->andFilterWhere(['like', 'sourceCost', $this->sourceCost])
            ->andFilterWhere(['like', 'stakeholder', $this->stakeholder])
            ->andFilterWhere(['like', 'location', $this->location]);

        return $dataProvider;
    }
}
