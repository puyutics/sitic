<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItServices;

/**
 * ItServicesSearch represents the model behind the search form of `app\models\ItServices`.
 */
class ItServicesSearch extends ItServices
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'magnitude', 'status'], 'integer'],
            [['service', 'description', 'type', 'date_renovation', 'date_creation', 'date_closed', 'stakeholders'], 'safe'],
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
        $query = ItServices::find();

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
            'date_renovation' => $this->date_renovation,
            'date_creation' => $this->date_creation,
            'date_closed' => $this->date_closed,
            'magnitude' => $this->magnitude,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'service', $this->service])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'stakeholders', $this->stakeholders]);

        return $dataProvider;
    }
}
