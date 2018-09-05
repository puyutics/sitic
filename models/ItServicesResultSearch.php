<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItServicesResult;

/**
 * ItServicesResultSearch represents the model behind the search form of `app\models\ItServicesResult`.
 */
class ItServicesResultSearch extends ItServicesResult
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'it_services_id', 'year', 'percent'], 'integer'],
            [['description', 'date', 'username'], 'safe'],
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
        $query = ItServicesResult::find();

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
            'year' => $this->year,
            'percent' => $this->percent,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
