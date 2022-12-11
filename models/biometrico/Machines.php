<?php

namespace app\models\biometrico;

use Yii;

/**
 * This is the model class for table "MACHINES".
 *
 * @property int $ID
 * @property string $MachineAlias
 * @property int $ConnectType
 * @property string $IP
 * @property int $SerialPort
 * @property int $Port
 * @property int $Baudrate
 * @property int $MachineNumber
 * @property int $IsHost
 * @property int $Enabled
 * @property string $CommPassword
 * @property int $UILanguage
 * @property int $DateFormat
 * @property int $InOutRecordWarn
 * @property int $Idle
 * @property int $Voice
 * @property int $managercount
 * @property int $usercount
 * @property int $fingercount
 * @property int $SecretCount
 * @property string $FirmwareVersion
 * @property string $ProductType
 * @property int $LockControl
 * @property int $Purpose
 * @property int $ProduceKind
 * @property string $sn
 * @property string $PhotoStamp
 * @property int $IsIfChangeConfigServer2
 * @property string $SENSORID
 * @property string $SECURITY
 */
class Machines extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'MACHINES';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_biometrico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ID', 'MachineAlias', 'ConnectType', 'MachineNumber'], 'required'],
            [['ID', 'ConnectType', 'SerialPort', 'Port', 'Baudrate', 'MachineNumber', 'IsHost', 'Enabled', 'UILanguage', 'DateFormat', 'InOutRecordWarn', 'Idle', 'Voice', 'managercount', 'usercount', 'fingercount', 'SecretCount', 'LockControl', 'Purpose', 'ProduceKind', 'IsIfChangeConfigServer2'], 'integer'],
            [['MachineAlias', 'IP', 'FirmwareVersion', 'ProductType', 'sn', 'PhotoStamp'], 'string', 'max' => 20],
            [['CommPassword'], 'string', 'max' => 12],
            [['SENSORID'], 'string', 'max' => 5],
            [['SECURITY'], 'string', 'max' => 50],
            [['ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'MachineAlias' => 'Biométrico',
            'ConnectType' => 'Connect Type',
            'IP' => 'Dirección IP',
            'SerialPort' => 'Serial Port',
            'Port' => 'Port',
            'Baudrate' => 'Baudrate',
            'MachineNumber' => 'Machine Number',
            'IsHost' => 'Is Host',
            'Enabled' => 'Enabled',
            'CommPassword' => 'Comm Password',
            'UILanguage' => 'Ui Language',
            'DateFormat' => 'Date Format',
            'InOutRecordWarn' => 'In Out Record Warn',
            'Idle' => 'Idle',
            'Voice' => 'Voice',
            'managercount' => 'Managercount',
            'usercount' => 'Usercount',
            'fingercount' => 'Fingercount',
            'SecretCount' => 'Secret Count',
            'FirmwareVersion' => 'Firmware Version',
            'ProductType' => 'Product Type',
            'LockControl' => 'Lock Control',
            'Purpose' => 'Purpose',
            'ProduceKind' => 'Produce Kind',
            'sn' => 'No. Serie',
            'PhotoStamp' => 'Photo Stamp',
            'IsIfChangeConfigServer2' => 'Is If Change Config Server2',
            'SENSORID' => 'No. Sensor',
            'SECURITY' => 'Security',
        ];
    }
}
