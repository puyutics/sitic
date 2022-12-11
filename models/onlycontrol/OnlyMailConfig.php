<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "ONLY_MAIL_CONFIG".
 *
 * @property string $M_ID
 * @property int $M_SERVICE
 * @property string $M_SMTP_SERVER
 * @property string $M_PUERTO_SERVER
 * @property string $M_MAIL_HOST
 * @property int $M_Autentificacion
 * @property string $M_USER
 * @property string $M_CLAVE
 * @property int $M_TIMEUP
 * @property int $M_Fallido
 * @property int $M_OPCION1
 * @property int $M_OPCION2
 * @property int $M_OPCION3
 * @property string $M_CUENTA1
 * @property string $M_CUENTA2
 * @property string $M_CUENTA3
 * @property int $M_SSL
 */
class OnlyMailConfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ONLY_MAIL_CONFIG';
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
            [['M_ID'], 'required'],
            [['M_SERVICE', 'M_Autentificacion', 'M_TIMEUP', 'M_Fallido', 'M_OPCION1', 'M_OPCION2', 'M_OPCION3', 'M_SSL'], 'integer'],
            [['M_ID'], 'string', 'max' => 10],
            [['M_SMTP_SERVER', 'M_PUERTO_SERVER', 'M_MAIL_HOST', 'M_USER', 'M_CUENTA1', 'M_CUENTA2', 'M_CUENTA3'], 'string', 'max' => 60],
            [['M_CLAVE'], 'string', 'max' => 30],
            [['M_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'M_ID' => 'M ID',
            'M_SERVICE' => 'M Service',
            'M_SMTP_SERVER' => 'M Smtp Server',
            'M_PUERTO_SERVER' => 'M Puerto Server',
            'M_MAIL_HOST' => 'M Mail Host',
            'M_Autentificacion' => 'M Autentificacion',
            'M_USER' => 'M User',
            'M_CLAVE' => 'M Clave',
            'M_TIMEUP' => 'M Timeup',
            'M_Fallido' => 'M Fallido',
            'M_OPCION1' => 'M Opcion1',
            'M_OPCION2' => 'M Opcion2',
            'M_OPCION3' => 'M Opcion3',
            'M_CUENTA1' => 'M Cuenta1',
            'M_CUENTA2' => 'M Cuenta2',
            'M_CUENTA3' => 'M Cuenta3',
            'M_SSL' => 'M Ssl',
        ];
    }
}
