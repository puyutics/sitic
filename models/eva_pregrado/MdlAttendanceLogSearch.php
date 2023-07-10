<?php

namespace app\models\eva_pregrado;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\eva_pregrado\MdlAttendanceLog;

/**
 * MdlAttendanceLogSearch represents the model behind the search form of `app\models\eva_pregrado\MdlAttendanceLog`.
 */
class MdlAttendanceLogSearch extends MdlAttendanceLog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sessionid', 'studentid', 'statusid', 'timetaken', 'takenby'], 'integer'],
            [['statusset', 'remarks', 'ipaddress'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = MdlAttendanceLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'sessionid' => $this->sessionid,
            'studentid' => $this->studentid,
            'statusid' => $this->statusid,
            'timetaken' => $this->timetaken,
            'takenby' => $this->takenby,
        ]);

        $query->andFilterWhere(['like', 'statusset', $this->statusset])
            ->andFilterWhere(['like', 'remarks', $this->remarks])
            ->andFilterWhere(['like', 'ipaddress', $this->ipaddress]);

        return $dataProvider;
    }
}
