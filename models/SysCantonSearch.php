<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SysCanton;

/**
 * SysCantonSearch represents the model behind the search form of `app\models\SysCanton`.
 */
class SysCantonSearch extends SysCanton
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sys_provincia_id', 'status'], 'integer'],
            [['canton'], 'safe'],
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
        $query = SysCanton::find();

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
            'sys_provincia_id' => $this->sys_provincia_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'canton', $this->canton]);

        return $dataProvider;
    }
}
