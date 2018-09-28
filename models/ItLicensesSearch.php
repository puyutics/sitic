<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ItLicenses;

/**
 * ItLicensesSearch represents the model behind the search form of `app\models\ItLicenses`.
 */
class ItLicensesSearch extends ItLicenses
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status', 'inv_manufacturers_id'], 'integer'],
            [['license', 'description', 'serial_number', 'valid_since', 'valid_until'], 'safe'],
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
        $query = ItLicenses::find();

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
            'valid_since' => $this->valid_since,
            'valid_until' => $this->valid_until,
            'status' => $this->status,
            'inv_manufacturers_id' => $this->inv_manufacturers_id,
        ]);

        $query->andFilterWhere(['like', 'license', $this->license])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'serial_number', $this->serial_number]);

        return $dataProvider;
    }
}
