<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_AHANDHELD".
 *
 * @property string $W_TIPO 1 Para Vehicular 2 Para Peaton
 * @property string $W_FECHAT
 * @property string $W_TARJETA
 * @property string $W_EQUIPO
 * @property string $W_CODPERMISO
 * @property string $W_PLACA
 * @property string $W_TIPOM INGRESO O SALIDA
 * @property string $W_FECHAUP
 */
class AcAhandheld extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_AHANDHELD';
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
            [['W_FECHAT', 'W_TARJETA', 'W_EQUIPO'], 'required'],
            [['W_FECHAT', 'W_FECHAUP'], 'safe'],
            [['W_TIPO'], 'string', 'max' => 1],
            [['W_TARJETA', 'W_PLACA'], 'string', 'max' => 25],
            [['W_EQUIPO', 'W_TIPOM'], 'string', 'max' => 10],
            [['W_CODPERMISO'], 'string', 'max' => 20],
            [['W_FECHAT', 'W_TARJETA', 'W_TIPO'], 'unique', 'targetAttribute' => ['W_FECHAT', 'W_TARJETA', 'W_TIPO']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'W_TIPO' => '1 Para Vehicular 2 Para Peaton',
            'W_FECHAT' => 'W Fechat',
            'W_TARJETA' => 'W Tarjeta',
            'W_EQUIPO' => 'W Equipo',
            'W_CODPERMISO' => 'W Codpermiso',
            'W_PLACA' => 'W Placa',
            'W_TIPOM' => 'INGRESO O SALIDA',
            'W_FECHAUP' => 'W Fechaup',
        ];
    }
}
