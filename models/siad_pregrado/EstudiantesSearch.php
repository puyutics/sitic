<?php

namespace app\models\siad_pregrado;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\siad_pregrado\Estudiantes;

/**
 * EstudiantesSearch represents the model behind the search form about `app\models\siad_pregrado\Estudiantes`.
 */
class EstudiantesSearch extends Estudiantes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CIInfPer', 'num_expediente', 'cedula_pasaporte', 'TipoDocInfPer', 'ApellInfPer', 'ApellMatInfPer', 'NombInfPer', 'NacionalidadPer', 'FechNacimPer', 'LugarNacimientoPer', 'GeneroPer', 'EstadoCivilPer', 'paisCNE', 'provinciaCNE', 'habilitadoTPublicoCNE', 'domicilioRegCivil', 'CiudadPer', 'DirecDomicilioPer', 'Telf1InfPer', 'CelularInfPer', 'TipoInfPer', 'mailPer', 'mailInst', 'tipo_discapacidad', 'carnet_conadis', 'num_carnet_conadis', 'lateralidad', 'fotografia', 'fotografia_reg_civil', 'codigo_dactilar', 'huella_dactilar', 'usu_alta', 'ultima_actualizacion', 'codigo_verificacion', 'archivo', 'observacion', 'actualizado_x_api_usuario'], 'safe'],
            [['EtniaPer', 'statusper', 'GrupoSanguineo', 'porcentaje_discapacidad', 'hd_posicion', 'actualizado', 'deshabilita_edicion', 'cambia_nombres', 'residente_amazonico', 'actualizado_x_api'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Estudiantes::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'EtniaPer' => $this->EtniaPer,
            'FechNacimPer' => $this->FechNacimPer,
            'statusper' => $this->statusper,
            'GrupoSanguineo' => $this->GrupoSanguineo,
            'porcentaje_discapacidad' => $this->porcentaje_discapacidad,
            'hd_posicion' => $this->hd_posicion,
            'actualizado' => $this->actualizado,
            'ultima_actualizacion' => $this->ultima_actualizacion,
            'deshabilita_edicion' => $this->deshabilita_edicion,
            'cambia_nombres' => $this->cambia_nombres,
            'residente_amazonico' => $this->residente_amazonico,
            'actualizado_x_api' => $this->actualizado_x_api,
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
            ->andFilterWhere(['like', 'paisCNE', $this->paisCNE])
            ->andFilterWhere(['like', 'provinciaCNE', $this->provinciaCNE])
            ->andFilterWhere(['like', 'habilitadoTPublicoCNE', $this->habilitadoTPublicoCNE])
            ->andFilterWhere(['like', 'domicilioRegCivil', $this->domicilioRegCivil])
            ->andFilterWhere(['like', 'domicilioRegCivil', $this->domicilioRegCivil])
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
            ->andFilterWhere(['like', 'fotografia_reg_civil', $this->fotografia_reg_civil])
            ->andFilterWhere(['like', 'codigo_dactilar', $this->codigo_dactilar])
            ->andFilterWhere(['like', 'huella_dactilar', $this->huella_dactilar])
            ->andFilterWhere(['like', 'usu_alta', $this->usu_alta])
            ->andFilterWhere(['like', 'codigo_verificacion', $this->codigo_verificacion])
            ->andFilterWhere(['like', 'archivo', $this->archivo])
            ->andFilterWhere(['like', 'observacion', $this->observacion])
            ->andFilterWhere(['like', 'actualizado_x_api_usuario', $this->actualizado_x_api_usuario])
        ;

        return $dataProvider;
    }
}
