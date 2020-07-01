<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CcppProveedorContacto;

/**
 * CcppProveedorContactoSearch represents the model behind the search form of `app\models\CcppProveedorContacto`.
 */
class CcppProveedorContactoSearch extends CcppProveedorContacto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ccpp_proveedor_id', 'status'], 'integer'],
            [['nombre', 'cargo', 'celular', 'telefono', 'extension', 'email'], 'safe'],
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
        $query = CcppProveedorContacto::find();

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
            'ccpp_proveedor_id' => $this->ccpp_proveedor_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'cargo', $this->cargo])
            ->andFilterWhere(['like', 'celular', $this->celular])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'extension', $this->extension])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
