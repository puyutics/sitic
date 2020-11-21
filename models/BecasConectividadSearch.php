<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BecasConectividad;

/**
 * BecasConectividadSearch represents the model behind the search form of `app\models\BecasConectividad`.
 */
class BecasConectividadSearch extends BecasConectividad
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['dni', 'username', 'email', 'nombres', 'apellidos', 'provincia', 'cel_contacto', 'tel_contacto', 'cuenta_dni', 'cuenta_numero', 'cuenta_titular', 'cuenta_tipo', 'cuenta_institucion', 'siad_matriculado', 'siad_semestre', 'siad_carrera', 'ficha_escasos_recursos', 'doc_libreta', 'fec_registro'], 'safe'],
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
        $query = BecasConectividad::find();

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
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'provincia', $this->provincia])
            ->andFilterWhere(['like', 'cel_contacto', $this->cel_contacto])
            ->andFilterWhere(['like', 'tel_contacto', $this->tel_contacto])
            ->andFilterWhere(['like', 'cuenta_dni', $this->cuenta_dni])
            ->andFilterWhere(['like', 'cuenta_numero', $this->cuenta_numero])
            ->andFilterWhere(['like', 'cuenta_titular', $this->cuenta_titular])
            ->andFilterWhere(['like', 'cuenta_tipo', $this->cuenta_tipo])
            ->andFilterWhere(['like', 'cuenta_institucion', $this->cuenta_institucion])
            ->andFilterWhere(['like', 'siad_matriculado', $this->siad_matriculado])
            ->andFilterWhere(['like', 'siad_semestre', $this->siad_semestre])
            ->andFilterWhere(['like', 'siad_carrera', $this->siad_carrera])
            ->andFilterWhere(['like', 'ficha_escasos_recursos', $this->ficha_escasos_recursos])
            ->andFilterWhere(['like', 'doc_libreta', $this->doc_libreta])
            ->andFilterWhere(['like', 'fec_registro', $this->fec_registro]);

        return $dataProvider;
    }
}
