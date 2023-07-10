<?php

namespace app\models\eva_pregrado;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\eva_pregrado\MdlAttendance;

/**
 * MdlAttendanceSearch represents the model behind the search form of `app\models\eva_pregrado\MdlAttendance`.
 */
class MdlAttendanceSearch extends MdlAttendance
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'course', 'grade', 'timemodified', 'introformat', 'showsessiondetails', 'showextrauserdetails'], 'integer'],
            [['name', 'intro', 'subnet', 'sessiondetailspos'], 'safe'],
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
        $query = MdlAttendance::find();

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
            'course' => $this->course,
            'grade' => $this->grade,
            'timemodified' => $this->timemodified,
            'introformat' => $this->introformat,
            'showsessiondetails' => $this->showsessiondetails,
            'showextrauserdetails' => $this->showextrauserdetails,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'intro', $this->intro])
            ->andFilterWhere(['like', 'subnet', $this->subnet])
            ->andFilterWhere(['like', 'sessiondetailspos', $this->sessiondetailspos]);

        return $dataProvider;
    }
}
