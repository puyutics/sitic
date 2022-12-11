<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\NewCredencialMaestro;

/**
 * NewCredencialMaestroSearch represents the model behind the search form of `app\models\onlycontrol\NewCredencialMaestro`.
 */
class NewCredencialMaestroSearch extends NewCredencialMaestro
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CR_ID', 'CR_DES', 'CR_IMG', 'CR_UCREA', 'CR_FCREA', 'CR_UserRI', 'CR_ClaveRI', 'CR_IMGATRAS'], 'safe'],
            [['CR_FIRMA', 'CR_FOTO', 'CR_TIPO', 'CR_FOTOF', 'CR_CBARRA'], 'integer'],
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
        $query = NewCredencialMaestro::find();

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
            'CR_FIRMA' => $this->CR_FIRMA,
            'CR_FOTO' => $this->CR_FOTO,
            'CR_TIPO' => $this->CR_TIPO,
            'CR_FOTOF' => $this->CR_FOTOF,
            'CR_CBARRA' => $this->CR_CBARRA,
            'CR_FCREA' => $this->CR_FCREA,
        ]);

        $query->andFilterWhere(['like', 'CR_ID', $this->CR_ID])
            ->andFilterWhere(['like', 'CR_DES', $this->CR_DES])
            ->andFilterWhere(['like', 'CR_IMG', $this->CR_IMG])
            ->andFilterWhere(['like', 'CR_UCREA', $this->CR_UCREA])
            ->andFilterWhere(['like', 'CR_UserRI', $this->CR_UserRI])
            ->andFilterWhere(['like', 'CR_ClaveRI', $this->CR_ClaveRI])
            ->andFilterWhere(['like', 'CR_IMGATRAS', $this->CR_IMGATRAS]);

        return $dataProvider;
    }
}
