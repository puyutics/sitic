<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PrintersLogs;

/**
 * PrintersLogsSearch represents the model behind the search form of `app\models\PrintersLogs`.
 */
class PrintersLogsSearch extends PrintersLogs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pages', 'copies'], 'integer'],
            [['date', 'username', 'printer', 'document', 'client', 'paper', 'protocol', 'high', 'width', 'duplex', 'grayscale', 'size'], 'safe'],
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
        $query = PrintersLogs::find();

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
            'pages' => $this->pages,
            'copies' => $this->copies,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'date', $this->date])
            ->andFilterWhere(['like', 'printer', $this->printer])
            ->andFilterWhere(['like', 'document', $this->document])
            ->andFilterWhere(['like', 'client', $this->client])
            ->andFilterWhere(['like', 'paper', $this->paper])
            ->andFilterWhere(['like', 'protocol', $this->protocol])
            ->andFilterWhere(['like', 'high', $this->high])
            ->andFilterWhere(['like', 'width', $this->width])
            ->andFilterWhere(['like', 'duplex', $this->duplex])
            ->andFilterWhere(['like', 'grayscale', $this->grayscale])
            ->andFilterWhere(['like', 'size', $this->size]);

        return $dataProvider;
    }
}
