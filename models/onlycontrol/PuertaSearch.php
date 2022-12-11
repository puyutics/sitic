<?php

namespace app\models\onlycontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\onlycontrol\Puerta;

/**
 * PuertaSearch represents the model behind the search form of `app\models\onlycontrol\Puerta`.
 */
class PuertaSearch extends Puerta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PRT_COD', 'PRI_DES', 'PRI_LOC', 'PRI_AREA1', 'PRI_IP', 'PRI_FEC', 'PRI_STA', 'PRI_ST', 'PRI_PTO', 'PRI_TIPO', 'PRI_VIRDI', 'PRI_TI', 'PRI_TE', 'PRI_PRINTER', 'PRI_LASTUSER', 'PRI_LASTMARCA', 'PRI_LAST_ID', 'PRI_NOW', 'PRI_EVENTO', 'PRI_EMPRESA_NOM', 'PRI_CAM_IP', 'PRI_CAM_PASS', 'PRI_CAM_USER', 'PRI_CAM_URL', 'PRI_MAC', 'PRI_MAC_KEY', 'PRI_ESTADO_LICENCIA', 'PRI_ALTITUD', 'PRI_LONGITUD', 'PRI_DISTANCIA', 'PRI_KEYEQUIPO'], 'safe'],
            [['PRI_P', 'PRI_VALCLAVE', 'PRI_SEL', 'PRI_OPEN', 'PRI_TIEMPO', 'PRI_VERIFICA', 'PRI_VALIDA', 'PRI_ENVIA_ALERTA', 'PRI_EMPRESA', 'PRI_CAM', 'PRI_CONTROL_MARCA', 'PRI_RA', 'PRI_SERV', 'PRI_ACTIVAGPS', 'PRI_DPTO', 'PRI_ENROLA'], 'integer'],
            [['PRI_AREA', 'PRI_SERVER', 'PRI_LAT', 'PRI_LON', 'PRI_PER'], 'number'],
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
        $query = Puerta::find();

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
            'PRI_P' => $this->PRI_P,
            'PRI_AREA' => $this->PRI_AREA,
            'PRI_FEC' => $this->PRI_FEC,
            'PRI_VALCLAVE' => $this->PRI_VALCLAVE,
            'PRI_SEL' => $this->PRI_SEL,
            'PRI_LASTMARCA' => $this->PRI_LASTMARCA,
            'PRI_OPEN' => $this->PRI_OPEN,
            'PRI_TIEMPO' => $this->PRI_TIEMPO,
            'PRI_VERIFICA' => $this->PRI_VERIFICA,
            'PRI_NOW' => $this->PRI_NOW,
            'PRI_VALIDA' => $this->PRI_VALIDA,
            'PRI_ENVIA_ALERTA' => $this->PRI_ENVIA_ALERTA,
            'PRI_EMPRESA' => $this->PRI_EMPRESA,
            'PRI_SERVER' => $this->PRI_SERVER,
            'PRI_CAM' => $this->PRI_CAM,
            'PRI_CONTROL_MARCA' => $this->PRI_CONTROL_MARCA,
            'PRI_RA' => $this->PRI_RA,
            'PRI_LAT' => $this->PRI_LAT,
            'PRI_LON' => $this->PRI_LON,
            'PRI_PER' => $this->PRI_PER,
            'PRI_SERV' => $this->PRI_SERV,
            'PRI_ACTIVAGPS' => $this->PRI_ACTIVAGPS,
            'PRI_DPTO' => $this->PRI_DPTO,
            'PRI_ENROLA' => $this->PRI_ENROLA,
        ]);

        $query->andFilterWhere(['like', 'PRT_COD', $this->PRT_COD])
            ->andFilterWhere(['like', 'PRI_DES', $this->PRI_DES])
            ->andFilterWhere(['like', 'PRI_LOC', $this->PRI_LOC])
            ->andFilterWhere(['like', 'PRI_AREA1', $this->PRI_AREA1])
            ->andFilterWhere(['like', 'PRI_IP', $this->PRI_IP])
            ->andFilterWhere(['like', 'PRI_STA', $this->PRI_STA])
            ->andFilterWhere(['like', 'PRI_ST', $this->PRI_ST])
            ->andFilterWhere(['like', 'PRI_PTO', $this->PRI_PTO])
            ->andFilterWhere(['like', 'PRI_TIPO', $this->PRI_TIPO])
            ->andFilterWhere(['like', 'PRI_VIRDI', $this->PRI_VIRDI])
            ->andFilterWhere(['like', 'PRI_TI', $this->PRI_TI])
            ->andFilterWhere(['like', 'PRI_TE', $this->PRI_TE])
            ->andFilterWhere(['like', 'PRI_PRINTER', $this->PRI_PRINTER])
            ->andFilterWhere(['like', 'PRI_LASTUSER', $this->PRI_LASTUSER])
            ->andFilterWhere(['like', 'PRI_LAST_ID', $this->PRI_LAST_ID])
            ->andFilterWhere(['like', 'PRI_EVENTO', $this->PRI_EVENTO])
            ->andFilterWhere(['like', 'PRI_EMPRESA_NOM', $this->PRI_EMPRESA_NOM])
            ->andFilterWhere(['like', 'PRI_CAM_IP', $this->PRI_CAM_IP])
            ->andFilterWhere(['like', 'PRI_CAM_PASS', $this->PRI_CAM_PASS])
            ->andFilterWhere(['like', 'PRI_CAM_USER', $this->PRI_CAM_USER])
            ->andFilterWhere(['like', 'PRI_CAM_URL', $this->PRI_CAM_URL])
            ->andFilterWhere(['like', 'PRI_MAC', $this->PRI_MAC])
            ->andFilterWhere(['like', 'PRI_MAC_KEY', $this->PRI_MAC_KEY])
            ->andFilterWhere(['like', 'PRI_ESTADO_LICENCIA', $this->PRI_ESTADO_LICENCIA])
            ->andFilterWhere(['like', 'PRI_ALTITUD', $this->PRI_ALTITUD])
            ->andFilterWhere(['like', 'PRI_LONGITUD', $this->PRI_LONGITUD])
            ->andFilterWhere(['like', 'PRI_DISTANCIA', $this->PRI_DISTANCIA])
            ->andFilterWhere(['like', 'PRI_KEYEQUIPO', $this->PRI_KEYEQUIPO]);

        return $dataProvider;
    }
}
