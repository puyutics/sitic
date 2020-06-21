<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TabIntEncuestas;

/**
 * TabIntEncuestasSearch represents the model behind the search form of `app\models\TabIntEncuestas`.
 */
class TabIntEncuestasSearch extends TabIntEncuestas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'ObjectID'], 'integer'],
            [['GlobalID', 'CreationDate', 'Creator', 'EditDate', 'Editor', 'CedulaPasaporte', 'Nombres', 'Apellidos', 'Email', 'Campus', 'Carrera', 'Telefono', 'Operadora', 'Internet', 'TipoInternet', 'Computador', 'TipoComputador', 'PropiedadComputador', 'x', 'y', 'Beneficio'], 'safe'],
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
        $query = TabIntEncuestas::find();

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
            'ID' => $this->ID,
            'ObjectID' => $this->ObjectID,
            'CreationDate' => $this->CreationDate,
            'EditDate' => $this->EditDate,
        ]);

        $query->andFilterWhere(['like', 'GlobalID', $this->GlobalID])
            ->andFilterWhere(['like', 'Creator', $this->Creator])
            ->andFilterWhere(['like', 'Editor', $this->Editor])
            ->andFilterWhere(['like', 'CedulaPasaporte', $this->CedulaPasaporte])
            ->andFilterWhere(['like', 'Nombres', $this->Nombres])
            ->andFilterWhere(['like', 'Apellidos', $this->Apellidos])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'Campus', $this->Campus])
            ->andFilterWhere(['like', 'Carrera', $this->Carrera])
            ->andFilterWhere(['like', 'Telefono', $this->Telefono])
            ->andFilterWhere(['like', 'Operadora', $this->Operadora])
            ->andFilterWhere(['like', 'Internet', $this->Internet])
            ->andFilterWhere(['like', 'TipoInternet', $this->TipoInternet])
            ->andFilterWhere(['like', 'Computador', $this->Computador])
            ->andFilterWhere(['like', 'TipoComputador', $this->TipoComputador])
            ->andFilterWhere(['like', 'PropiedadComputador', $this->PropiedadComputador])
            ->andFilterWhere(['like', 'x', $this->x])
            ->andFilterWhere(['like', 'y', $this->y])
            ->andFilterWhere(['like', 'Beneficio', $this->Beneficio]);

        return $dataProvider;
    }
}
