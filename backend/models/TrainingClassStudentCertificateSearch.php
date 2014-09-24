<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TrainingClassStudentCertificate;

/**
 * TrainingClassStudentCertificateSearch represents the model behind the search form about `backend\models\TrainingClassStudentCertificate`.
 */
class TrainingClassStudentCertificateSearch extends TrainingClassStudentCertificate
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tb_training_class_student_id', 'ref_unit_id', 'ref_graduate_id', 'ref_rank_class_id', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['number', 'seri', 'date', 'position', 'education', 'eselon2', 'eselon3', 'eselon4', 'satker', 'created', 'modified', 'deleted'], 'safe'],
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
        $query = TrainingClassStudentCertificate::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'tb_training_class_student_id' => $this->tb_training_class_student_id,
            'ref_unit_id' => $this->ref_unit_id,
            'ref_graduate_id' => $this->ref_graduate_id,
            'ref_rank_class_id' => $this->ref_rank_class_id,
            'date' => $this->date,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'seri', $this->seri])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'education', $this->education])
            ->andFilterWhere(['like', 'eselon2', $this->eselon2])
            ->andFilterWhere(['like', 'eselon3', $this->eselon3])
            ->andFilterWhere(['like', 'eselon4', $this->eselon4])
            ->andFilterWhere(['like', 'satker', $this->satker]);

        return $dataProvider;
    }
}
