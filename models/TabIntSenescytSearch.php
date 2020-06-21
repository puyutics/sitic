<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TabIntSenescyt;

/**
 * TabIntSenescytSearch represents the model behind the search form of `app\models\TabIntSenescyt`.
 */
class TabIntSenescytSearch extends TabIntSenescyt
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['fec_inicio', 'fec_fin', 'email', 'nombres', 'cedula_pasaporte', 'provincia', 'canton', 'parroquia', 'direccion', 'nivel', 'carrera', 'semestre', 'equipos', 'computador', 'portatil', 'tablet', 'radio', 'television', 'smartphone', 'mic_computador', 'cam_computador', 'par_computador', 'mic_portatil', 'cam_portatil', 'par_portatil', 'internet', 'tipo', 'proveedor', 'velocidad', 'teletrabajo', 'estudios', 'cant_usuarios', 'horas', 'accion'], 'safe'],
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
        $query = TabIntSenescyt::find();

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
            'fec_inicio' => $this->fec_inicio,
            'fec_fin' => $this->fec_fin,
        ]);

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'cedula_pasaporte', $this->cedula_pasaporte])
            ->andFilterWhere(['like', 'provincia', $this->provincia])
            ->andFilterWhere(['like', 'canton', $this->canton])
            ->andFilterWhere(['like', 'parroquia', $this->parroquia])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'nivel', $this->nivel])
            ->andFilterWhere(['like', 'carrera', $this->carrera])
            ->andFilterWhere(['like', 'semestre', $this->semestre])
            ->andFilterWhere(['like', 'equipos', $this->equipos])
            ->andFilterWhere(['like', 'computador', $this->computador])
            ->andFilterWhere(['like', 'portatil', $this->portatil])
            ->andFilterWhere(['like', 'tablet', $this->tablet])
            ->andFilterWhere(['like', 'radio', $this->radio])
            ->andFilterWhere(['like', 'television', $this->television])
            ->andFilterWhere(['like', 'smartphone', $this->smartphone])
            ->andFilterWhere(['like', 'mic_computador', $this->mic_computador])
            ->andFilterWhere(['like', 'cam_computador', $this->cam_computador])
            ->andFilterWhere(['like', 'par_computador', $this->par_computador])
            ->andFilterWhere(['like', 'mic_portatil', $this->mic_portatil])
            ->andFilterWhere(['like', 'cam_portatil', $this->cam_portatil])
            ->andFilterWhere(['like', 'par_portatil', $this->par_portatil])
            ->andFilterWhere(['like', 'internet', $this->internet])
            ->andFilterWhere(['like', 'tipo', $this->tipo])
            ->andFilterWhere(['like', 'proveedor', $this->proveedor])
            ->andFilterWhere(['like', 'velocidad', $this->velocidad])
            ->andFilterWhere(['like', 'teletrabajo', $this->teletrabajo])
            ->andFilterWhere(['like', 'estudios', $this->estudios])
            ->andFilterWhere(['like', 'cant_usuarios', $this->cant_usuarios])
            ->andFilterWhere(['like', 'horas', $this->horas])
            ->andFilterWhere(['like', 'accion', $this->accion]);

        return $dataProvider;
    }
}
