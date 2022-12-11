<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\TipoPermiso;

/**
 * TipoPermisoSearch represents the model behind the search form of `app\models\onlycontrol\TipoPermiso`.
 */
class TipoPermisoSearch extends TipoPermiso
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TIPO_ID', 'TIPO_NOM'], 'safe'],
            [['TIPO_COD_N', 'TIPO_COD_A', 'TIPO_FACE', 'TIPO_IRIS'], 'integer'],
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
        $query = TipoPermiso::find();

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
            'TIPO_COD_N' => $this->TIPO_COD_N,
            'TIPO_COD_A' => $this->TIPO_COD_A,
            'TIPO_FACE' => $this->TIPO_FACE,
            'TIPO_IRIS' => $this->TIPO_IRIS,
        ]);

        $query->andFilterWhere(['like', 'TIPO_ID', $this->TIPO_ID])
            ->andFilterWhere(['like', 'TIPO_NOM', $this->TIPO_NOM]);

        return $dataProvider;
    }
}
