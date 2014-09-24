<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Student;

/**
 * StudentSearch represents the model behind the search form about `backend\models\Student`.
 */
class StudentSearch extends Student
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ref_religion_id', 'ref_graduate_id', 'ref_rank_class_id', 'ref_unit_id', 'gender', 'married', 'position', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['name', 'nickName', 'frontTitle', 'backTitle', 'nip', 'password_hash', 'auth_key', 'born', 'birthDay', 'phone', 'email', 'address', 'photo', 'blood', 'positionDesc', 'education', 'eselon2', 'eselon3', 'eselon4', 'satker', 'officePhone', 'officeFax', 'officeEmail', 'officeAddress', 'noSKPangkat', 'tmtSKPangkat', 'fileSKPangkat', 'created', 'modified', 'deleted'], 'safe'],
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
        $query = Student::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'ref_religion_id' => $this->ref_religion_id,
            'ref_graduate_id' => $this->ref_graduate_id,
            'ref_rank_class_id' => $this->ref_rank_class_id,
            'ref_unit_id' => $this->ref_unit_id,
            'birthDay' => $this->birthDay,
            'gender' => $this->gender,
            'married' => $this->married,
            'position' => $this->position,
            'tmtSKPangkat' => $this->tmtSKPangkat,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'nickName', $this->nickName])
            ->andFilterWhere(['like', 'frontTitle', $this->frontTitle])
            ->andFilterWhere(['like', 'backTitle', $this->backTitle])
            ->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'born', $this->born])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'blood', $this->blood])
            ->andFilterWhere(['like', 'positionDesc', $this->positionDesc])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'eselon2', $this->eselon2])
            ->andFilterWhere(['like', 'eselon3', $this->eselon3])
            ->andFilterWhere(['like', 'eselon4', $this->eselon4])
            ->andFilterWhere(['like', 'satker', $this->satker])
            ->andFilterWhere(['like', 'officePhone', $this->officePhone])
            ->andFilterWhere(['like', 'officeFax', $this->officeFax])
            ->andFilterWhere(['like', 'officeEmail', $this->officeEmail])
            ->andFilterWhere(['like', 'officeAddress', $this->officeAddress])
            ->andFilterWhere(['like', 'noSKPangkat', $this->noSKPangkat])
            ->andFilterWhere(['like', 'fileSKPangkat', $this->fileSKPangkat]);

        return $dataProvider;
    }
}
