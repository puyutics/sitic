<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_ASISTNOW".
 *
 * @property int $ASIS_TIPOPERMISO
 * @property string $ASIS_ID
 * @property string $ASIS_ING
 * @property string $ASIS_ZONA
 * @property string $ASIS_FECHA
 * @property string $ASIS_HORA
 * @property string $ASIS_TIPO
 * @property string $ASIS_RES
 * @property int $ASIS_F
 * @property string $ASIS_FN
 * @property string $ASIS_HN
 * @property string $ASIS_CONDUCTOR
 * @property string $ASIS_VEHICULO
 */
class AcAsistnow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_ASISTNOW';
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
            [['ASIS_TIPOPERMISO', 'ASIS_ID', 'ASIS_ING', 'ASIS_ZONA'], 'required'],
            [['ASIS_TIPOPERMISO', 'ASIS_F'], 'integer'],
            [['ASIS_ING', 'ASIS_FECHA', 'ASIS_FN', 'ASIS_HN'], 'safe'],
            [['ASIS_ID'], 'string', 'max' => 6],
            [['ASIS_ZONA', 'ASIS_HORA', 'ASIS_RES'], 'string', 'max' => 20],
            [['ASIS_TIPO', 'ASIS_CONDUCTOR', 'ASIS_VEHICULO'], 'string', 'max' => 10],
            [['ASIS_ID', 'ASIS_ING', 'ASIS_TIPOPERMISO', 'ASIS_ZONA'], 'unique', 'targetAttribute' => ['ASIS_ID', 'ASIS_ING', 'ASIS_TIPOPERMISO', 'ASIS_ZONA']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ASIS_TIPOPERMISO' => 'Asis Tipopermiso',
            'ASIS_ID' => 'Asis ID',
            'ASIS_ING' => 'Asis Ing',
            'ASIS_ZONA' => 'Asis Zona',
            'ASIS_FECHA' => 'Asis Fecha',
            'ASIS_HORA' => 'Asis Hora',
            'ASIS_TIPO' => 'Asis Tipo',
            'ASIS_RES' => 'Asis Res',
            'ASIS_F' => 'Asis F',
            'ASIS_FN' => 'Asis Fn',
            'ASIS_HN' => 'Asis Hn',
            'ASIS_CONDUCTOR' => 'Asis Conductor',
            'ASIS_VEHICULO' => 'Asis Vehiculo',
        ];
    }
}
