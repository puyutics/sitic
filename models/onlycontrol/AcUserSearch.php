<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\AcUser;

/**
 * AcUserSearch represents the model behind the search form of `app\models\onlycontrol\AcUser`.
 */
class AcUserSearch extends AcUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AC_USER', 'AC_UCREA', 'AC_FCREA'], 'safe'],
            [['AC_P1', 'AC_P2', 'AC_P3', 'AC_P4', 'AC_P5', 'AC_P6', 'AC_P7', 'AC_P8', 'AC_P9', 'AC_P10', 'AC_P11', 'AC_P12', 'AC_P13', 'AC_P14', 'AC_P15', 'AC_P16', 'AC_P17', 'AC_P18', 'AC_P19', 'AC_P20'], 'integer'],
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
        $query = AcUser::find();

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
            'AC_P1' => $this->AC_P1,
            'AC_P2' => $this->AC_P2,
            'AC_P3' => $this->AC_P3,
            'AC_P4' => $this->AC_P4,
            'AC_P5' => $this->AC_P5,
            'AC_P6' => $this->AC_P6,
            'AC_P7' => $this->AC_P7,
            'AC_P8' => $this->AC_P8,
            'AC_P9' => $this->AC_P9,
            'AC_P10' => $this->AC_P10,
            'AC_P11' => $this->AC_P11,
            'AC_P12' => $this->AC_P12,
            'AC_P13' => $this->AC_P13,
            'AC_P14' => $this->AC_P14,
            'AC_P15' => $this->AC_P15,
            'AC_P16' => $this->AC_P16,
            'AC_P17' => $this->AC_P17,
            'AC_P18' => $this->AC_P18,
            'AC_P19' => $this->AC_P19,
            'AC_P20' => $this->AC_P20,
            'AC_FCREA' => $this->AC_FCREA,
        ]);

        $query->andFilterWhere(['like', 'AC_USER', $this->AC_USER])
            ->andFilterWhere(['like', 'AC_UCREA', $this->AC_UCREA]);

        return $dataProvider;
    }
}
