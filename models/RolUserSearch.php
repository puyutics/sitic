<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RolUser;

/**
 * RolUserSearch represents the model behind the search form of `app\models\RolUser`.
 */
class RolUserSearch extends RolUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'rol_tipo_id', 'anio', 'mes', 'status'], 'integer'],
            [['username', 'filefolder', 'filename', 'filetype'], 'safe'],
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
        $query = RolUser::find();

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
            'rol_tipo_id' => $this->rol_tipo_id,
            'anio' => $this->anio,
            'mes' => $this->mes,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'filefolder', $this->filefolder])
            ->andFilterWhere(['like', 'filename', $this->filename])
            ->andFilterWhere(['like', 'filetype', $this->filetype]);

        return $dataProvider;
    }
}
