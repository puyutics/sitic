<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItProcesses;

/**
 * ItProcessesSearch represents the model behind the search form of `app\models\ItProcesses`.
 */
class ItProcessesSearch extends ItProcesses
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'magnitude', 'status'], 'integer'],
            [['process', 'description', 'metrics', 'date_creation', 'date_closed'], 'safe'],
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
        $query = ItProcesses::find();

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
            'date_creation' => $this->date_creation,
            'date_closed' => $this->date_closed,
            'magnitude' => $this->magnitude,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'process', $this->process])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'metrics', $this->metrics]);

        return $dataProvider;
    }
}
