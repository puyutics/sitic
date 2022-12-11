<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\NomPuerta;

/**
 * NomPuertaSearch represents the model behind the search form of `app\models\onlycontrol\NomPuerta`.
 */
class NomPuertaSearch extends NomPuerta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOM_ID', 'PUER_ID', 'TURN_FECI', 'TURN_FECF', 'TURN_NOW', 'TURN_TCOD', 'TURN_SEL', 'TURN_FECHA_UP'], 'safe'],
            [['TURN_ID', 'TURN_TIPO', 'TURN_STA', 'TURN_MARCA', 'ES_SINCRONIZADO', 'ES_UPDATE', 'TURN_CONFSIMILAR'], 'integer'],
            [['TURN_ESTADO_UP'], 'number'],
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
        $query = NomPuerta::find();

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
            'TURN_MARCA' => $this->TURN_MARCA,
            'TURN_ESTADO_UP' => $this->TURN_ESTADO_UP,
            'TURN_FECHA_UP' => $this->TURN_FECHA_UP,
            'ES_SINCRONIZADO' => $this->ES_SINCRONIZADO,
            'ES_UPDATE' => $this->ES_UPDATE,
            'TURN_CONFSIMILAR' => $this->TURN_CONFSIMILAR,
        ]);

        $query->andFilterWhere(['like', 'NOM_ID', $this->NOM_ID])
            ->andFilterWhere(['like', 'PUER_ID', $this->PUER_ID])
            ->andFilterWhere(['like', 'TURN_TCOD', $this->TURN_TCOD])
            ->andFilterWhere(['like', 'TURN_SEL', $this->TURN_SEL]);

        return $dataProvider;
    }
}
