<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Meeting;

/**
 * MeetingSearch represents the model behind the search form about `backend\models\Meeting`.
 */
class MeetingSearch extends Meeting
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ref_satker_id', 'attendanceCount', 'classCount', 'hostel', 'status', 'createdBy', 'modifiedBy', 'deletedBy'], 'integer'],
            [['executor', 'name', 'startTime', 'finishTime', 'note', 'location', 'created', 'modified', 'deleted'], 'safe'],
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
        $query = Meeting::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'ref_satker_id' => $this->ref_satker_id,
            'executor' => $this->executor,
			'startTime' => $this->startTime,
            'finishTime' => $this->finishTime,
            'attendanceCount' => $this->attendanceCount,
            'classCount' => $this->classCount,
            'hostel' => $this->hostel,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
            'deleted' => $this->deleted,
            'deletedBy' => $this->deletedBy,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'location', $this->location]);

        return $dataProvider;
    }
}
