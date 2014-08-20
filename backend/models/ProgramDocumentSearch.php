<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ProgramDocument;

/**
 * ProgramDocumentSearch represents the model behind the search form about `backend\models\ProgramDocument`.
 */
class ProgramDocumentSearch extends ProgramDocument
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tb_program_id', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['name', 'type', 'filename', 'description', 'created', 'modified', 'deleted'], 'safe'],
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
        $query = ProgramDocument::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tb_program_id' => $this->tb_program_id,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
