<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBLSERVER".
 *
 * @property string $PR_ID
 * @property string $PR_SE
 * @property int $PR_COD
 * @property string $PR_Log
 * @property string $PR_LHora
 * @property string $PR_IP
 * @property string $PR_FINGER
 * @property int $PR_LD
 * @property int $PR_LT
 * @property string $PR_F1
 * @property string $PR_F2
 * @property string $PR_F3
 * @property string $PR_F4
 * @property string $PR_UCOD
 * @property int $PR_CODA
 * @property int $BASE
 * @property int $PR_DOWNPER
 * @property int $PR_ANTIPASS
 * @property int $PR_RANDOM
 * @property string $VE_IP
 * @property int $PR_ANTIPASSGEN
 * @property string $PR_ESCLAVO
 * @property int $PR_COMIDADIARIA
 * @property string $PR_HUELLASMATCHER
 * @property int $PR_RESTRICCION
 * @property string $PR_KEY_MIFARE
 * @property int $PR_CANTCOMIDA
 * @property string $PR_IP_SERVER2
 * @property string $PR_IP_SERVER3
 * @property string $PR_IP_SERVER4
 * @property int $PR_TIPOLOG
 * @property int $PR_GRABAIMAGENCAMARA
 * @property int $PR_DELETELOG
 * @property int $PR_CLAVE_ENCRIPTADA
 * @property int $PR_CONTROL_TIEMPO
 * @property int $PR_CONTROL_MARCA
 */
class Tblserver extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBLSERVER';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_onlycontrol');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PR_ID', 'PR_Log', 'PR_IP', 'PR_UCOD'], 'required'],
            [['PR_COD', 'PR_LD', 'PR_LT', 'PR_CODA', 'BASE', 'PR_DOWNPER', 'PR_ANTIPASS', 'PR_RANDOM', 'PR_ANTIPASSGEN', 'PR_COMIDADIARIA', 'PR_RESTRICCION', 'PR_CANTCOMIDA', 'PR_TIPOLOG', 'PR_GRABAIMAGENCAMARA', 'PR_DELETELOG', 'PR_CLAVE_ENCRIPTADA', 'PR_CONTROL_TIEMPO', 'PR_CONTROL_MARCA'], 'integer'],
            [['PR_ID', 'PR_LHora', 'PR_FINGER', 'PR_F1', 'PR_F2', 'PR_F3', 'PR_F4', 'PR_UCOD', 'PR_ESCLAVO'], 'string', 'max' => 10],
            [['PR_SE', 'PR_Log', 'PR_IP', 'VE_IP', 'PR_IP_SERVER2', 'PR_IP_SERVER3', 'PR_IP_SERVER4'], 'string', 'max' => 30],
            [['PR_HUELLASMATCHER'], 'string', 'max' => 20],
            [['PR_KEY_MIFARE'], 'string', 'max' => 6],
            [['PR_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PR_ID' => 'Pr ID',
            'PR_SE' => 'Pr Se',
            'PR_COD' => 'Pr Cod',
            'PR_Log' => 'Pr Log',
            'PR_LHora' => 'Pr L Hora',
            'PR_IP' => 'Pr Ip',
            'PR_FINGER' => 'Pr Finger',
            'PR_LD' => 'Pr Ld',
            'PR_LT' => 'Pr Lt',
            'PR_F1' => 'Pr F1',
            'PR_F2' => 'Pr F2',
            'PR_F3' => 'Pr F3',
            'PR_F4' => 'Pr F4',
            'PR_UCOD' => 'Pr Ucod',
            'PR_CODA' => 'Pr Coda',
            'BASE' => 'Base',
            'PR_DOWNPER' => 'Pr Downper',
            'PR_ANTIPASS' => 'Pr Antipass',
            'PR_RANDOM' => 'Pr Random',
            'VE_IP' => 'Ve Ip',
            'PR_ANTIPASSGEN' => 'Pr Antipassgen',
            'PR_ESCLAVO' => 'Pr Esclavo',
            'PR_COMIDADIARIA' => 'Pr Comidadiaria',
            'PR_HUELLASMATCHER' => 'Pr Huellasmatcher',
            'PR_RESTRICCION' => 'Pr Restriccion',
            'PR_KEY_MIFARE' => 'Pr Key Mifare',
            'PR_CANTCOMIDA' => 'Pr Cantcomida',
            'PR_IP_SERVER2' => 'Pr Ip Server2',
            'PR_IP_SERVER3' => 'Pr Ip Server3',
            'PR_IP_SERVER4' => 'Pr Ip Server4',
            'PR_TIPOLOG' => 'Pr Tipolog',
            'PR_GRABAIMAGENCAMARA' => 'Pr Grabaimagencamara',
            'PR_DELETELOG' => 'Pr Deletelog',
            'PR_CLAVE_ENCRIPTADA' => 'Pr Clave Encriptada',
            'PR_CONTROL_TIEMPO' => 'Pr Control Tiempo',
            'PR_CONTROL_MARCA' => 'Pr Control Marca',
        ];
    }
}
