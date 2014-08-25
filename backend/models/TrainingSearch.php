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
	public $year;
	
    public function rules()
    {
        return [
            [['id', 'tb_program_id', 'tb_program_revision', 'ref_satker_id', 'studentCount', 'classCount', 'costPlan', 'costRealisation', 'hostel', 'reguler', 'status', 'createdBy', 'modifiedBy', 'deletedBy', 'approvedStatus', 'approvedStatusBy'], 'integer'],
            [['name', 'start', 'finish', 'note', 'executionSK', 'resultSK', 'sourceCost', 'stakeholder', 'location', 'created', 'modified', 'deleted', 'approvedStatusNote', 'approvedStatusDate', 'year'], 'safe'],
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
		
		if(empty($this->year)) $this->year=date('Y');
		
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tb_program_id' => $this->tb_program_id,
            'tb_program_revision' => $this->tb_program_revision,
            'ref_satker_id' => $this->ref_satker_id,
            'start' => $this->start,
            'finish' => $this->finish,
            'studentCount' => $this->studentCount,
            'classCount' => $this->classCount,
            'costPlan' => $this->costPlan,
            'costRealisation' => $this->costRealisation,
            'hostel' => $this->hostel,
            'reguler' => $this->reguler,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
            'approvedStatus' => $this->approvedStatus,
            'approvedStatusDate' => $this->approvedStatusDate,
            'approvedStatusBy' => $this->approvedStatusBy,
			'YEAR(start)' => $this->year,
        ]);
		
        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'executionSK', $this->executionSK])
            ->andFilterWhere(['like', 'resultSK', $this->resultSK])
            ->andFilterWhere(['like', 'sourceCost', $this->sourceCost])
            ->andFilterWhere(['like', 'stakeholder', $this->stakeholder])
            ->andFilterWhere(['like', 'location', $this->location])
			->andFilterWhere(['like', 'approvedStatusNote', $this->approvedStatusNote]);
            //->andFilterWhere(['like', 'YEAR(start)', $this->year]);

        return $dataProvider;
    }
}
