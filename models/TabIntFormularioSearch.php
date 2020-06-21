<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TabIntFormulario;

/**
 * TabIntFormularioSearch represents the model behind the search form of `app\models\TabIntFormulario`.
 */
class TabIntFormularioSearch extends TabIntFormulario
{
    public $fecha_inicio;
    public $fecha_fin;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['fecha_inicio','fecha_fin'], 'safe'],
            [['cedula', 'username', 'email', 'nombres', 'apellidos', 'codigo_postal', 'provincia', 'canton', 'parroquia', 'calle_principal', 'calle_secundaria', 'referencia_texto', 'referencia_foto', 'cel_contacto', 'tel_contacto', 'siad_matriculado', 'siad_semestre', 'siad_carrera', 'ficha_escasos_recursos', 'encuesta_beneficiario', 'cobertura', 'smartphone', 'responsabilidad_uso', 'condiciones', 'doc_cedula_pasaporte', 'doc_servicio_basico', 'doc_responsabilidad_uso', 'doc_contrato', 'qrcode', 'fec_registro'], 'safe'],
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
        $query = TabIntFormulario::find();

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
            'fec_registro' => $this->fec_registro,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'cedula', $this->cedula])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'codigo_postal', $this->codigo_postal])
            ->andFilterWhere(['like', 'provincia', $this->provincia])
            ->andFilterWhere(['like', 'canton', $this->canton])
            ->andFilterWhere(['like', 'parroquia', $this->parroquia])
            ->andFilterWhere(['like', 'calle_principal', $this->calle_principal])
            ->andFilterWhere(['like', 'calle_secundaria', $this->calle_secundaria])
            ->andFilterWhere(['like', 'referencia_texto', $this->referencia_texto])
            ->andFilterWhere(['like', 'referencia_foto', $this->referencia_foto])
            ->andFilterWhere(['like', 'cel_contacto', $this->cel_contacto])
            ->andFilterWhere(['like', 'tel_contacto', $this->tel_contacto])
            ->andFilterWhere(['like', 'siad_matriculado', $this->siad_matriculado])
            ->andFilterWhere(['like', 'siad_semestre', $this->siad_semestre])
            ->andFilterWhere(['like', 'siad_carrera', $this->siad_carrera])
            ->andFilterWhere(['like', 'ficha_escasos_recursos', $this->ficha_escasos_recursos])
            ->andFilterWhere(['=', 'encuesta_beneficiario', $this->encuesta_beneficiario])
            ->andFilterWhere(['like', 'cobertura', $this->cobertura])
            ->andFilterWhere(['like', 'smartphone', $this->smartphone])
            ->andFilterWhere(['like', 'responsabilidad_uso', $this->responsabilidad_uso])
            ->andFilterWhere(['like', 'condiciones', $this->condiciones])
            ->andFilterWhere(['like', 'doc_cedula_pasaporte', $this->doc_cedula_pasaporte])
            ->andFilterWhere(['like', 'doc_servicio_basico', $this->doc_servicio_basico])
            ->andFilterWhere(['like', 'doc_responsabilidad_uso', $this->doc_responsabilidad_uso])
            ->andFilterWhere(['like', 'doc_contrato', $this->doc_contrato])
            ->andFilterWhere(['like', 'qrcode', $this->qrcode])
            ->andFilterWhere(['>=', 'fec_registro', $this->fecha_inicio])
            ->andFilterWhere(['<=', 'fec_registro', $this->fecha_fin]);

        return $dataProvider;
    }
}
