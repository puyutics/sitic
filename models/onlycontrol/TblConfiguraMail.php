<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_CONFIGURA_MAIL".
 *
 * @property string $M_ID
 * @property int $M_SERVICE
 * @property string $M_SMTP_SERVER
 * @property string $M_POP_SERVER
 * @property string $M_MAIL_HOST
 * @property string $M_Cuenta
 * @property int $M_Autentificacion
 * @property string $M_USER
 * @property string $M_CLAVE
 * @property int $M_TIMEUP
 * @property int $M_Fallido
 * @property string $M_Mail_Alterno
 * @property int $MC_ENVIAR_EMPLEADOS
 * @property int $MC_ENVIAR_JEFES
 * @property int $MC_ENVIAR_CUENTA
 * @property string $MC_ENVIAR_CUENTA_MAIL
 * @property string $MC_ALERTA_TEMP
 */
class TblConfiguraMail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_CONFIGURA_MAIL';
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
            [['M_ID', 'M_SERVICE', 'M_Fallido', 'MC_ENVIAR_EMPLEADOS', 'MC_ENVIAR_JEFES', 'MC_ENVIAR_CUENTA'], 'required'],
            [['M_SERVICE', 'M_Autentificacion', 'M_TIMEUP', 'M_Fallido', 'MC_ENVIAR_EMPLEADOS', 'MC_ENVIAR_JEFES', 'MC_ENVIAR_CUENTA'], 'integer'],
            [['MC_ALERTA_TEMP'], 'number'],
            [['M_ID'], 'string', 'max' => 10],
            [['M_SMTP_SERVER', 'M_POP_SERVER', 'M_MAIL_HOST', 'M_Cuenta', 'M_USER', 'M_Mail_Alterno', 'MC_ENVIAR_CUENTA_MAIL'], 'string', 'max' => 60],
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
            'M_POP_SERVER' => 'M Pop Server',
            'M_MAIL_HOST' => 'M Mail Host',
            'M_Cuenta' => 'M Cuenta',
            'M_Autentificacion' => 'M Autentificacion',
            'M_USER' => 'M User',
            'M_CLAVE' => 'M Clave',
            'M_TIMEUP' => 'M Timeup',
            'M_Fallido' => 'M Fallido',
            'M_Mail_Alterno' => 'M Mail Alterno',
            'MC_ENVIAR_EMPLEADOS' => 'Mc Enviar Empleados',
            'MC_ENVIAR_JEFES' => 'Mc Enviar Jefes',
            'MC_ENVIAR_CUENTA' => 'Mc Enviar Cuenta',
            'MC_ENVIAR_CUENTA_MAIL' => 'Mc Enviar Cuenta Mail',
            'MC_ALERTA_TEMP' => 'Mc Alerta Temp',
        ];
    }
}
