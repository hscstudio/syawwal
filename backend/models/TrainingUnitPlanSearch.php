<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TrainingUnitPlan;

/**
 * TrainingUnitPlanSearch represents the model behind the search form about `backend\models\TrainingUnitPlan`.
 */
class TrainingUnitPlanSearch extends TrainingUnitPlan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tb_training_id', 'ref_unit_id', 'total', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['spread', 'created', 'modified', 'deleted'], 'safe'],
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
        $query = TrainingUnitPlan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tb_training_id' => $this->tb_training_id,
            'ref_unit_id' => $this->ref_unit_id,
            'total' => $this->total,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
        ]);

        $query->andFilterWhere(['like', 'spread', $this->spread]);

        return $dataProvider;
    }
}
