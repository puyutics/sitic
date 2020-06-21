<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TabIntFormularioInvItemUser;

/**
 * TabIntFormularioInvItemUserSearch represents the model behind the search form of `app\models\TabIntFormularioInvItemUser`.
 */
class TabIntFormularioInvItemUserSearch extends TabIntFormularioInvItemUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tab_int_formulario_id', 'inv_item_user_id', 'status'], 'integer'],
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
        $query = TabIntFormularioInvItemUser::find();

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
            'tab_int_formulario_id' => $this->tab_int_formulario_id,
            'inv_item_user_id' => $this->inv_item_user_id,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
