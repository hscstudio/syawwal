<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Trainer;

/**
 * TrainerSearch represents the model behind the search form about `backend\models\Trainer`.
 */
class TrainerSearch extends Trainer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ref_graduate_id', 'ref_rank_class_id', 'ref_religion_id', 'gender', 'married', 'widyaiswara', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['name', 'nickName', 'frontTitle', 'backTitle', 'nip', 'born', 'birthDay', 'phone', 'email', 'address', 'photo', 'blood', 'position', 'organization', 'education', 'educationHistory', 'trainingHistory', 'experience', 'competency', 'npwp', 'bankAccount', 'officePhone', 'officeFax', 'officeEmail', 'officeAddress', 'document1', 'document2', 'created', 'modified', 'deleted'], 'safe'],
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
        $query = Trainer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'ref_graduate_id' => $this->ref_graduate_id,
            'ref_rank_class_id' => $this->ref_rank_class_id,
            'ref_religion_id' => $this->ref_religion_id,
            'birthDay' => $this->birthDay,
            'gender' => $this->gender,
            'married' => $this->married,
            'widyaiswara' => $this->widyaiswara,
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
            ->andFilterWhere(['like', 'born', $this->born])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'blood', $this->blood])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'organization', $this->organization])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'educationHistory', $this->educationHistory])
            ->andFilterWhere(['like', 'trainingHistory', $this->trainingHistory])
            ->andFilterWhere(['like', 'experience', $this->experience])
            ->andFilterWhere(['like', 'competency', $this->competency])
            ->andFilterWhere(['like', 'npwp', $this->npwp])
            ->andFilterWhere(['like', 'bankAccount', $this->bankAccount])
            ->andFilterWhere(['like', 'officePhone', $this->officePhone])
            ->andFilterWhere(['like', 'officeFax', $this->officeFax])
            ->andFilterWhere(['like', 'officeEmail', $this->officeEmail])
            ->andFilterWhere(['like', 'officeAddress', $this->officeAddress])
            ->andFilterWhere(['like', 'document1', $this->document1])
            ->andFilterWhere(['like', 'document2', $this->document2]);

        return $dataProvider;
    }
}
