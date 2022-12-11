<?php

namespace app\models\siad_pregrado;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\siad_pregrado\Matricula;

/**
 * MatriculaSearch represents the model behind the search form of `app\models\siad_pregrado\Matricula`.
 */
class MatriculaSearch extends Matricula
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idMatricula', 'idMatricula_anual', 'CIInfPer', 'idCarr', 'FechaMatricula', 'idParalelo', 'idMatricula_ant', 'tipoMatricula', 'statusMatricula', 'observMatricula', 'Usu_registra', 'Usu_legaliza', 'Fecha_crea', 'Usu_modifica', 'Fecha_ultima_modif', 'archivo_aprobado', 'archivo_retirado', 'archivo_anulado', 'leg_observacion'], 'safe'],
            [['idPer', 'idanio', 'idsemestre', 'anulada', 'promocion', 'num_asig_repite', 'aprobacion_automatica', 'mail_enviado'], 'integer'],
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
        $query = Matricula::find();

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
            'idPer' => $this->idPer,
            'idanio' => $this->idanio,
            'idsemestre' => $this->idsemestre,
            'FechaMatricula' => $this->FechaMatricula,
            'anulada' => $this->anulada,
            'promocion' => $this->promocion,
            'Fecha_crea' => $this->Fecha_crea,
            'Fecha_ultima_modif' => $this->Fecha_ultima_modif,
            'num_asig_repite' => $this->num_asig_repite,
            'aprobacion_automatica' => $this->aprobacion_automatica,
            'mail_enviado' => $this->mail_enviado,
        ]);

        $query->andFilterWhere(['like', 'idMatricula', $this->idMatricula])
            ->andFilterWhere(['like', 'idMatricula_anual', $this->idMatricula_anual])
            ->andFilterWhere(['like', 'CIInfPer', $this->CIInfPer])
            ->andFilterWhere(['like', 'idCarr', $this->idCarr])
            ->andFilterWhere(['like', 'idParalelo', $this->idParalelo])
            ->andFilterWhere(['like', 'idMatricula_ant', $this->idMatricula_ant])
            ->andFilterWhere(['like', 'tipoMatricula', $this->tipoMatricula])
            ->andFilterWhere(['like', 'statusMatricula', $this->statusMatricula])
            ->andFilterWhere(['like', 'observMatricula', $this->observMatricula])
            ->andFilterWhere(['like', 'Usu_registra', $this->Usu_registra])
            ->andFilterWhere(['like', 'Usu_legaliza', $this->Usu_legaliza])
            ->andFilterWhere(['like', 'Usu_modifica', $this->Usu_modifica])
            ->andFilterWhere(['like', 'archivo_aprobado', $this->archivo_aprobado])
            ->andFilterWhere(['like', 'archivo_retirado', $this->archivo_retirado])
            ->andFilterWhere(['like', 'archivo_anulado', $this->archivo_anulado])
            ->andFilterWhere(['like', 'leg_observacion', $this->leg_observacion]);

        return $dataProvider;
    }
}
