<?php

namespace app\models\siad_posgrado;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\siad_posgrado\EstudiantesPosgrado;

/**
 * EstudiantesPosgradoSearch represents the model behind the search form of `app\models\siad_posgrado\EstudiantesPosgrado`.
 */
class EstudiantesPosgradoSearch extends EstudiantesPosgrado
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CIInfPer', 'num_expediente', 'cedula_pasaporte', 'TipoDocInfPer', 'ApellInfPer', 'ApellMatInfPer', 'NombInfPer', 'NacionalidadPer', 'FechNacimPer', 'LugarNacimientoPer', 'GeneroPer', 'EstadoCivilPer', 'CiudadPer', 'DirecDomicilioPer', 'Telf1InfPer', 'CelularInfPer', 'TipoInfPer', 'mailPer', 'mailInst', 'tipo_discapacidad', 'carnet_conadis', 'num_carnet_conadis', 'lateralidad', 'fotografia', 'codigo_dactilar', 'huella_dactilar', 'ultima_actualizacion', 'codigo_verificacion', 'archivo'], 'safe'],
            [['EtniaPer', 'statusper', 'GrupoSanguineo', 'porcentaje_discapacidad', 'hd_posicion', 'deshabilita_edicion'], 'integer'],
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
        $query = EstudiantesPosgrado::find();

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
            'EtniaPer' => $this->EtniaPer,
            'FechNacimPer' => $this->FechNacimPer,
            'statusper' => $this->statusper,
            'GrupoSanguineo' => $this->GrupoSanguineo,
            'porcentaje_discapacidad' => $this->porcentaje_discapacidad,
            'hd_posicion' => $this->hd_posicion,
            'ultima_actualizacion' => $this->ultima_actualizacion,
            'deshabilita_edicion' => $this->deshabilita_edicion,
        ]);

        $query->andFilterWhere(['like', 'CIInfPer', $this->CIInfPer])
            ->andFilterWhere(['like', 'num_expediente', $this->num_expediente])
            ->andFilterWhere(['like', 'cedula_pasaporte', $this->cedula_pasaporte])
            ->andFilterWhere(['like', 'TipoDocInfPer', $this->TipoDocInfPer])
            ->andFilterWhere(['like', 'ApellInfPer', $this->ApellInfPer])
            ->andFilterWhere(['like', 'ApellMatInfPer', $this->ApellMatInfPer])
            ->andFilterWhere(['like', 'NombInfPer', $this->NombInfPer])
            ->andFilterWhere(['like', 'NacionalidadPer', $this->NacionalidadPer])
            ->andFilterWhere(['like', 'LugarNacimientoPer', $this->LugarNacimientoPer])
            ->andFilterWhere(['like', 'GeneroPer', $this->GeneroPer])
            ->andFilterWhere(['like', 'EstadoCivilPer', $this->EstadoCivilPer])
            ->andFilterWhere(['like', 'CiudadPer', $this->CiudadPer])
            ->andFilterWhere(['like', 'DirecDomicilioPer', $this->DirecDomicilioPer])
            ->andFilterWhere(['like', 'Telf1InfPer', $this->Telf1InfPer])
            ->andFilterWhere(['like', 'CelularInfPer', $this->CelularInfPer])
            ->andFilterWhere(['like', 'TipoInfPer', $this->TipoInfPer])
            ->andFilterWhere(['like', 'mailPer', $this->mailPer])
            ->andFilterWhere(['like', 'mailInst', $this->mailInst])
            ->andFilterWhere(['like', 'tipo_discapacidad', $this->tipo_discapacidad])
            ->andFilterWhere(['like', 'carnet_conadis', $this->carnet_conadis])
            ->andFilterWhere(['like', 'num_carnet_conadis', $this->num_carnet_conadis])
            ->andFilterWhere(['like', 'lateralidad', $this->lateralidad])
            ->andFilterWhere(['like', 'fotografia', $this->fotografia])
            ->andFilterWhere(['like', 'codigo_dactilar', $this->codigo_dactilar])
            ->andFilterWhere(['like', 'huella_dactilar', $this->huella_dactilar])
            ->andFilterWhere(['like', 'codigo_verificacion', $this->codigo_verificacion])
            ->andFilterWhere(['like', 'archivo', $this->archivo]);

        return $dataProvider;
    }
}
