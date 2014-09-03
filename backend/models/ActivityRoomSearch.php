<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ActivityRoom;

/**
 * ActivityRoomSearch represents the model behind the search form about `backend\models\ActivityRoom`.
 */
class ActivityRoomSearch extends ActivityRoom
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type', 'activity_id', 'tb_room_id', 'status', 'createdBy', 'modifiedBy'], 'integer'],
            [['startTime', 'finishTime', 'note', 'created', 'modified'], 'safe'],
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
        $query = ActivityRoom::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'activity_id' => $this->activity_id,
            'tb_room_id' => $this->tb_room_id,
            'startTime' => $this->startTime,
            'finishTime' => $this->finishTime,
            'status' => $this->status,
            'created' => $this->created,
            'createdBy' => $this->createdBy,
            'modified' => $this->modified,
            'modifiedBy' => $this->modifiedBy,
        ]);

        $query->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
