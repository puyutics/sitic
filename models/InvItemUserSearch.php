<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InvItemUser;

/**
 * InvItemUserSearch represents the model behind the search form of `app\models\InvItemUser`.
 */
class InvItemUserSearch extends InvItemUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'inv_purchase_item_id', 'status'], 'integer'],
            [['username', 'date_asigned', 'date_released', 'description'], 'safe'],
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
        $query = InvItemUser::find();

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
            'inv_purchase_item_id' => $this->inv_purchase_item_id,
            'date_asigned' => $this->date_asigned,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'date_released', $this->date_released])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
