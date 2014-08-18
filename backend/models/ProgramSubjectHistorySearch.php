<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProgramSubjectHistory;

/**
 * ProgramSubjectHistorySearch represents the model behind the search form about `backend\models\ProgramSubjectHistory`.
 */
class ProgramSubjectHistorySearch extends ProgramSubjectHistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tb_program_subject_id', 'tb_program_id', 'revision', 'type', 'hours', 'sort', 'test', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['name', 'created', 'modified', 'deleted'], 'safe'],
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
        $query = ProgramSubjectHistory::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'tb_program_subject_id' => $this->tb_program_subject_id,
            'tb_program_id' => $this->tb_program_id,
            'revision' => $this->revision,
            'type' => $this->type,
            'hours' => $this->hours,
            'sort' => $this->sort,
            'test' => $this->test,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
