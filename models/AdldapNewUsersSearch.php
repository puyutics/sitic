<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AdldapNewUsers;

/**
 * AdldapNewUsersSearch represents the model behind the search form of `app\models\AdldapNewUsers`.
 */
class AdldapNewUsersSearch extends AdldapNewUsers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status'], 'integer'],
            [['dni', 'nombres', 'apellidos', 'fec_nacimiento', 'campus', 'carrera', 'email_personal', 'celular'], 'safe'],
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
        $query = AdldapNewUsers::find();

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
            'fec_nacimiento' => $this->fec_nacimiento,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'campus', $this->campus])
            ->andFilterWhere(['like', 'carrera', $this->carrera])
            ->andFilterWhere(['like', 'email_personal', $this->email_personal])
            ->andFilterWhere(['like', 'celular', $this->celular]);

        return $dataProvider;
    }
}
