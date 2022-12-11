<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\NewCredencial;

/**
 * NewCredencialSearch represents the model behind the search form of `app\models\onlycontrol\NewCredencial`.
 */
class NewCredencialSearch extends NewCredencial
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CR_ID', 'CR_FIMPRESION', 'CR_RESULTADO', 'CR_CEDULA', 'CR_CIUDADANO', 'CR_FCADUDA', 'CR_UIMPRIME', 'CR_AAUTORIZA', 'CR_FAUTORIZA', 'CR_TARJETA'], 'safe'],
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
        $query = NewCredencial::find();

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
            'CR_FIMPRESION' => $this->CR_FIMPRESION,
            'CR_FCADUDA' => $this->CR_FCADUDA,
            'CR_FAUTORIZA' => $this->CR_FAUTORIZA,
        ]);

        $query->andFilterWhere(['like', 'CR_ID', $this->CR_ID])
            ->andFilterWhere(['like', 'CR_RESULTADO', $this->CR_RESULTADO])
            ->andFilterWhere(['like', 'CR_CEDULA', $this->CR_CEDULA])
            ->andFilterWhere(['like', 'CR_CIUDADANO', $this->CR_CIUDADANO])
            ->andFilterWhere(['like', 'CR_UIMPRIME', $this->CR_UIMPRIME])
            ->andFilterWhere(['like', 'CR_AAUTORIZA', $this->CR_AAUTORIZA])
            ->andFilterWhere(['like', 'CR_TARJETA', $this->CR_TARJETA]);

        return $dataProvider;
    }
}
