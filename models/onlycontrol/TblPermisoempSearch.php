<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\TblPermisoemp;

/**
 * TblPermisoempSearch represents the model behind the search form of `app\models\onlycontrol\TblPermisoemp`.
 */
class TblPermisoempSearch extends TblPermisoemp
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOMINA_ID'], 'safe'],
            [['P_CAPTURAH', 'P_CAPTURAF', 'P_PERMISOS', 'P_NOTIFICACION', 'P_DOCUMENTOS', 'P_CREDENCIAL', 'P_MUEVEUSER', 'P_EXPORTA', 'P_CAMBIOMASIVO', 'P_LISTOCONTROL', 'P_IMPORTAVIRDI', 'P_RESTRICCION', 'P_REPORTE', 'P_CAPTURAR'], 'integer'],
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
        $query = TblPermisoemp::find();

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
            'P_CAPTURAH' => $this->P_CAPTURAH,
            'P_CAPTURAF' => $this->P_CAPTURAF,
            'P_PERMISOS' => $this->P_PERMISOS,
            'P_NOTIFICACION' => $this->P_NOTIFICACION,
            'P_DOCUMENTOS' => $this->P_DOCUMENTOS,
            'P_CREDENCIAL' => $this->P_CREDENCIAL,
            'P_MUEVEUSER' => $this->P_MUEVEUSER,
            'P_EXPORTA' => $this->P_EXPORTA,
            'P_CAMBIOMASIVO' => $this->P_CAMBIOMASIVO,
            'P_LISTOCONTROL' => $this->P_LISTOCONTROL,
            'P_IMPORTAVIRDI' => $this->P_IMPORTAVIRDI,
            'P_RESTRICCION' => $this->P_RESTRICCION,
            'P_REPORTE' => $this->P_REPORTE,
            'P_CAPTURAR' => $this->P_CAPTURAR,
        ]);

        $query->andFilterWhere(['like', 'NOMINA_ID', $this->NOMINA_ID]);

        return $dataProvider;
    }
}
