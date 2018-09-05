<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItServicesAvailability;

/**
 * ItServicesAvailabilitySearch represents the model behind the search form of `app\models\ItServicesAvailability`.
 */
class ItServicesAvailabilitySearch extends ItServicesAvailability
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'it_services_id', 'availability_time', 'status'], 'integer'],
            [['description', 'date_start', 'date_end'], 'safe'],
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
        $query = ItServicesAvailability::find();

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
            'it_services_id' => $this->it_services_id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'availability_time' => $this->availability_time,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
