<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TrainingSubjectTrainerRecommendation;

/**
 * TrainingSubjectTrainerRecommendationSearch represents the model behind the search form about `backend\models\TrainingSubjectTrainerRecommendation`.
 */
class TrainingSubjectTrainerRecommendationSearch extends TrainingSubjectTrainerRecommendation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tb_training_id', 'tb_program_subject_id', 'tb_trainer_id', 'ref_trainer_type_id', 'sort', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['note', 'created', 'modified', 'deleted'], 'safe'],
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
        $query = TrainingSubjectTrainerRecommendation::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tb_training_id' => $this->tb_training_id,
            'tb_program_subject_id' => $this->tb_program_subject_id,
            'tb_trainer_id' => $this->tb_trainer_id,
            'ref_trainer_type_id' => $this->ref_trainer_type_id,
            'sort' => $this->sort,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
