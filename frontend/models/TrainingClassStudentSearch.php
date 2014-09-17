<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\TrainingClassStudent;
use yii\web\Session;

/**
 * TrainingClassStudentSearch represents the model behind the search form about `frontend\models\TrainingClassStudent`.
 */
class TrainingClassStudentSearch extends TrainingClassStudent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tb_training_class_id', 'tb_student_id', 'headClass', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['number', 'created', 'modified', 'deleted'], 'safe'],
            [['activity', 'presence', 'pretest', 'posttest', 'test'], 'number'],
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
    public function search($params,$id)
    {
		$tb_training_id = $id;
		$query = TrainingClassStudent::find()
				->where(['tb_training_id'=>$tb_training_id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
			'tb_training_id' => $this->tb_training_id,
            'tb_training_class_id' => $this->tb_training_class_id,
            'tb_student_id' => $this->tb_student_id,
            'headClass' => $this->headClass,
            /*'activity' => $this->activity,
            'presence' => $this->presence,
            'pretest' => $this->pretest,
            'posttest' => $this->posttest,
            'test' => $this->test,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,*/
        ]);

        $query->andFilterWhere(['like', 'number', $this->number]);

        return $dataProvider;
    }
}
