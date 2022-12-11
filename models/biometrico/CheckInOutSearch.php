<?php

namespace app\models\biometrico;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\biometrico\CheckInOut;

/**
 * CheckInOutSearch represents the model behind the search form of `app\models\biometrico\CheckInOut`.
 */
class CheckInOutSearch extends CheckInOut
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['USERID', 'VERIFYCODE', 'WorkCode', 'UserExtFmt'], 'integer'],
            [['CHECKTIME', 'CHECKTYPE', 'SENSORID', 'Memoinfo', 'sn'], 'safe'],
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
        $query = CheckInOut::find();

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
            'USERID' => $this->USERID,
            'CHECKTIME' => $this->CHECKTIME,
            'VERIFYCODE' => $this->VERIFYCODE,
            'WorkCode' => $this->WorkCode,
            'UserExtFmt' => $this->UserExtFmt,
        ]);

        $query->andFilterWhere(['like', 'CHECKTYPE', $this->CHECKTYPE])
            ->andFilterWhere(['like', 'SENSORID', $this->SENSORID])
            ->andFilterWhere(['like', 'Memoinfo', $this->Memoinfo])
            ->andFilterWhere(['like', 'sn', $this->sn]);

        return $dataProvider;
    }
}
