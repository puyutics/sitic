<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\TblZonamarcaje;

/**
 * TblZonamarcajeSearch represents the model behind the search form of `app\models\onlycontrol\TblZonamarcaje`.
 */
class TblZonamarcajeSearch extends TblZonamarcaje
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ZM_ID', 'ZM_SEL'], 'number'],
            [['ZM_DES', 'ZM_EMPE_NOM'], 'safe'],
            [['ZM_EMPE'], 'integer'],
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
        $query = TblZonamarcaje::find();

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
            'ZM_ID' => $this->ZM_ID,
            'ZM_SEL' => $this->ZM_SEL,
            'ZM_EMPE' => $this->ZM_EMPE,
        ]);

        $query->andFilterWhere(['like', 'ZM_DES', $this->ZM_DES])
            ->andFilterWhere(['like', 'ZM_EMPE_NOM', $this->ZM_EMPE_NOM]);

        return $dataProvider;
    }
}
