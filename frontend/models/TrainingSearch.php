<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Training;

/**
 * TrainingSearch represents the model behind the search form about `frontend\models\Training`.
 */
class TrainingSearch extends Training
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tb_program_id', 'tb_program_revision', 'ref_satker_id', 'studentCount', 'classCount', 'costPlan', 'costRealisation', 'hostel', 'reguler', 'status', 'createdBy', 'modifiedBy', 'deletedBy', 'approvedStatus', 'approvedStatusBy'], 'integer'],
            [['number', 'name', 'start', 'finish', 'note', 'executionSK', 'resultSK', 'sourceCost', 'stakeholder', 'location', 'created', 'modified', 'deleted', 'approvedStatusNote', 'approvedStatusDate'], 'safe'],
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
        $query = Training::find()
				->leftjoin('tb_training_class_student','tb_training_class_student.tb_training_id=tb_training.id')
				->where(['tb_student_id'=>Yii::$app->user->identity->id]);

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
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'executionSK', $this->executionSK])
            ->andFilterWhere(['like', 'resultSK', $this->resultSK])
            ->andFilterWhere(['like', 'sourceCost', $this->sourceCost])
            ->andFilterWhere(['like', 'stakeholder', $this->stakeholder])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'approvedStatusNote', $this->approvedStatusNote]);

        return $dataProvider;
    }
}
