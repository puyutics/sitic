<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\Califica;

/**
 * CalificaSearch represents the model behind the search form of `app\models\onlycontrol\Califica`.
 */
class CalificaSearch extends Califica
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CALI_ID'], 'number'],
            [['CALI_NOM', 'CALI_DES'], 'safe'],
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
        $query = Califica::find();

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
            'CALI_ID' => $this->CALI_ID,
        ]);

        $query->andFilterWhere(['like', 'CALI_NOM', $this->CALI_NOM])
            ->andFilterWhere(['like', 'CALI_DES', $this->CALI_DES]);

        return $dataProvider;
    }
}
