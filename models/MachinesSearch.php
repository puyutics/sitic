<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Machines;

/**
 * MachinesSearch represents the model behind the search form of `app\models\Machines`.
 */
class MachinesSearch extends Machines
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'ConnectType', 'SerialPort', 'Port', 'Baudrate', 'MachineNumber', 'IsHost', 'Enabled', 'UILanguage', 'DateFormat', 'InOutRecordWarn', 'Idle', 'Voice', 'managercount', 'usercount', 'fingercount', 'SecretCount', 'LockControl', 'Purpose', 'ProduceKind', 'IsIfChangeConfigServer2'], 'integer'],
            [['MachineAlias', 'IP', 'CommPassword', 'FirmwareVersion', 'ProductType', 'sn', 'PhotoStamp', 'SENSORID', 'SECURITY'], 'safe'],
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
        $query = Machines::find();

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
            'ID' => $this->ID,
            'ConnectType' => $this->ConnectType,
            'SerialPort' => $this->SerialPort,
            'Port' => $this->Port,
            'Baudrate' => $this->Baudrate,
            'MachineNumber' => $this->MachineNumber,
            'IsHost' => $this->IsHost,
            'Enabled' => $this->Enabled,
            'UILanguage' => $this->UILanguage,
            'DateFormat' => $this->DateFormat,
            'InOutRecordWarn' => $this->InOutRecordWarn,
            'Idle' => $this->Idle,
            'Voice' => $this->Voice,
            'managercount' => $this->managercount,
            'usercount' => $this->usercount,
            'fingercount' => $this->fingercount,
            'SecretCount' => $this->SecretCount,
            'LockControl' => $this->LockControl,
            'Purpose' => $this->Purpose,
            'ProduceKind' => $this->ProduceKind,
            'IsIfChangeConfigServer2' => $this->IsIfChangeConfigServer2,
        ]);

        $query->andFilterWhere(['like', 'MachineAlias', $this->MachineAlias])
            ->andFilterWhere(['like', 'IP', $this->IP])
            ->andFilterWhere(['like', 'CommPassword', $this->CommPassword])
            ->andFilterWhere(['like', 'FirmwareVersion', $this->FirmwareVersion])
            ->andFilterWhere(['like', 'ProductType', $this->ProductType])
            ->andFilterWhere(['like', 'sn', $this->sn])
            ->andFilterWhere(['like', 'PhotoStamp', $this->PhotoStamp])
            ->andFilterWhere(['like', 'SENSORID', $this->SENSORID])
            ->andFilterWhere(['like', 'SECURITY', $this->SECURITY]);

        return $dataProvider;
    }
}
