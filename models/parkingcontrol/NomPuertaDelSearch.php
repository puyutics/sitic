<?php

namespace app\models\parkingcontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\parkingcontrol\NomPuertaDel;

/**
 * NomPuertaDelSearch represents the model behind the search form of `app\models\parkingcontrol\NomPuertaDel`.
 */
class NomPuertaDelSearch extends NomPuertaDel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOM_ID', 'PUER_ID', 'TURN_FECHA_DEL'], 'safe'],
            [['FLAG_T', 'TURN_ESTADO_DEL'], 'number'],
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
        $query = NomPuertaDel::find();

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
            'FLAG_T' => $this->FLAG_T,
            'TURN_ESTADO_DEL' => $this->TURN_ESTADO_DEL,
            'TURN_FECHA_DEL' => $this->TURN_FECHA_DEL,
        ]);

        $query->andFilterWhere(['like', 'NOM_ID', $this->NOM_ID])
            ->andFilterWhere(['like', 'PUER_ID', $this->PUER_ID]);

        return $dataProvider;
    }
}
