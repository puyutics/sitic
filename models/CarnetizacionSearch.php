<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Carnetizacion;

/**
 * CarnetizacionSearch represents the model behind the search form of `app\models\Carnetizacion`.
 */
class CarnetizacionSearch extends Carnetizacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idPer', 'status'], 'integer'],
            [['username', 'CIInfPer', 'cedula_pasaporte', 'TipoDocInfPer', 'ApellInfPer', 'ApellMatInfPer', 'NombInfPer', 'FechNacimPer', 'mailInst', 'fotografia', 'idMatricula', 'idCarr', 'fechfinalperlec', 'filefolder', 'filename', 'filetype', 'fec_registro'], 'safe'],
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
        $query = Carnetizacion::find();

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
            'FechNacimPer' => $this->FechNacimPer,
            'idPer' => $this->idPer,
            'fechfinalperlec' => $this->fechfinalperlec,
            'fec_registro' => $this->fec_registro,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'CIInfPer', $this->CIInfPer])
            ->andFilterWhere(['like', 'cedula_pasaporte', $this->cedula_pasaporte])
            ->andFilterWhere(['like', 'TipoDocInfPer', $this->TipoDocInfPer])
            ->andFilterWhere(['like', 'ApellInfPer', $this->ApellInfPer])
            ->andFilterWhere(['like', 'ApellMatInfPer', $this->ApellMatInfPer])
            ->andFilterWhere(['like', 'NombInfPer', $this->NombInfPer])
            ->andFilterWhere(['like', 'mailInst', $this->mailInst])
            ->andFilterWhere(['like', 'fotografia', $this->fotografia])
            ->andFilterWhere(['like', 'idMatricula', $this->idMatricula])
            ->andFilterWhere(['=', 'idCarr', $this->idCarr])
            ->andFilterWhere(['like', 'filefolder', $this->filefolder])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'filetype', $this->filetype]);

        return $dataProvider;
    }
}
