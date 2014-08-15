<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProgramHistory;

/**
 * ProgramHistorySearch represents the model behind the search form about `backend\models\ProgramHistory`.
 */
class ProgramHistorySearch extends ProgramHistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tb_program_id', 'revision', 'ref_satker_id', 'hours', 'days', 'test', 'type', 'validationStatus', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['number', 'name', 'note', 'validationNote', 'created', 'modified', 'deleted'], 'safe'],
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
        $query = ProgramHistory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'tb_program_id' => $this->tb_program_id,
            'revision' => $this->revision,
            'ref_satker_id' => $this->ref_satker_id,
            'hours' => $this->hours,
            'days' => $this->days,
            'test' => $this->test,
            'type' => $this->type,
            'validationStatus' => $this->validationStatus,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'validationNote', $this->validationNote]);

				
        return $dataProvider;
    }
}
