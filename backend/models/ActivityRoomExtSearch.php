<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ActivityRoom;

/**
 * ActivityRoomSearch represents the model behind the search form about `backend\models\ActivityRoom`.
 */
class ActivityRoomExtSearch extends ActivityRoom
{
    public  $startDateX, $finishDateX,
			$startTimeX, $finishTimeX,
			$location, $computer, $hostel, $capacity;
	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['computer', 'hostel','capacity'], 'integer'],
            [['location','startTimeX', 'finishTimeX', 'startDateX', 'finishDateX'], 'safe'],
			['finishDateX',\hscstudio\heart\helpers\DateTimeCompareValidator::className(),'compareAttribute'=>'startDateX','operator'=>'>','message'=>'{attribute} must be greater than {compareValue}.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }
}
