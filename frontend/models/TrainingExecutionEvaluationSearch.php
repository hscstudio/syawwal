<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TrainingExecutionEvaluation;

/**
 * TrainingExecutionEvaluationSearch represents the model behind the search form about `frontend\models\TrainingExecutionEvaluation`.
 */
class TrainingExecutionEvaluationSearch extends TrainingExecutionEvaluation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tb_training_class_student_id', 'overall', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['value', 'text1', 'text2', 'text3', 'text4', 'text5', 'comment', 'created', 'modified', 'deleted'], 'safe'],
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
        $query = TrainingExecutionEvaluation::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tb_training_class_student_id' => $this->tb_training_class_student_id,
            'overall' => $this->overall,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value])
            ->andFilterWhere(['like', 'text1', $this->text1])
            ->andFilterWhere(['like', 'text2', $this->text2])
            ->andFilterWhere(['like', 'text3', $this->text3])
            ->andFilterWhere(['like', 'text4', $this->text4])
            ->andFilterWhere(['like', 'text5', $this->text5])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
