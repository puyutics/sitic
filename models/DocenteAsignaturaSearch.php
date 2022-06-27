<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\DocenteAsignatura;

/**
 * DocenteAsignaturaSearch represents the model behind the search form of `app\models\DocenteAsignatura`.
 */
class DocenteAsignaturaSearch extends DocenteAsignatura
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dpa_id', 'idPer', 'idAnio', 'idSemestre', 'bloque', 'status', 'id_actdist', 'transf_asistencia', 'transf_frecuente', 'transf_parcial', 'transf_final', 'transf_supletorio', 'transf_cursointensivo', 'transf_recuperacion', 'arrastre', 'extra', 'compensar_horas', 'tutor', 'cupo'], 'integer'],
            [['CIInfPer', 'idAsig', 'idCarr', 'idParalelo', 'tipo_orgmalla', 'compensar_tipo', 'regimen_academico'], 'safe'],
            [['idMc', 'id_contdoc'], 'number'],
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
        $query = DocenteAsignatura::find();

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
            'dpa_id' => $this->dpa_id,
            'idPer' => $this->idPer,
            'idAnio' => $this->idAnio,
            'idSemestre' => $this->idSemestre,
            'bloque' => $this->bloque,
            'status' => $this->status,
            'idMc' => $this->idMc,
            'id_actdist' => $this->id_actdist,
            'id_contdoc' => $this->id_contdoc,
            'transf_asistencia' => $this->transf_asistencia,
            'transf_frecuente' => $this->transf_frecuente,
            'transf_parcial' => $this->transf_parcial,
            'transf_final' => $this->transf_final,
            'transf_supletorio' => $this->transf_supletorio,
            'transf_cursointensivo' => $this->transf_cursointensivo,
            'transf_recuperacion' => $this->transf_recuperacion,
            'arrastre' => $this->arrastre,
            'extra' => $this->extra,
            'compensar_horas' => $this->compensar_horas,
            'tutor' => $this->tutor,
            'cupo' => $this->cupo,
        ]);

        $query->andFilterWhere(['like', 'CIInfPer', $this->CIInfPer])
            ->andFilterWhere(['like', 'idAsig', $this->idAsig])
            ->andFilterWhere(['like', 'idCarr', $this->idCarr])
            ->andFilterWhere(['like', 'idParalelo', $this->idParalelo])
            ->andFilterWhere(['like', 'tipo_orgmalla', $this->tipo_orgmalla])
            ->andFilterWhere(['like', 'compensar_tipo', $this->compensar_tipo])
            ->andFilterWhere(['like', 'regimen_academico', $this->regimen_academico]);

        return $dataProvider;
    }
}
