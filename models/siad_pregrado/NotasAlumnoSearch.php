<?php

namespace app\models\siad_pregrado;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\siad_pregrado\NotasAlumno;

/**
 * NotasAlumnoSearch represents the model behind the search form of `app\models\siad_pregrado\NotasAlumno`.
 */
class NotasAlumnoSearch extends NotasAlumno
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idnaa', 'idPer', 'asistencia', 'StatusCalif', 'VRepite', 'op1', 'op2', 'op3', 'pierde_x_asistencia', 'pierde_x_ppf', 'repite', 'retirado', 'excluidaxrepitencia', 'excluidaxreingreso', 'excluidaxresolucion', 'excluidaxcambiomalla', 'convalidacion', 'convalida_ppf', 'aprobada', 'anulada', 'arrastre', 'exam_final_atrasado', 'exam_supl_atrasado', 'exam_supl_sancion', 'dpa_id'], 'integer'],
            [['CIInfPer', 'idAsig', 'idMatricula', 'observacion', 'registro_asistencia', 'usu_registro_asistencia', 'registro', 'ultima_modificacion', 'usu_pregistro', 'usu_umodif_registro', 'archivo', 'archivo_conv_ppf', 'institucion_proviene', 'observacion_conv', 'porcentaje_convalidacion', 'usuario_conv', 'observacion_conv_ppf', 'usuario_conv_ppf', 'observacion_efa', 'observacion_espa', 'observacion_sps', 'observacion_op3', 'usu_habilita_efa', 'usu_habilita_espa', 'usu_habilita_sps', 'usu_habilita_op3'], 'safe'],
            [['CAC1', 'CAC2', 'CAC3', 'TCAC', 'CEF', 'CSP', 'CCR', 'CSP2', 'CalifFinal', 'idMc'], 'number'],
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
        $query = NotasAlumno::find();

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
            'idnaa' => $this->idnaa,
            'idPer' => $this->idPer,
            'CAC1' => $this->CAC1,
            'CAC2' => $this->CAC2,
            'CAC3' => $this->CAC3,
            'TCAC' => $this->TCAC,
            'CEF' => $this->CEF,
            'CSP' => $this->CSP,
            'CCR' => $this->CCR,
            'CSP2' => $this->CSP2,
            'CalifFinal' => $this->CalifFinal,
            'asistencia' => $this->asistencia,
            'StatusCalif' => $this->StatusCalif,
            'VRepite' => $this->VRepite,
            'op1' => $this->op1,
            'op2' => $this->op2,
            'op3' => $this->op3,
            'pierde_x_asistencia' => $this->pierde_x_asistencia,
            'pierde_x_ppf' => $this->pierde_x_ppf,
            'repite' => $this->repite,
            'retirado' => $this->retirado,
            'excluidaxrepitencia' => $this->excluidaxrepitencia,
            'excluidaxreingreso' => $this->excluidaxreingreso,
            'excluidaxresolucion' => $this->excluidaxresolucion,
            'excluidaxcambiomalla' => $this->excluidaxcambiomalla,
            'convalidacion' => $this->convalidacion,
            'convalida_ppf' => $this->convalida_ppf,
            'aprobada' => $this->aprobada,
            'anulada' => $this->anulada,
            'arrastre' => $this->arrastre,
            'registro_asistencia' => $this->registro_asistencia,
            'registro' => $this->registro,
            'ultima_modificacion' => $this->ultima_modificacion,
            'idMc' => $this->idMc,
            'exam_final_atrasado' => $this->exam_final_atrasado,
            'exam_supl_atrasado' => $this->exam_supl_atrasado,
            'exam_supl_sancion' => $this->exam_supl_sancion,
            'dpa_id' => $this->dpa_id,
        ]);

        $query->andFilterWhere(['like', 'CIInfPer', $this->CIInfPer])
            ->andFilterWhere(['like', 'idAsig', $this->idAsig])
            ->andFilterWhere(['like', 'idMatricula', $this->idMatricula])
            ->andFilterWhere(['like', 'observacion', $this->observacion])
            ->andFilterWhere(['like', 'usu_registro_asistencia', $this->usu_registro_asistencia])
            ->andFilterWhere(['like', 'usu_pregistro', $this->usu_pregistro])
            ->andFilterWhere(['like', 'usu_umodif_registro', $this->usu_umodif_registro])
            ->andFilterWhere(['like', 'archivo', $this->archivo])
            ->andFilterWhere(['like', 'archivo_conv_ppf', $this->archivo_conv_ppf])
            ->andFilterWhere(['like', 'institucion_proviene', $this->institucion_proviene])
            ->andFilterWhere(['like', 'observacion_conv', $this->observacion_conv])
            ->andFilterWhere(['like', 'porcentaje_convalidacion', $this->porcentaje_convalidacion])
            ->andFilterWhere(['like', 'usuario_conv', $this->usuario_conv])
            ->andFilterWhere(['like', 'observacion_conv_ppf', $this->observacion_conv_ppf])
            ->andFilterWhere(['like', 'usuario_conv_ppf', $this->usuario_conv_ppf])
            ->andFilterWhere(['like', 'observacion_efa', $this->observacion_efa])
            ->andFilterWhere(['like', 'observacion_espa', $this->observacion_espa])
            ->andFilterWhere(['like', 'observacion_sps', $this->observacion_sps])
            ->andFilterWhere(['like', 'observacion_op3', $this->observacion_op3])
            ->andFilterWhere(['like', 'usu_habilita_efa', $this->usu_habilita_efa])
            ->andFilterWhere(['like', 'usu_habilita_espa', $this->usu_habilita_espa])
            ->andFilterWhere(['like', 'usu_habilita_sps', $this->usu_habilita_sps])
            ->andFilterWhere(['like', 'usu_habilita_op3', $this->usu_habilita_op3]);

        return $dataProvider;
    }
}
