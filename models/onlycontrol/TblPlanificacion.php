<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_PLANIFICACION".
 *
 * @property string $PL_Fecha
 * @property int $PL_Cantidad
 * @property string $PL_Tipo_Comida
 * @property string $PL_Tipo_Menu
 * @property string $PL_Area
 * @property string $PL_Observacion
 * @property string $PL_TIPO_PLANIFICACION
 */
class TblPlanificacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_PLANIFICACION';
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
            [['PL_Fecha', 'PL_Cantidad', 'PL_Tipo_Comida', 'PL_Tipo_Menu', 'PL_Area'], 'required'],
            [['PL_Fecha'], 'safe'],
            [['PL_Cantidad'], 'integer'],
            [['PL_Tipo_Comida', 'PL_Tipo_Menu'], 'string', 'max' => 20],
            [['PL_Area', 'PL_TIPO_PLANIFICACION'], 'string', 'max' => 10],
            [['PL_Observacion'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PL_Fecha' => 'Pl Fecha',
            'PL_Cantidad' => 'Pl Cantidad',
            'PL_Tipo_Comida' => 'Pl Tipo Comida',
            'PL_Tipo_Menu' => 'Pl Tipo Menu',
            'PL_Area' => 'Pl Area',
            'PL_Observacion' => 'Pl Observacion',
            'PL_TIPO_PLANIFICACION' => 'Pl Tipo Planificacion',
        ];
    }
}
