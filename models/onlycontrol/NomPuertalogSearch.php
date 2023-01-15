<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\NomPuertalog;

/**
 * NomPuertalogSearch represents the model behind the search form of `app\models\onlycontrol\NomPuertalog`.
 */
class NomPuertalogSearch extends NomPuertalog
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOM_ID', 'PUER_ID', 'TURN_FECI', 'TURN_FECF', 'TURN_NOW', 'TURN_DELNOW'], 'safe'],
            [['TURN_ID', 'TURN_TIPO', 'TURN_STA'], 'integer'],
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
        $query = NomPuertalog::find();

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
            'TURN_ID' => $this->TURN_ID,
            'TURN_FECI' => $this->TURN_FECI,
            'TURN_FECF' => $this->TURN_FECF,
            'TURN_TIPO' => $this->TURN_TIPO,
            'TURN_STA' => $this->TURN_STA,
            'TURN_NOW' => $this->TURN_NOW,
            'TURN_DELNOW' => $this->TURN_DELNOW,
        ]);

        $query->andFilterWhere(['like', 'NOM_ID', $this->NOM_ID])
            ->andFilterWhere(['like', 'PUER_ID', $this->PUER_ID]);

        return $dataProvider;
    }
}
