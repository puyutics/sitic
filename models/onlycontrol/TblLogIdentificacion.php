<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_LOG_IDENTIFICACION".
 *
 * @property int $ID_LOG
 * @property string $SERIE_EQUIPO
 * @property string $NOMINA_ID
 * @property string $SCORE
 * @property string $FECHA_GENERACION
 * @property string $FECHA_SINCRONIZACION
 */
class TblLogIdentificacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_LOG_IDENTIFICACION';
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
            [['SERIE_EQUIPO', 'NOMINA_ID', 'SCORE', 'FECHA_GENERACION'], 'required'],
            [['FECHA_GENERACION', 'FECHA_SINCRONIZACION'], 'safe'],
            [['SERIE_EQUIPO', 'SCORE'], 'string', 'max' => 100],
            [['NOMINA_ID'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_LOG' => 'Id Log',
            'SERIE_EQUIPO' => 'Serie Equipo',
            'NOMINA_ID' => 'Nomina ID',
            'SCORE' => 'Score',
            'FECHA_GENERACION' => 'Fecha Generacion',
            'FECHA_SINCRONIZACION' => 'Fecha Sincronizacion',
        ];
    }
}
