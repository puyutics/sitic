<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\AuxNomina;

/**
 * AuxNominaSearch represents the model behind the search form of `app\models\onlycontrol\AuxNomina`.
 */
class AuxNominaSearch extends AuxNomina
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ANOM_ID', 'ANOM_APE', 'ANOM_NOM', 'ANOM_CED', 'ANOM_EMP', 'ANOM_AREA', 'ANOM_DPTO', 'ANOM_CAR', 'ANOM_FECN', 'ANOM_OBS'], 'safe'],
            [['ANOM_TIPO'], 'integer'],
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
        $query = AuxNomina::find();

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
            'ANOM_FECN' => $this->ANOM_FECN,
            'ANOM_TIPO' => $this->ANOM_TIPO,
        ]);

        $query->andFilterWhere(['like', 'ANOM_ID', $this->ANOM_ID])
            ->andFilterWhere(['like', 'ANOM_APE', $this->ANOM_APE])
            ->andFilterWhere(['like', 'ANOM_NOM', $this->ANOM_NOM])
            ->andFilterWhere(['like', 'ANOM_CED', $this->ANOM_CED])
            ->andFilterWhere(['like', 'ANOM_EMP', $this->ANOM_EMP])
            ->andFilterWhere(['like', 'ANOM_AREA', $this->ANOM_AREA])
            ->andFilterWhere(['like', 'ANOM_DPTO', $this->ANOM_DPTO])
            ->andFilterWhere(['like', 'ANOM_CAR', $this->ANOM_CAR])
            ->andFilterWhere(['like', 'ANOM_OBS', $this->ANOM_OBS]);

        return $dataProvider;
    }
}
