<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\PuertaSta;

/**
 * PuertaStaSearch represents the model behind the search form of `app\models\onlycontrol\PuertaSta`.
 */
class PuertaStaSearch extends PuertaSta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['P_ID', 'P_Fecha', 'P_Status', 'P_User', 'P_Maq'], 'safe'],
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
        $query = PuertaSta::find();

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
            'P_Fecha' => $this->P_Fecha,
        ]);

        $query->andFilterWhere(['like', 'P_ID', $this->P_ID])
            ->andFilterWhere(['like', 'P_Status', $this->P_Status])
            ->andFilterWhere(['like', 'P_User', $this->P_User])
            ->andFilterWhere(['like', 'P_Maq', $this->P_Maq]);

        return $dataProvider;
    }
}
