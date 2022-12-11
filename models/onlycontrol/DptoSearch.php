<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\Dpto;

/**
 * DptoSearch represents the model behind the search form of `app\models\onlycontrol\Dpto`.
 */
class DptoSearch extends Dpto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DEP_ID', 'DEP_ARE'], 'number'],
            [['DEP_NOM', 'DEP_DESC', 'DEP_OBS', 'DEP_EM'], 'safe'],
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
        $query = Dpto::find();

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
            'DEP_ID' => $this->DEP_ID,
            'DEP_ARE' => $this->DEP_ARE,
        ]);

        $query->andFilterWhere(['like', 'DEP_NOM', $this->DEP_NOM])
            ->andFilterWhere(['like', 'DEP_DESC', $this->DEP_DESC])
            ->andFilterWhere(['like', 'DEP_OBS', $this->DEP_OBS])
            ->andFilterWhere(['like', 'DEP_EM', $this->DEP_EM]);

        return $dataProvider;
    }
}
