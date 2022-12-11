<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\Nomina;

/**
 * NominaSearch represents the model behind the search form of `app\models\onlycontrol\Nomina`.
 */
class NominaSearch extends Nomina
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOMINA_ID', 'NOMINA_APE', 'NOMINA_NOM', 'NOMINA_CLAVE', 'NOMINA_COD', 'NOMINA_TIPO', 'NOMINA_CAL1', 'NOMINA_AREA1', 'NOMINA_DEP1', 'NOMINA_FING', 'NOMINA_FSAL', 'NOMINA_OBS', 'NOMINA_FINGER', 'NOMINA_F1', 'NOMINA_CED', 'NOMINA_FIR', 'NOMINA_HD1', 'NOMINA_HF1', 'NOMINA_HI1', 'NOMINA_HD2', 'NOMINA_HF2', 'NOMINA_HI2', 'NOMINA_EMPC', 'NOMINA_EMPE', 'NOMINA_DOC', 'NOMINA_PLA', 'NOMINA_CARD', 'NOMINA_FCARD', 'NOMINA_OBS1', 'NOMINA_NOW', 'NOMINA_AUTO', 'NOMINA_TIPOID', 'NOMINA_TIPONOM', 'NOMINA_HS1', 'NOMINA_HS2', 'NOMINA_CARDKEY', 'NOMINA_HWSQ1', 'NOMINA_HWSQ2', 'NOMINA_FACE', 'B_MATCHER_FLAG', 'NOMINA_KEY_CONSULT'], 'safe'],
            [['NOMINA_CAL', 'NOMINA_AREA', 'NOMINA_DEP', 'NOMINA_SUEL', 'NOMINA_COM', 'NOMINA_EMP', 'NOMINA_CAFECONTROL', 'NOMINA_SERV1', 'NOMINA_SERV2', 'NOMINA_SERV3', 'NOMINA_SERV4', 'NOMINA_SERV5', 'NOMINA_SERV6', 'NOMINA_SERV7', 'NOMINA_SERV8', 'NOMINA_SERV9'], 'number'],
            [['NOMINA_AUTI', 'NOMINA_ES', 'NOMINA_SEL', 'NOMINA_P1', 'NOMINA_P2', 'NOMINA_P3', 'NOMINA_P4', 'NOMINA_P5', 'NOMINA_P6', 'NOMINA_P7', 'NOMINA_P8', 'NOMINA_P9', 'NOMINA_P10', 'NOMINA_P11', 'NOMINA_P12', 'NOMINA_P13', 'NOMINA_P14', 'NOMINA_P15', 'NOMINA_P16', 'NOMINA_P17', 'NOMINA_P18', 'NOMINA_P19', 'NOMINA_P20', 'NOMINA_F', 'NOMINA_CAFE', 'NOMINA_P21', 'NOMINA_P22', 'NOMINA_P23', 'NOMINA_P24', 'NOMINA_P25', 'NOMINA_CONTROLAPB', 'NOMINA_STATUSAPB', 'NOMINA_CAFEMENU', 'NOMINA_LEVEL', 'NOMINA_TIPO_REGISTRO', 'NOMINA_FACE_LEN', 'NOMINA_P26', 'NOMINA_P27', 'NOMINA_ADMIN_BIO'], 'integer'],
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
        $query = Nomina::find();

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
            'NOMINA_CAL' => $this->NOMINA_CAL,
            'NOMINA_AREA' => $this->NOMINA_AREA,
            'NOMINA_DEP' => $this->NOMINA_DEP,
            'NOMINA_FING' => $this->NOMINA_FING,
            'NOMINA_FSAL' => $this->NOMINA_FSAL,
            'NOMINA_SUEL' => $this->NOMINA_SUEL,
            'NOMINA_COM' => $this->NOMINA_COM,
            'NOMINA_AUTI' => $this->NOMINA_AUTI,
            'NOMINA_ES' => $this->NOMINA_ES,
            'NOMINA_EMP' => $this->NOMINA_EMP,
            'NOMINA_SEL' => $this->NOMINA_SEL,
            'NOMINA_P1' => $this->NOMINA_P1,
            'NOMINA_P2' => $this->NOMINA_P2,
            'NOMINA_P3' => $this->NOMINA_P3,
            'NOMINA_P4' => $this->NOMINA_P4,
            'NOMINA_P5' => $this->NOMINA_P5,
            'NOMINA_P6' => $this->NOMINA_P6,
            'NOMINA_P7' => $this->NOMINA_P7,
            'NOMINA_P8' => $this->NOMINA_P8,
            'NOMINA_P9' => $this->NOMINA_P9,
            'NOMINA_P10' => $this->NOMINA_P10,
            'NOMINA_P11' => $this->NOMINA_P11,
            'NOMINA_P12' => $this->NOMINA_P12,
            'NOMINA_P13' => $this->NOMINA_P13,
            'NOMINA_P14' => $this->NOMINA_P14,
            'NOMINA_P15' => $this->NOMINA_P15,
            'NOMINA_P16' => $this->NOMINA_P16,
            'NOMINA_P17' => $this->NOMINA_P17,
            'NOMINA_P18' => $this->NOMINA_P18,
            'NOMINA_P19' => $this->NOMINA_P19,
            'NOMINA_P20' => $this->NOMINA_P20,
            'NOMINA_F' => $this->NOMINA_F,
            'NOMINA_FCARD' => $this->NOMINA_FCARD,
            'NOMINA_NOW' => $this->NOMINA_NOW,
            'NOMINA_CAFE' => $this->NOMINA_CAFE,
            'NOMINA_P21' => $this->NOMINA_P21,
            'NOMINA_P22' => $this->NOMINA_P22,
            'NOMINA_P23' => $this->NOMINA_P23,
            'NOMINA_P24' => $this->NOMINA_P24,
            'NOMINA_P25' => $this->NOMINA_P25,
            'NOMINA_CONTROLAPB' => $this->NOMINA_CONTROLAPB,
            'NOMINA_STATUSAPB' => $this->NOMINA_STATUSAPB,
            'NOMINA_CAFEMENU' => $this->NOMINA_CAFEMENU,
            'NOMINA_LEVEL' => $this->NOMINA_LEVEL,
            'NOMINA_CAFECONTROL' => $this->NOMINA_CAFECONTROL,
            'NOMINA_SERV1' => $this->NOMINA_SERV1,
            'NOMINA_SERV2' => $this->NOMINA_SERV2,
            'NOMINA_SERV3' => $this->NOMINA_SERV3,
            'NOMINA_SERV4' => $this->NOMINA_SERV4,
            'NOMINA_SERV5' => $this->NOMINA_SERV5,
            'NOMINA_SERV6' => $this->NOMINA_SERV6,
            'NOMINA_SERV7' => $this->NOMINA_SERV7,
            'NOMINA_SERV8' => $this->NOMINA_SERV8,
            'NOMINA_SERV9' => $this->NOMINA_SERV9,
            'NOMINA_TIPO_REGISTRO' => $this->NOMINA_TIPO_REGISTRO,
            'NOMINA_FACE_LEN' => $this->NOMINA_FACE_LEN,
            'NOMINA_P26' => $this->NOMINA_P26,
            'NOMINA_P27' => $this->NOMINA_P27,
            'NOMINA_ADMIN_BIO' => $this->NOMINA_ADMIN_BIO,
        ]);

        $query->andFilterWhere(['like', 'NOMINA_ID', $this->NOMINA_ID])
            ->andFilterWhere(['like', 'NOMINA_APE', $this->NOMINA_APE])
            ->andFilterWhere(['like', 'NOMINA_NOM', $this->NOMINA_NOM])
            ->andFilterWhere(['like', 'NOMINA_CLAVE', $this->NOMINA_CLAVE])
            ->andFilterWhere(['like', 'NOMINA_COD', $this->NOMINA_COD])
            ->andFilterWhere(['like', 'NOMINA_TIPO', $this->NOMINA_TIPO])
            ->andFilterWhere(['like', 'NOMINA_CAL1', $this->NOMINA_CAL1])
            ->andFilterWhere(['like', 'NOMINA_AREA1', $this->NOMINA_AREA1])
            ->andFilterWhere(['like', 'NOMINA_DEP1', $this->NOMINA_DEP1])
            ->andFilterWhere(['like', 'NOMINA_OBS', $this->NOMINA_OBS])
            ->andFilterWhere(['like', 'NOMINA_FINGER', $this->NOMINA_FINGER])
            ->andFilterWhere(['like', 'NOMINA_F1', $this->NOMINA_F1])
            ->andFilterWhere(['like', 'NOMINA_CED', $this->NOMINA_CED])
            ->andFilterWhere(['like', 'NOMINA_FIR', $this->NOMINA_FIR])
            ->andFilterWhere(['like', 'NOMINA_HD1', $this->NOMINA_HD1])
            ->andFilterWhere(['like', 'NOMINA_HF1', $this->NOMINA_HF1])
            ->andFilterWhere(['like', 'NOMINA_HI1', $this->NOMINA_HI1])
            ->andFilterWhere(['like', 'NOMINA_HD2', $this->NOMINA_HD2])
            ->andFilterWhere(['like', 'NOMINA_HF2', $this->NOMINA_HF2])
            ->andFilterWhere(['like', 'NOMINA_HI2', $this->NOMINA_HI2])
            ->andFilterWhere(['like', 'NOMINA_EMPC', $this->NOMINA_EMPC])
            ->andFilterWhere(['like', 'NOMINA_EMPE', $this->NOMINA_EMPE])
            ->andFilterWhere(['like', 'NOMINA_DOC', $this->NOMINA_DOC])
            ->andFilterWhere(['like', 'NOMINA_PLA', $this->NOMINA_PLA])
            ->andFilterWhere(['like', 'NOMINA_CARD', $this->NOMINA_CARD])
            ->andFilterWhere(['like', 'NOMINA_OBS1', $this->NOMINA_OBS1])
            ->andFilterWhere(['like', 'NOMINA_AUTO', $this->NOMINA_AUTO])
            ->andFilterWhere(['like', 'NOMINA_TIPOID', $this->NOMINA_TIPOID])
            ->andFilterWhere(['like', 'NOMINA_TIPONOM', $this->NOMINA_TIPONOM])
            ->andFilterWhere(['like', 'NOMINA_HS1', $this->NOMINA_HS1])
            ->andFilterWhere(['like', 'NOMINA_HS2', $this->NOMINA_HS2])
            ->andFilterWhere(['like', 'NOMINA_CARDKEY', $this->NOMINA_CARDKEY])
            ->andFilterWhere(['like', 'NOMINA_HWSQ1', $this->NOMINA_HWSQ1])
            ->andFilterWhere(['like', 'NOMINA_HWSQ2', $this->NOMINA_HWSQ2])
            ->andFilterWhere(['like', 'NOMINA_FACE', $this->NOMINA_FACE])
            ->andFilterWhere(['like', 'B_MATCHER_FLAG', $this->B_MATCHER_FLAG])
            ->andFilterWhere(['like', 'NOMINA_KEY_CONSULT', $this->NOMINA_KEY_CONSULT]);

        return $dataProvider;
    }
}
