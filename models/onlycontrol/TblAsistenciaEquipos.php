<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_ASISTENCIA_EQUIPOS".
 *
 * @property string $AE_ID
 * @property string $AE_IP
 * @property string $AE_CALIFICA
 * @property string $AE_ESTADO
 */
class TblAsistenciaEquipos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_ASISTENCIA_EQUIPOS';
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
            [['AE_ID'], 'required'],
            [['AE_ESTADO'], 'number'],
            [['AE_ID'], 'string', 'max' => 8],
            [['AE_IP'], 'string', 'max' => 32],
            [['AE_CALIFICA'], 'string', 'max' => 7],
            [['AE_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AE_ID' => 'Ae ID',
            'AE_IP' => 'Ae Ip',
            'AE_CALIFICA' => 'Ae Califica',
            'AE_ESTADO' => 'Ae Estado',
        ];
    }
}
