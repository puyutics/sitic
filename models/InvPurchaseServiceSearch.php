<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InvPurchaseService;

/**
 * InvPurchaseServiceSearch represents the model behind the search form of `app\models\InvPurchaseService`.
 */
class InvPurchaseServiceSearch extends InvPurchaseService
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'inv_purchase_id'], 'integer'],
            [['description', 'control_code'], 'safe'],
            [['amount'], 'number'],
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
        $query = InvPurchaseService::find();

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
            'inv_purchase_id' => $this->inv_purchase_id,
            'amount' => $this->amount,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'control_code', $this->control_code]);

        return $dataProvider;
    }
}
