<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TthhServidor;

/**
 * TthhServidorSearch represents the model behind the search form of `app\models\TthhServidor`.
 */
class TthhServidorSearch extends TthhServidor
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_documento', 'id_documento', 'nombres', 'apellidos', 'fecha_nacimiento', 'servidorpasante', 'num_libretamilitar', 'nacionalidad', 'sexo', 'tipo_sangre', 'estado_civil', 'discapacidad', 'numero_conadis', 'tipo_discapacidad', 'servidor_carrera', 'numero_certificado', 'identificacion_etnica', 'nacionalidad_indigena', 'dir_calleprincipal', 'dir_numero', 'dir_callesecundaria', 'dir_referencia', 'tel_domicilio', 'tel_celular', 'tel_trabajo', 'tel_extension', 'email', 'email_temp', 'provincia', 'canton', 'parroquia', 'contacto_apellidos', 'contacto_nombres', 'contacto_telefono', 'contacto_celular', 'notaria_lugar', 'notaria_numero', 'notaria_fecha', 'institucion_bancaria', 'cuenta_tipo', 'cuenta_numero'], 'safe'],
            [['status'], 'integer'],
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
        $query = TthhServidor::find();

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
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'notaria_fecha' => $this->notaria_fecha,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'tipo_documento', $this->tipo_documento])
            ->andFilterWhere(['like', 'id_documento', $this->id_documento])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'servidorpasante', $this->servidorpasante])
            ->andFilterWhere(['like', 'num_libretamilitar', $this->num_libretamilitar])
            ->andFilterWhere(['like', 'nacionalidad', $this->nacionalidad])
            ->andFilterWhere(['like', 'sexo', $this->sexo])
            ->andFilterWhere(['like', 'tipo_sangre', $this->tipo_sangre])
            ->andFilterWhere(['like', 'estado_civil', $this->estado_civil])
            ->andFilterWhere(['like', 'discapacidad', $this->discapacidad])
            ->andFilterWhere(['like', 'numero_conadis', $this->numero_conadis])
            ->andFilterWhere(['like', 'tipo_discapacidad', $this->tipo_discapacidad])
            ->andFilterWhere(['like', 'servidor_carrera', $this->servidor_carrera])
            ->andFilterWhere(['like', 'numero_certificado', $this->numero_certificado])
            ->andFilterWhere(['like', 'identificacion_etnica', $this->identificacion_etnica])
            ->andFilterWhere(['like', 'nacionalidad_indigena', $this->nacionalidad_indigena])
            ->andFilterWhere(['like', 'dir_calleprincipal', $this->dir_calleprincipal])
            ->andFilterWhere(['like', 'dir_numero', $this->dir_numero])
            ->andFilterWhere(['like', 'dir_callesecundaria', $this->dir_callesecundaria])
            ->andFilterWhere(['like', 'dir_referencia', $this->dir_referencia])
            ->andFilterWhere(['like', 'tel_domicilio', $this->tel_domicilio])
            ->andFilterWhere(['like', 'tel_celular', $this->tel_celular])
            ->andFilterWhere(['like', 'tel_trabajo', $this->tel_trabajo])
            ->andFilterWhere(['like', 'tel_extension', $this->tel_extension])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'email_temp', $this->email_temp])
            ->andFilterWhere(['like', 'provincia', $this->provincia])
            ->andFilterWhere(['like', 'canton', $this->canton])
            ->andFilterWhere(['like', 'parroquia', $this->parroquia])
            ->andFilterWhere(['like', 'contacto_apellidos', $this->contacto_apellidos])
            ->andFilterWhere(['like', 'contacto_nombres', $this->contacto_nombres])
            ->andFilterWhere(['like', 'contacto_telefono', $this->contacto_telefono])
            ->andFilterWhere(['like', 'contacto_celular', $this->contacto_celular])
            ->andFilterWhere(['like', 'notaria_lugar', $this->notaria_lugar])
            ->andFilterWhere(['like', 'notaria_numero', $this->notaria_numero])
            ->andFilterWhere(['like', 'institucion_bancaria', $this->institucion_bancaria])
            ->andFilterWhere(['like', 'cuenta_tipo', $this->cuenta_tipo])
            ->andFilterWhere(['like', 'cuenta_numero', $this->cuenta_numero]);

        return $dataProvider;
    }
}
