<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TrainingClassSubject;

/**
 * TrainingClassSubjectSearch represents the model behind the search form about `frontend\models\TrainingClassSubject`.
 */
class TrainingClassSubjectSearch extends TrainingClassSubject
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tb_training_class_id', 'tb_program_subject_id', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['created', 'modified', 'deleted'], 'safe'],
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
	 
    public function search($params,$tb_training_id)
    {
        $query = TrainingClassSubject::find()
				->where(['tb_training_class_id'=>\frontend\models\TrainingClassStudent::find()
														->select('tb_training_class_id')
														->where(['tb_training_id'=>$tb_training_id,
																 'tb_student_id'=>Yii::$app->user->identity->id]),						 
						 'status'=>1])
				;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tb_training_class_id' => $this->tb_training_class_id,
            'tb_program_subject_id' => $this->tb_program_subject_id,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
        ]);

        return $dataProvider;
    }
}
