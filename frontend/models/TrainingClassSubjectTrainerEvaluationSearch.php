<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TrainingClassSubjectTrainerEvaluation;

/**
 * TrainingClassSubjectTrainerEvaluationSearch represents the model behind the search form about `frontend\models\TrainingClassSubjectTrainerEvaluation`.
 */
class TrainingClassSubjectTrainerEvaluationSearch extends TrainingClassSubjectTrainerEvaluation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tb_training_class_subject_id', 'tb_trainer_id', 'tb_student_id', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['value', 'comment', 'created', 'modified', 'deleted'], 'safe'],
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
        $query = TrainingClassSubjectTrainerEvaluation::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tb_training_class_subject_id' => $this->tb_training_class_subject_id,
            'tb_trainer_id' => $this->tb_trainer_id,
            'tb_student_id' => $this->tb_student_id,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
