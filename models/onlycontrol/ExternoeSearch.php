<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\Externoe;

/**
 * ExternoeSearch represents the model behind the search form of `app\models\onlycontrol\Externoe`.
 */
class ExternoeSearch extends Externoe
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['EMPE_ID'], 'number'],
            [['EMPE_NOM', 'EMPE_DIR', 'EMPE_RUC', 'EMPE_REP', 'EMPE_TELF', 'EMPE_FAX', 'EMPE_WEB', 'EMPE_CONT', 'EMPE_OBS', 'EMPE_CODE'], 'safe'],
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
        $query = Externoe::find();

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
            'EMPE_ID' => $this->EMPE_ID,
        ]);

        $query->andFilterWhere(['like', 'EMPE_NOM', $this->EMPE_NOM])
            ->andFilterWhere(['like', 'EMPE_DIR', $this->EMPE_DIR])
            ->andFilterWhere(['like', 'EMPE_RUC', $this->EMPE_RUC])
            ->andFilterWhere(['like', 'EMPE_REP', $this->EMPE_REP])
            ->andFilterWhere(['like', 'EMPE_TELF', $this->EMPE_TELF])
            ->andFilterWhere(['like', 'EMPE_FAX', $this->EMPE_FAX])
            ->andFilterWhere(['like', 'EMPE_WEB', $this->EMPE_WEB])
            ->andFilterWhere(['like', 'EMPE_CONT', $this->EMPE_CONT])
            ->andFilterWhere(['like', 'EMPE_OBS', $this->EMPE_OBS])
            ->andFilterWhere(['like', 'EMPE_CODE', $this->EMPE_CODE]);

        return $dataProvider;
    }
}
