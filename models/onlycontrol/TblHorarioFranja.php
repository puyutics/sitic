<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_HORARIOFRANJA".
 *
 * @property string $ID_HORA
 * @property string $ID_FRANJA
 * @property string $HORA_INI
 * @property string $HORA_FIN
 * @property string $TIPO_MARCA
 * @property string $FECHA_CREA
 */
class TblHorarioFranja extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_HORARIOFRANJA';
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
            [['ID_FRANJA', 'HORA_INI', 'HORA_FIN', 'TIPO_MARCA'], 'required'],
            [['ID_FRANJA'], 'number'],
            [['HORA_INI', 'HORA_FIN', 'FECHA_CREA'], 'safe'],
            [['TIPO_MARCA'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_HORA' => 'Id Hora',
            'ID_FRANJA' => 'Id Franja',
            'HORA_INI' => 'Hora Ini',
            'HORA_FIN' => 'Hora Fin',
            'TIPO_MARCA' => 'Tipo Marca',
            'FECHA_CREA' => 'Fecha Crea',
        ];
    }
}
