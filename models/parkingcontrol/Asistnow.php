<?php

namespace app\models\parkingcontrol;

use Yii;

/**
 * This is the model class for table "ASISTNOW".
 *
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
 * @property int $ASIS_PRINT
 * @property string $ASIS_NOVEDAD
 * @property string $ASIS_MM
 */
class Asistnow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ASISTNOW';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_parkingcontrol');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ASIS_ID', 'ASIS_ING', 'ASIS_ZONA'], 'required'],
            [['ASIS_ING', 'ASIS_FECHA', 'ASIS_FN', 'ASIS_HN'], 'safe'],
            [['ASIS_F', 'ASIS_PRINT'], 'integer'],
            [['ASIS_ID'], 'string', 'max' => 6],
            [['ASIS_ZONA', 'ASIS_HORA', 'ASIS_RES'], 'string', 'max' => 20],
            [['ASIS_TIPO'], 'string', 'max' => 10],
            [['ASIS_NOVEDAD'], 'string', 'max' => 200],
            [['ASIS_MM'], 'string', 'max' => 1],
            [['ASIS_ID', 'ASIS_ING', 'ASIS_ZONA'], 'unique', 'targetAttribute' => ['ASIS_ID', 'ASIS_ING', 'ASIS_ZONA']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
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
            'ASIS_PRINT' => 'Asis Print',
            'ASIS_NOVEDAD' => 'Asis Novedad',
            'ASIS_MM' => 'Asis Mm',
        ];
    }
}
