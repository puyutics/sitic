<?php

namespace app\models\parkingcontrol;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\parkingcontrol\Puerta;

/**
 * PuertaSearch represents the model behind the search form of `app\models\parkingcontrol\Puerta`.
 */
class PuertaSearch extends Puerta
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PRT_COD', 'PRI_DES', 'PRI_LOC', 'PRI_AREA1', 'PRI_IP', 'PRI_FEC', 'PRI_STA', 'PRI_ST', 'PRI_PTO', 'PRI_TIPO', 'PRI_VIRDI', 'PRI_TI', 'PRI_TE', 'PRI_PRINTER', 'PRI_UTRAN', 'PRI_OPENTIME', 'PRI_LASTUSER', 'PRI_LASTMARCA', 'PRI_LAST_ID', 'PRI_NOW', 'PRI_EVENTO', 'PRI_EMPRESA_NOM', 'PRI_CAM_IP', 'PRI_CAM_PASS', 'PRI_CAM_USER', 'PRI_PARQUEO', 'PRI_IDSTATION', 'PRI_LASTRFID', 'PRI_ULTIMALECTURA'], 'safe'],
            [['PRI_P', 'PRI_VALCLAVE', 'PRI_OPEN', 'PRI_TIEMPO', 'PRI_VERIFICA', 'PRI_VALIDA', 'PRI_ENVIA_ALERTA', 'PRI_EMPRESA', 'PRI_SEL', 'PRI_CAM', 'PRI_ENTRY'], 'integer'],
            [['PRI_AREA', 'PRI_TTRAN'], 'number'],
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
            'PRI_TTRAN' => $this->PRI_TTRAN,
            'PRI_UTRAN' => $this->PRI_UTRAN,
            'PRI_OPEN' => $this->PRI_OPEN,
            'PRI_OPENTIME' => $this->PRI_OPENTIME,
            'PRI_LASTMARCA' => $this->PRI_LASTMARCA,
            'PRI_TIEMPO' => $this->PRI_TIEMPO,
            'PRI_VERIFICA' => $this->PRI_VERIFICA,
            'PRI_NOW' => $this->PRI_NOW,
            'PRI_VALIDA' => $this->PRI_VALIDA,
            'PRI_ENVIA_ALERTA' => $this->PRI_ENVIA_ALERTA,
            'PRI_EMPRESA' => $this->PRI_EMPRESA,
            'PRI_SEL' => $this->PRI_SEL,
            'PRI_CAM' => $this->PRI_CAM,
            'PRI_ENTRY' => $this->PRI_ENTRY,
            'PRI_ULTIMALECTURA' => $this->PRI_ULTIMALECTURA,
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
            ->andFilterWhere(['like', 'PRI_PARQUEO', $this->PRI_PARQUEO])
            ->andFilterWhere(['like', 'PRI_IDSTATION', $this->PRI_IDSTATION])
            ->andFilterWhere(['like', 'PRI_LASTRFID', $this->PRI_LASTRFID]);

        return $dataProvider;
    }
}
