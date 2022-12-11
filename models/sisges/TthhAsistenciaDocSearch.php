<?php

namespace app\models\sisges;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\sisges\TthhAsistenciaDoc;

/**
 * TthhAsistenciaDocSearch represents the model behind the search form of `app\models\sisges\TthhAsistenciaDoc`.
 */
class TthhAsistenciaDocSearch extends TthhAsistenciaDoc
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_asistencia', 'dias', 'horas', 'minutos', 'status_envio', 'status_revision', 'status_aprobacion', 'vacaciones_st'], 'integer'],
            [['idx_servidor', 'idx_tipoasistencia', 'idx_motivo', 'idx_tipodocumento', 'numero_documento', 'fecha_inicio', 'fecha_fin', 'descripcion', 'fecha_envio', 'fecha_revision', 'fecha_aprobacion', 'ip_registrado', 'idx_usuario', 'hora_inicial', 'hora_final'], 'safe'],
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
        $query = TthhAsistenciaDoc::find();

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
            'id_asistencia' => $this->id_asistencia,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'dias' => $this->dias,
            'horas' => $this->horas,
            'minutos' => $this->minutos,
            'status_envio' => $this->status_envio,
            'fecha_envio' => $this->fecha_envio,
            'status_revision' => $this->status_revision,
            'fecha_revision' => $this->fecha_revision,
            'status_aprobacion' => $this->status_aprobacion,
            'fecha_aprobacion' => $this->fecha_aprobacion,
            'hora_inicial' => $this->hora_inicial,
            'hora_final' => $this->hora_final,
            'vacaciones_st' => $this->vacaciones_st,
        ]);

        $query->andFilterWhere(['like', 'idx_servidor', $this->idx_servidor])
            ->andFilterWhere(['like', 'idx_tipoasistencia', $this->idx_tipoasistencia])
            ->andFilterWhere(['like', 'idx_motivo', $this->idx_motivo])
            ->andFilterWhere(['like', 'idx_tipodocumento', $this->idx_tipodocumento])
            ->andFilterWhere(['like', 'numero_documento', $this->numero_documento])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'ip_registrado', $this->ip_registrado])
            ->andFilterWhere(['like', 'idx_usuario', $this->idx_usuario]);

        return $dataProvider;
    }
}
