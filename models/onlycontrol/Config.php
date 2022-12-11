<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "CONFIG".
 *
 * @property string $CO_ID
 * @property string $CO_IP
 * @property string $CO_NOM
 * @property int $CO_LID
 * @property string $CO_LOCALIDAD
 * @property int $CO_AID
 * @property string $CO_AGENCIA
 * @property string $CO_NIVEL
 * @property int $CO_DIGITOS
 * @property string $CO_TIPO
 * @property string $CO_HORA
 * @property string $CO_MODO
 * @property int $CO_FORZAR
 * @property int $CO_COSTO
 * @property int $CO_NORMAL
 * @property int $CO_LOGO
 * @property int $CO_MAX
 * @property int $CO_CONTADOR
 * @property int $CO_TECLADO
 * @property int $CO_TICKETS
 * @property int $CO_COD
 * @property int $CO_HMARCAANTE
 * @property int $CO_HORARIO
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CONFIG';
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
            [['CO_ID', 'CO_IP', 'CO_NOM', 'CO_LID', 'CO_LOCALIDAD', 'CO_AID', 'CO_AGENCIA', 'CO_NIVEL', 'CO_DIGITOS', 'CO_TIPO', 'CO_HORA', 'CO_MODO', 'CO_FORZAR', 'CO_COSTO', 'CO_NORMAL', 'CO_LOGO', 'CO_MAX', 'CO_CONTADOR'], 'required'],
            [['CO_LID', 'CO_AID', 'CO_DIGITOS', 'CO_FORZAR', 'CO_COSTO', 'CO_NORMAL', 'CO_LOGO', 'CO_MAX', 'CO_CONTADOR', 'CO_TECLADO', 'CO_TICKETS', 'CO_COD', 'CO_HMARCAANTE', 'CO_HORARIO'], 'integer'],
            [['CO_ID', 'CO_IP', 'CO_NOM', 'CO_LOCALIDAD', 'CO_AGENCIA', 'CO_NIVEL', 'CO_TIPO', 'CO_HORA', 'CO_MODO'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CO_ID' => 'Co ID',
            'CO_IP' => 'Co Ip',
            'CO_NOM' => 'Co Nom',
            'CO_LID' => 'Co Lid',
            'CO_LOCALIDAD' => 'Co Localidad',
            'CO_AID' => 'Co Aid',
            'CO_AGENCIA' => 'Co Agencia',
            'CO_NIVEL' => 'Co Nivel',
            'CO_DIGITOS' => 'Co Digitos',
            'CO_TIPO' => 'Co Tipo',
            'CO_HORA' => 'Co Hora',
            'CO_MODO' => 'Co Modo',
            'CO_FORZAR' => 'Co Forzar',
            'CO_COSTO' => 'Co Costo',
            'CO_NORMAL' => 'Co Normal',
            'CO_LOGO' => 'Co Logo',
            'CO_MAX' => 'Co Max',
            'CO_CONTADOR' => 'Co Contador',
            'CO_TECLADO' => 'Co Teclado',
            'CO_TICKETS' => 'Co Tickets',
            'CO_COD' => 'Co Cod',
            'CO_HMARCAANTE' => 'Co Hmarcaante',
            'CO_HORARIO' => 'Co Horario',
        ];
    }
}
