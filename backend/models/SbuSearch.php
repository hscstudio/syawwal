<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Sbu;

/**
 * SbuSearch represents the model behind the search form about `backend\models\Sbu`.
 */
class SbuSearch extends Sbu
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'value', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
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
        $query = Sbu::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'value' => $this->value,
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
