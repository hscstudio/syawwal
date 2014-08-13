<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Employee;

/**
 * EmployeeSearch represents the model behind the search form about `backend\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ref_satker_id', 'ref_unit_id', 'ref_religion_id', 'ref_rank_class_id', 'ref_graduate_id', 'ref_sta_unit_id', 'gender', 'married', 'status', 'createdBy', 'modifiedBy', 'deletedBy', 'user_id'], 'integer'],
            [['name', 'nickName', 'frontTitle', 'backTitle', 'nip', 'born', 'birthDay', 'phone', 'email', 'address', 'photo', 'blood', 'position', 'education', 'officePhone', 'officeFax', 'officeEmail', 'officeAddress', 'document1', 'document2', 'created', 'modified', 'deleted', 'public_email', 'gravatar_email', 'gravatar_id', 'location', 'bio', 'website'], 'safe'],
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
        $query = Employee::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'ref_satker_id' => $this->ref_satker_id,
            'ref_unit_id' => $this->ref_unit_id,
            'ref_religion_id' => $this->ref_religion_id,
            'ref_rank_class_id' => $this->ref_rank_class_id,
            'ref_graduate_id' => $this->ref_graduate_id,
            'ref_sta_unit_id' => $this->ref_sta_unit_id,
            'birthDay' => $this->birthDay,
            'gender' => $this->gender,
            'married' => $this->married,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'nickName', $this->nickName])
            ->andFilterWhere(['like', 'frontTitle', $this->frontTitle])
            ->andFilterWhere(['like', 'backTitle', $this->backTitle])
            ->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'born', $this->born])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'blood', $this->blood])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'officePhone', $this->officePhone])
            ->andFilterWhere(['like', 'officeFax', $this->officeFax])
            ->andFilterWhere(['like', 'officeEmail', $this->officeEmail])
            ->andFilterWhere(['like', 'officeAddress', $this->officeAddress])
            ->andFilterWhere(['like', 'document1', $this->document1])
            ->andFilterWhere(['like', 'document2', $this->document2])
            ->andFilterWhere(['like', 'public_email', $this->public_email])
            ->andFilterWhere(['like', 'gravatar_email', $this->gravatar_email])
            ->andFilterWhere(['like', 'gravatar_id', $this->gravatar_id])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'bio', $this->bio])
            ->andFilterWhere(['like', 'website', $this->website]);

        return $dataProvider;
    }
}
