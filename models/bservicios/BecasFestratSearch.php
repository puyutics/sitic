<?php

namespace app\models\bservicios;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\bservicios\BecasFestrat;

/**
 * BecasFestratSearch represents the model behind the search form of `app\models\BecasFestrat`.
 */
class BecasFestratSearch extends BecasFestrat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idficha_sa', 'periodo', 'p12', 'p13', 'p14', 'p21', 'p22', 'p23', 'p24', 'p31', 'p32', 'p33', 'p34', 'p35', 'p36', 'p37', 'p41', 'p42', 'p43', 'p44', 'p45', 'p51', 'p61', 'p62', 'total', 'valoracion', 'status'], 'integer'],
            [['cedula', 'nombres_comp', 'p11', 'p15', 'p63', 'Grupo', 'fecha_reg'], 'safe'],
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
        $query = BecasFestrat::find();

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
            'idficha_sa' => $this->idficha_sa,
            'periodo' => $this->periodo,
            'p12' => $this->p12,
            'p13' => $this->p13,
            'p14' => $this->p14,
            'p21' => $this->p21,
            'p22' => $this->p22,
            'p23' => $this->p23,
            'p24' => $this->p24,
            'p31' => $this->p31,
            'p32' => $this->p32,
            'p33' => $this->p33,
            'p34' => $this->p34,
            'p35' => $this->p35,
            'p36' => $this->p36,
            'p37' => $this->p37,
            'p41' => $this->p41,
            'p42' => $this->p42,
            'p43' => $this->p43,
            'p44' => $this->p44,
            'p45' => $this->p45,
            'p51' => $this->p51,
            'p61' => $this->p61,
            'p62' => $this->p62,
            'total' => $this->total,
            'valoracion' => $this->valoracion,
            'fecha_reg' => $this->fecha_reg,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'cedula', $this->cedula])
            ->andFilterWhere(['like', 'nombres_comp', $this->nombres_comp])
            ->andFilterWhere(['like', 'p11', $this->p11])
            ->andFilterWhere(['like', 'p15', $this->p15])
            ->andFilterWhere(['like', 'p63', $this->p63])
            ->andFilterWhere(['like', 'Grupo', $this->Grupo]);

        return $dataProvider;
    }
}
