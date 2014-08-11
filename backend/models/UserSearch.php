<?php

namespace backend\models;

use Yii;
use dektrium\user\models\UserSearch as BaseUserSearch;
use yii\data\ActiveDataProvider;

class UserSearch extends BaseUserSearch
{
	/**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $this->addCondition($query, 'username', true);
        $this->addCondition($query, 'email', true);
        $this->addCondition($query, 'created_at');
        $this->addCondition($query, 'registered_from');

        return $dataProvider;
    }
}
