<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_LOG_WS".
 *
 * @property int $ID_LOG_WS
 * @property string $LOG_FUNCION
 * @property string $LOG_DETALLE
 * @property string $LOG_FECHA
 */
class TblLogWs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_LOG_WS';
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
            [['LOG_FUNCION', 'LOG_DETALLE'], 'required'],
            [['LOG_FECHA'], 'safe'],
            [['LOG_FUNCION'], 'string', 'max' => 200],
            [['LOG_DETALLE'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_LOG_WS' => 'Id Log Ws',
            'LOG_FUNCION' => 'Log Funcion',
            'LOG_DETALLE' => 'Log Detalle',
            'LOG_FECHA' => 'Log Fecha',
        ];
    }
}
