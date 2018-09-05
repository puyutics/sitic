<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItIncidentsReportsUser;

/**
 * ItIncidentsReportsUserSearch represents the model behind the search form of `app\models\ItIncidentsReportsUser`.
 */
class ItIncidentsReportsUserSearch extends ItIncidentsReportsUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'it_incidents_reports_id', 'status'], 'integer'],
            [['username', 'description', 'date_assigned', 'date_released'], 'safe'],
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
        $query = ItIncidentsReportsUser::find();

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
            'it_incidents_reports_id' => $this->it_incidents_reports_id,
            'date_assigned' => $this->date_assigned,
            'date_released' => $this->date_released,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
