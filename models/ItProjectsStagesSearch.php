<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItProjectsStages;

/**
 * ItProjectsStagesSearch represents the model behind the search form of `app\models\ItProjectsStages`.
 */
class ItProjectsStagesSearch extends ItProjectsStages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'percent', 'it_projects_id'], 'integer'],
            [['project_stage', 'description'], 'safe'],
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
        $query = ItProjectsStages::find();

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
            'percent' => $this->percent,
            'it_projects_id' => $this->it_projects_id,
        ]);

        $query->andFilterWhere(['like', 'project_stage', $this->project_stage])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
