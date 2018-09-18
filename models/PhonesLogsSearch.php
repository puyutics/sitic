<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PhonesLogs;

/**
 * PhonesLogsSearch represents the model behind the search form of `app\models\PhonesLogs`.
 */
class PhonesLogsSearch extends PhonesLogs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'time'], 'integer'],
            [['date', 'source', 'destination', 'src_channel', 'dst_channel', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = PhonesLogs::find();

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
            //'date' => $this->date,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'source', $this->source])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'destination', $this->destination])
            ->andFilterWhere(['like', 'src_channel', $this->src_channel])
            ->andFilterWhere(['like', 'dst_channel', $this->dst_channel])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
