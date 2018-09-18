<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PhonesExtensions;

/**
 * PhonesExtensionsSearch represents the model behind the search form of `app\models\PhonesExtensions`.
 */
class PhonesExtensionsSearch extends PhonesExtensions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'department_id', 'inv_purchase_item_id'], 'integer'],
            [['extension', 'description', 'ipv4_address', 'username'], 'safe'],
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
        $query = PhonesExtensions::find();

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
            'department_id' => $this->department_id,
            'inv_purchase_item_id' => $this->inv_purchase_item_id,
        ]);

        $query->andFilterWhere(['like', 'extension', $this->extension])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'ipv4_address', $this->ipv4_address])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
