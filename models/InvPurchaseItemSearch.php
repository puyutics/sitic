<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InvPurchaseItem;

/**
 * InvPurchaseItemSearch represents the model behind the search form of `app\models\InvPurchaseItem`.
 */
class InvPurchaseItemSearch extends InvPurchaseItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'inv_models_id', 'inv_purchase_id'], 'integer'],
            [['description', 'control_code', 'serial_number'], 'safe'],
            [['amount'], 'number'],
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
        $query = InvPurchaseItem::find();

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
            'amount' => $this->amount,
            'inv_models_id' => $this->inv_models_id,
            'inv_purchase_id' => $this->inv_purchase_id,
        ]);

        $query->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'control_code', $this->control_code])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number]);

        return $dataProvider;
    }
}
