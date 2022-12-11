<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_APP_LOGS".
 *
 * @property int $ID_LOG
 * @property string $FUNCION
 * @property string $CLASE
 * @property string $LOG_ERROR
 * @property string $FECHA_GENERACION
 * @property string $FECHA_SINCRONIZACION
 * @property string $SERIE_EQUIPO
 */
class TblAppLogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_APP_LOGS';
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
            [['FUNCION', 'CLASE', 'LOG_ERROR', 'FECHA_GENERACION'], 'required'],
            [['FECHA_GENERACION', 'FECHA_SINCRONIZACION'], 'safe'],
            [['FUNCION', 'SERIE_EQUIPO'], 'string', 'max' => 100],
            [['CLASE'], 'string', 'max' => 50],
            [['LOG_ERROR'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_LOG' => 'Id Log',
            'FUNCION' => 'Funcion',
            'CLASE' => 'Clase',
            'LOG_ERROR' => 'Log Error',
            'FECHA_GENERACION' => 'Fecha Generacion',
            'FECHA_SINCRONIZACION' => 'Fecha Sincronizacion',
            'SERIE_EQUIPO' => 'Serie Equipo',
        ];
    }
}
