<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CheckExact;

/**
 * CheckExactSearch represents the model behind the search form of `app\models\CheckExact`.
 */
class CheckExactSearch extends CheckExact
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['EXACTID', 'USERID', 'ISADD', 'ISMODIFY', 'ISDELETE', 'INCOUNT', 'ISCOUNT'], 'integer'],
            [['CHECKTIME', 'CHECKTYPE', 'YUYIN', 'MODIFYBY', 'DATE'], 'safe'],
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
        $query = CheckExact::find();

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
            'EXACTID' => $this->EXACTID,
            'USERID' => $this->USERID,
            'CHECKTIME' => $this->CHECKTIME,
            'ISADD' => $this->ISADD,
            'ISMODIFY' => $this->ISMODIFY,
            'ISDELETE' => $this->ISDELETE,
            'INCOUNT' => $this->INCOUNT,
            'ISCOUNT' => $this->ISCOUNT,
            'DATE' => $this->DATE,
        ]);

        $query->andFilterWhere(['like', 'CHECKTYPE', $this->CHECKTYPE])
            ->andFilterWhere(['like', 'YUYIN', $this->YUYIN])
            ->andFilterWhere(['like', 'MODIFYBY', $this->MODIFYBY]);

        return $dataProvider;
    }
}
