<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\TblZonaequipo;

/**
 * TblZonaequipoSearch represents the model behind the search form of `app\models\onlycontrol\TblZonaequipo`.
 */
class TblZonaequipoSearch extends TblZonaequipo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AREA_ZM_ID', 'ZM_ID', 'PRT_SEL'], 'number'],
            [['PRT_COD', 'PRI_DES'], 'safe'],
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
        $query = TblZonaequipo::find();

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
            'AREA_ZM_ID' => $this->AREA_ZM_ID,
            'ZM_ID' => $this->ZM_ID,
            'PRT_SEL' => $this->PRT_SEL,
        ]);

        $query->andFilterWhere(['like', 'PRT_COD', $this->PRT_COD])
            ->andFilterWhere(['like', 'PRI_DES', $this->PRI_DES]);

        return $dataProvider;
    }
}
