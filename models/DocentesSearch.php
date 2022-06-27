<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Docentes;

/**
 * DocentesSearch represents the model behind the search form of `app\models\Docentes`.
 */
class DocentesSearch extends Docentes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CIInfPer', 'cedula_pasaporte', 'TipoDocInfPer', 'ApellInfPer', 'ApellMatInfPer', 'NombInfPer', 'NacionalidadPer', 'FechNacimPer', 'LugarNacimientoPer', 'GeneroPer', 'EstadoCivilPer', 'CiudadPer', 'DirecDomicilioPer', 'Telf1InfPer', 'Telf2InfPer', 'CelularInfPer', 'TipoInfPer', 'StatusPer', 'mailPer', 'mailInst', 'tipo_discapacidad', 'carnet_conadis', 'num_carnet_conadis', 'fotografia', 'codigo_dactilar', 'huella_dactilar', 'ultima_actualizacion', 'LoginUsu', 'ClaveUsu', 'idcarr', 'firma_1', 'firma_2', 'fecha_reg', 'fecha_ultimo_acceso', 'usu_registra', 'usu_modifica', 'fecha_ultima_modif'], 'safe'],
            [['EtniaPer', 'GrupoSanguineo', 'porcentaje_discapacidad', 'hd_posicion', 'StatusUsu', 'usa_biometrico', 'invitado'], 'integer'],
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
        $query = Docentes::find();

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
            'GrupoSanguineo' => $this->GrupoSanguineo,
            'porcentaje_discapacidad' => $this->porcentaje_discapacidad,
            'hd_posicion' => $this->hd_posicion,
            'ultima_actualizacion' => $this->ultima_actualizacion,
            'StatusUsu' => $this->StatusUsu,
            'usa_biometrico' => $this->usa_biometrico,
            'fecha_reg' => $this->fecha_reg,
            'fecha_ultimo_acceso' => $this->fecha_ultimo_acceso,
            'fecha_ultima_modif' => $this->fecha_ultima_modif,
            'invitado' => $this->invitado,
        ]);

        $query->andFilterWhere(['like', 'CIInfPer', $this->CIInfPer])
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
            ->andFilterWhere(['like', 'Telf2InfPer', $this->Telf2InfPer])
            ->andFilterWhere(['like', 'CelularInfPer', $this->CelularInfPer])
            ->andFilterWhere(['like', 'TipoInfPer', $this->TipoInfPer])
            ->andFilterWhere(['like', 'StatusPer', $this->StatusPer])
            ->andFilterWhere(['like', 'mailPer', $this->mailPer])
            ->andFilterWhere(['like', 'mailInst', $this->mailInst])
            ->andFilterWhere(['like', 'tipo_discapacidad', $this->tipo_discapacidad])
            ->andFilterWhere(['like', 'carnet_conadis', $this->carnet_conadis])
            ->andFilterWhere(['like', 'num_carnet_conadis', $this->num_carnet_conadis])
            ->andFilterWhere(['like', 'fotografia', $this->fotografia])
            ->andFilterWhere(['like', 'codigo_dactilar', $this->codigo_dactilar])
            ->andFilterWhere(['like', 'huella_dactilar', $this->huella_dactilar])
            ->andFilterWhere(['like', 'LoginUsu', $this->LoginUsu])
            ->andFilterWhere(['like', 'ClaveUsu', $this->ClaveUsu])
            ->andFilterWhere(['like', 'idcarr', $this->idcarr])
            ->andFilterWhere(['like', 'firma_1', $this->firma_1])
            ->andFilterWhere(['like', 'firma_2', $this->firma_2])
            ->andFilterWhere(['like', 'usu_registra', $this->usu_registra])
            ->andFilterWhere(['like', 'usu_modifica', $this->usu_modifica]);

        return $dataProvider;
    }
}
