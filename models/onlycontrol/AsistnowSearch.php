<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\Asistnow;

/**
 * AsistnowSearch represents the model behind the search form of `app\models\onlycontrol\Asistnow`.
 */
class AsistnowSearch extends Asistnow
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ASIS_ID', 'ASIS_ING', 'ASIS_ZONA', 'ASIS_FECHA', 'ASIS_HORA', 'ASIS_TIPO', 'ASIS_RES', 'ASIS_FN', 'ASIS_HN', 'ASIS_NOVEDAD', 'ASIS_MM', 'ASIS_EVO'], 'safe'],
            [['ASIS_F', 'ASIS_PRINT', 'ASIS_MAIL', 'ASIS_CORRIGE'], 'integer'],
            [['ASIS_TEMPERATURA', 'ASIS_SIMILARIDAD', 'ASIS_EMPRESA'], 'number'],
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
        $query = Asistnow::find();

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
            'ASIS_ING' => $this->ASIS_ING,
            'ASIS_FECHA' => $this->ASIS_FECHA,
            'ASIS_F' => $this->ASIS_F,
            'ASIS_FN' => $this->ASIS_FN,
            'ASIS_HN' => $this->ASIS_HN,
            'ASIS_PRINT' => $this->ASIS_PRINT,
            'ASIS_MAIL' => $this->ASIS_MAIL,
            'ASIS_CORRIGE' => $this->ASIS_CORRIGE,
            'ASIS_TEMPERATURA' => $this->ASIS_TEMPERATURA,
            'ASIS_SIMILARIDAD' => $this->ASIS_SIMILARIDAD,
            'ASIS_EMPRESA' => $this->ASIS_EMPRESA,
        ]);

        $query->andFilterWhere(['like', 'ASIS_ID', $this->ASIS_ID])
            ->andFilterWhere(['like', 'ASIS_ZONA', $this->ASIS_ZONA])
            ->andFilterWhere(['like', 'ASIS_HORA', $this->ASIS_HORA])
            ->andFilterWhere(['like', 'ASIS_TIPO', $this->ASIS_TIPO])
            ->andFilterWhere(['like', 'ASIS_RES', $this->ASIS_RES])
            ->andFilterWhere(['like', 'ASIS_NOVEDAD', $this->ASIS_NOVEDAD])
            ->andFilterWhere(['like', 'ASIS_MM', $this->ASIS_MM])
            ->andFilterWhere(['like', 'ASIS_EVO', $this->ASIS_EVO]);

        return $dataProvider;
    }
}