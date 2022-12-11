<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\Tblserver;

/**
 * TblserverSearch represents the model behind the search form of `app\models\onlycontrol\Tblserver`.
 */
class TblserverSearch extends Tblserver
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PR_ID', 'PR_SE', 'PR_Log', 'PR_LHora', 'PR_IP', 'PR_FINGER', 'PR_F1', 'PR_F2', 'PR_F3', 'PR_F4', 'PR_UCOD', 'VE_IP', 'PR_ESCLAVO', 'PR_HUELLASMATCHER', 'PR_KEY_MIFARE', 'PR_IP_SERVER2', 'PR_IP_SERVER3', 'PR_IP_SERVER4'], 'safe'],
            [['PR_COD', 'PR_LD', 'PR_LT', 'PR_CODA', 'BASE', 'PR_DOWNPER', 'PR_ANTIPASS', 'PR_RANDOM', 'PR_ANTIPASSGEN', 'PR_COMIDADIARIA', 'PR_RESTRICCION', 'PR_CANTCOMIDA', 'PR_TIPOLOG', 'PR_GRABAIMAGENCAMARA', 'PR_DELETELOG', 'PR_CLAVE_ENCRIPTADA', 'PR_CONTROL_TIEMPO', 'PR_CONTROL_MARCA'], 'integer'],
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
        $query = Tblserver::find();

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
            'PR_COD' => $this->PR_COD,
            'PR_LD' => $this->PR_LD,
            'PR_LT' => $this->PR_LT,
            'PR_CODA' => $this->PR_CODA,
            'BASE' => $this->BASE,
            'PR_DOWNPER' => $this->PR_DOWNPER,
            'PR_ANTIPASS' => $this->PR_ANTIPASS,
            'PR_RANDOM' => $this->PR_RANDOM,
            'PR_ANTIPASSGEN' => $this->PR_ANTIPASSGEN,
            'PR_COMIDADIARIA' => $this->PR_COMIDADIARIA,
            'PR_RESTRICCION' => $this->PR_RESTRICCION,
            'PR_CANTCOMIDA' => $this->PR_CANTCOMIDA,
            'PR_TIPOLOG' => $this->PR_TIPOLOG,
            'PR_GRABAIMAGENCAMARA' => $this->PR_GRABAIMAGENCAMARA,
            'PR_DELETELOG' => $this->PR_DELETELOG,
            'PR_CLAVE_ENCRIPTADA' => $this->PR_CLAVE_ENCRIPTADA,
            'PR_CONTROL_TIEMPO' => $this->PR_CONTROL_TIEMPO,
            'PR_CONTROL_MARCA' => $this->PR_CONTROL_MARCA,
        ]);

        $query->andFilterWhere(['like', 'PR_ID', $this->PR_ID])
            ->andFilterWhere(['like', 'PR_SE', $this->PR_SE])
            ->andFilterWhere(['like', 'PR_Log', $this->PR_Log])
            ->andFilterWhere(['like', 'PR_LHora', $this->PR_LHora])
            ->andFilterWhere(['like', 'PR_IP', $this->PR_IP])
            ->andFilterWhere(['like', 'PR_FINGER', $this->PR_FINGER])
            ->andFilterWhere(['like', 'PR_F1', $this->PR_F1])
            ->andFilterWhere(['like', 'PR_F2', $this->PR_F2])
            ->andFilterWhere(['like', 'PR_F3', $this->PR_F3])
            ->andFilterWhere(['like', 'PR_F4', $this->PR_F4])
            ->andFilterWhere(['like', 'PR_UCOD', $this->PR_UCOD])
            ->andFilterWhere(['like', 'VE_IP', $this->VE_IP])
            ->andFilterWhere(['like', 'PR_ESCLAVO', $this->PR_ESCLAVO])
            ->andFilterWhere(['like', 'PR_HUELLASMATCHER', $this->PR_HUELLASMATCHER])
            ->andFilterWhere(['like', 'PR_KEY_MIFARE', $this->PR_KEY_MIFARE])
            ->andFilterWhere(['like', 'PR_IP_SERVER2', $this->PR_IP_SERVER2])
            ->andFilterWhere(['like', 'PR_IP_SERVER3', $this->PR_IP_SERVER3])
            ->andFilterWhere(['like', 'PR_IP_SERVER4', $this->PR_IP_SERVER4]);

        return $dataProvider;
    }
}
