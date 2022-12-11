<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "CC_ASISTENCIA_CONSOLID".
 *
 * @property string $CC_ID_EMP
 * @property string $CC_FECHA_INGRESO
 * @property string $CC_FECHA_SALIDA
 * @property string $CC_HORA_INGRESO
 * @property string $CC_HORA_SALIDA
 * @property string $CC_HORAS_LABORADAS
 * @property int $CC_MINUTOS_LABORADOS
 * @property string $CC_COD_CC
 * @property int $CC_CONTADOR
 */
class CcAsistenciaConsolid extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CC_ASISTENCIA_CONSOLID';
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
            [['CC_ID_EMP', 'CC_FECHA_INGRESO', 'CC_COD_CC', 'CC_CONTADOR'], 'required'],
            [['CC_FECHA_INGRESO', 'CC_FECHA_SALIDA', 'CC_HORA_INGRESO', 'CC_HORA_SALIDA', 'CC_HORAS_LABORADAS'], 'safe'],
            [['CC_MINUTOS_LABORADOS', 'CC_CONTADOR'], 'integer'],
            [['CC_ID_EMP', 'CC_COD_CC'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CC_ID_EMP' => 'Cc Id Emp',
            'CC_FECHA_INGRESO' => 'Cc Fecha Ingreso',
            'CC_FECHA_SALIDA' => 'Cc Fecha Salida',
            'CC_HORA_INGRESO' => 'Cc Hora Ingreso',
            'CC_HORA_SALIDA' => 'Cc Hora Salida',
            'CC_HORAS_LABORADAS' => 'Cc Horas Laboradas',
            'CC_MINUTOS_LABORADOS' => 'Cc Minutos Laborados',
            'CC_COD_CC' => 'Cc Cod Cc',
            'CC_CONTADOR' => 'Cc Contador',
        ];
    }
}
