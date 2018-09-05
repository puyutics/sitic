<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItProjectsUser;

/**
 * ItProjectsUserSearch represents the model behind the search form of `app\models\ItProjectsUser`.
 */
class ItProjectsUserSearch extends ItProjectsUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'it_projects_id'], 'integer'],
            [['username', 'description', 'date_asigned', 'date_released', 'status'], 'safe'],
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
        $query = ItProjectsUser::find();

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
            'it_projects_id' => $this->it_projects_id,
            'date_asigned' => $this->date_asigned,
            'date_released' => $this->date_released,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
