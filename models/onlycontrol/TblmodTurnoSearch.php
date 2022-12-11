<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\TblmodTurno;

/**
 * TblmodTurnoSearch represents the model behind the search form of `app\models\onlycontrol\TblmodTurno`.
 */
class TblmodTurnoSearch extends TblmodTurno
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MOD_ID', 'MOD_LUNES', 'MOD_MARTES', 'MOD_MIERCOLES', 'MOD_JUEVES', 'MOD_VIERNES', 'MOD_SABADO', 'MOD_DOMINGO'], 'integer'],
            [['MOD_DES'], 'safe'],
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
        $query = TblmodTurno::find();

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
            'MOD_ID' => $this->MOD_ID,
            'MOD_LUNES' => $this->MOD_LUNES,
            'MOD_MARTES' => $this->MOD_MARTES,
            'MOD_MIERCOLES' => $this->MOD_MIERCOLES,
            'MOD_JUEVES' => $this->MOD_JUEVES,
            'MOD_VIERNES' => $this->MOD_VIERNES,
            'MOD_SABADO' => $this->MOD_SABADO,
            'MOD_DOMINGO' => $this->MOD_DOMINGO,
        ]);

        $query->andFilterWhere(['like', 'MOD_DES', $this->MOD_DES]);

        return $dataProvider;
    }
}
