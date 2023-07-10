<?php

namespace app\models\siad_pregrado;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\siad_pregrado\PlanificacionAsignatura;

/**
 * PlanificacionAsignaturaSearch represents the model behind the search form of `app\models\siad_pregrado\PlanificacionAsignatura`.
 */
class PlanificacionAsignaturaSearch extends PlanificacionAsignatura
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_plasig', 'dpa_id', 'num_unidad', 'num_encuentro', 'num_periodos', 'atraso', 'status', 'ps_id', 'estado_asist', 'id_amb', 'habilita_asist', 'id_actdist', 'habilita_frec', 'ce_id', 'bloqueado_x_parcial', 'extra', 'excluida_x_disposicion'], 'integer'],
            [['desc_unidad', 'tema_clase', 'contenido', 'metodologia', 'fecha', 'hora_ini_planif', 'hora_fin_planif', 'fecha_reg', 'objetivo_plasig', 'fecha_rcd', 'hora_inicio', 'hora_fin', 'fecha_cierre', 'hora_cierre', 'hc_periodo', 'ip_pcacceso', 'nomb_pcacceso', 'observacion', 'fecha_recp', 'hora_ini_recp', 'hora_fin_recp', 'autorizacion_recp', 'acceso', 'usu_habilita_asist', 'usu_habilita_pldoc', 'usu_habilita_frec', 'usu_dicta', 'archivo_justificativo'], 'safe'],
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
        $query = PlanificacionAsignatura::find();

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
            'id_plasig' => $this->id_plasig,
            'dpa_id' => $this->dpa_id,
            'num_unidad' => $this->num_unidad,
            'num_encuentro' => $this->num_encuentro,
            'fecha' => $this->fecha,
            'hora_ini_planif' => $this->hora_ini_planif,
            'hora_fin_planif' => $this->hora_fin_planif,
            'fecha_reg' => $this->fecha_reg,
            'fecha_rcd' => $this->fecha_rcd,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'fecha_cierre' => $this->fecha_cierre,
            'hora_cierre' => $this->hora_cierre,
            'num_periodos' => $this->num_periodos,
            'atraso' => $this->atraso,
            'status' => $this->status,
            'ps_id' => $this->ps_id,
            'fecha_recp' => $this->fecha_recp,
            'hora_ini_recp' => $this->hora_ini_recp,
            'hora_fin_recp' => $this->hora_fin_recp,
            'estado_asist' => $this->estado_asist,
            'id_amb' => $this->id_amb,
            'habilita_asist' => $this->habilita_asist,
            'id_actdist' => $this->id_actdist,
            'habilita_frec' => $this->habilita_frec,
            'ce_id' => $this->ce_id,
            'bloqueado_x_parcial' => $this->bloqueado_x_parcial,
            'extra' => $this->extra,
            'excluida_x_disposicion' => $this->excluida_x_disposicion,
        ]);

        $query->andFilterWhere(['like', 'desc_unidad', $this->desc_unidad])
            ->andFilterWhere(['like', 'tema_clase', $this->tema_clase])
            ->andFilterWhere(['like', 'contenido', $this->contenido])
            ->andFilterWhere(['like', 'metodologia', $this->metodologia])
            ->andFilterWhere(['like', 'objetivo_plasig', $this->objetivo_plasig])
            ->andFilterWhere(['like', 'hc_periodo', $this->hc_periodo])
            ->andFilterWhere(['like', 'ip_pcacceso', $this->ip_pcacceso])
            ->andFilterWhere(['like', 'nomb_pcacceso', $this->nomb_pcacceso])
            ->andFilterWhere(['like', 'observacion', $this->observacion])
            ->andFilterWhere(['like', 'autorizacion_recp', $this->autorizacion_recp])
            ->andFilterWhere(['like', 'acceso', $this->acceso])
            ->andFilterWhere(['like', 'usu_habilita_asist', $this->usu_habilita_asist])
            ->andFilterWhere(['like', 'usu_habilita_pldoc', $this->usu_habilita_pldoc])
            ->andFilterWhere(['like', 'usu_habilita_frec', $this->usu_habilita_frec])
            ->andFilterWhere(['like', 'usu_dicta', $this->usu_dicta])
            ->andFilterWhere(['like', 'archivo_justificativo', $this->archivo_justificativo]);

        return $dataProvider;
    }
}
