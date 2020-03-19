<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserInfo;

/**
 * UserInfoSearch represents the model behind the search form of `app\models\UserInfo`.
 */
class UserInfoSearch extends UserInfo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['USERID', 'VERIFICATIONMETHOD', 'DEFAULTDEPTID', 'SECURITYFLAGS', 'ATT', 'INLATE', 'OUTEARLY', 'OVERTIME', 'SEP', 'HOLIDAY', 'LUNCHDURATION', 'privilege', 'InheritDeptSch', 'InheritDeptSchClass', 'AutoSchPlan', 'MinAutoSchInterval', 'RegisterOT', 'InheritDeptRule', 'EMPRIVILEGE', 'sca_1Quincena', 'sca_IdCentroCostos', 'sca_CargasFamiliares', 'Pin1', 'sca_WEB_MarcaManual'], 'integer'],
            [['BADGENUMBER', 'SSN', 'NAME', 'GENDER', 'TITLE', 'PAGER', 'BIRTHDAY', 'HIREDDAY', 'STREET', 'CITY', 'STATE', 'ZIP', 'OPHONE', 'FPHONE', 'MINZU', 'PASSWORD', 'MVerifyPass', 'PHOTO', 'Notes', 'CardNo', 'sca_IESSID', 'sca_Estado', 'sca_FormaPago', 'sca_Nombre', 'sca_Apellido', 'sca_Cargo', 'sca_EstadoCivil', 'sca_Sexo', 'sca_FechaDespido', 'sca_Firma', 'sca_Discapacidad', 'sca_Correo', 'sca_MotivoInactivacion'], 'safe'],
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
        $query = UserInfo::find();

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
            'USERID' => $this->USERID,
            'BIRTHDAY' => $this->BIRTHDAY,
            'HIREDDAY' => $this->HIREDDAY,
            'VERIFICATIONMETHOD' => $this->VERIFICATIONMETHOD,
            'DEFAULTDEPTID' => $this->DEFAULTDEPTID,
            'SECURITYFLAGS' => $this->SECURITYFLAGS,
            'ATT' => $this->ATT,
            'INLATE' => $this->INLATE,
            'OUTEARLY' => $this->OUTEARLY,
            'OVERTIME' => $this->OVERTIME,
            'SEP' => $this->SEP,
            'HOLIDAY' => $this->HOLIDAY,
            'LUNCHDURATION' => $this->LUNCHDURATION,
            'privilege' => $this->privilege,
            'InheritDeptSch' => $this->InheritDeptSch,
            'InheritDeptSchClass' => $this->InheritDeptSchClass,
            'AutoSchPlan' => $this->AutoSchPlan,
            'MinAutoSchInterval' => $this->MinAutoSchInterval,
            'RegisterOT' => $this->RegisterOT,
            'InheritDeptRule' => $this->InheritDeptRule,
            'EMPRIVILEGE' => $this->EMPRIVILEGE,
            'sca_1Quincena' => $this->sca_1Quincena,
            'sca_IdCentroCostos' => $this->sca_IdCentroCostos,
            'sca_FechaDespido' => $this->sca_FechaDespido,
            'sca_CargasFamiliares' => $this->sca_CargasFamiliares,
            'Pin1' => $this->Pin1,
            'sca_WEB_MarcaManual' => $this->sca_WEB_MarcaManual,
        ]);

        $query->andFilterWhere(['like', 'BADGENUMBER', $this->BADGENUMBER])
            ->andFilterWhere(['like', 'SSN', $this->SSN])
            ->andFilterWhere(['like', 'NAME', $this->NAME])
            ->andFilterWhere(['like', 'GENDER', $this->GENDER])
            ->andFilterWhere(['like', 'TITLE', $this->TITLE])
            ->andFilterWhere(['like', 'PAGER', $this->PAGER])
            ->andFilterWhere(['like', 'STREET', $this->STREET])
            ->andFilterWhere(['like', 'CITY', $this->CITY])
            ->andFilterWhere(['like', 'STATE', $this->STATE])
            ->andFilterWhere(['like', 'ZIP', $this->ZIP])
            ->andFilterWhere(['like', 'OPHONE', $this->OPHONE])
            ->andFilterWhere(['like', 'FPHONE', $this->FPHONE])
            ->andFilterWhere(['like', 'MINZU', $this->MINZU])
            ->andFilterWhere(['like', 'PASSWORD', $this->PASSWORD])
            ->andFilterWhere(['like', 'MVerifyPass', $this->MVerifyPass])
            ->andFilterWhere(['like', 'PHOTO', $this->PHOTO])
            ->andFilterWhere(['like', 'Notes', $this->Notes])
            ->andFilterWhere(['like', 'CardNo', $this->CardNo])
            ->andFilterWhere(['like', 'sca_IESSID', $this->sca_IESSID])
            ->andFilterWhere(['like', 'sca_Estado', $this->sca_Estado])
            ->andFilterWhere(['like', 'sca_FormaPago', $this->sca_FormaPago])
            ->andFilterWhere(['like', 'sca_Nombre', $this->sca_Nombre])
            ->andFilterWhere(['like', 'sca_Apellido', $this->sca_Apellido])
            ->andFilterWhere(['like', 'sca_Cargo', $this->sca_Cargo])
            ->andFilterWhere(['like', 'sca_EstadoCivil', $this->sca_EstadoCivil])
            ->andFilterWhere(['like', 'sca_Sexo', $this->sca_Sexo])
            ->andFilterWhere(['like', 'sca_Firma', $this->sca_Firma])
            ->andFilterWhere(['like', 'sca_Discapacidad', $this->sca_Discapacidad])
            ->andFilterWhere(['like', 'sca_Correo', $this->sca_Correo])
            ->andFilterWhere(['like', 'sca_MotivoInactivacion', $this->sca_MotivoInactivacion]);

        return $dataProvider;
    }
}
