<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TrainingSchedule;

/**
 * TrainingScheduleSearch represents the model behind the search form about `backend\models\TrainingSchedule`.
 */
class TrainingScheduleSearch extends TrainingSchedule
{
    public $startDate, $finishDate;
	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tb_training_class_id', 'tb_training_class_subject_id', 'tb_activity_room_id', 'session', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['activity', 'pic', 'startTime', 'finishTime', 'created', 'modified', 'deleted', 'startDate', 'finishDate'], 'safe'],
            [['hours'], 'number'],
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
        $query = TrainingSchedule::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tb_training_class_id' => $this->tb_training_class_id,
            'tb_training_class_subject_id' => $this->tb_training_class_subject_id,
            'tb_activity_room_id' => $this->tb_activity_room_id,
            'hours' => $this->hours,
            'startTime' => $this->startTime,
            'finishTime' => $this->finishTime,
            'session' => $this->session,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
        ]);
		
        $query->andFilterWhere(['like', 'activity', $this->activity])
              ->andFilterWhere(['like', 'pic', $this->pic]);
		
		if($this->startDate==$this->finishDate) {
			$query->andFilterWhere(['=', 'date(startTime)', $this->startDate]);
		}
		else{
			$query->andFilterWhere(['>=', 'date(startTime)', $this->startDate]);
			$query->andFilterWhere(['<=', 'date(finishTime)', $this->finishDate]);
		}
	
        return $dataProvider;
    }
}
