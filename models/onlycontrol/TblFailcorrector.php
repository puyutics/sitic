<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_FAILCORRECTOR".
 *
 * @property string $FC_MARCA
 * @property string $FC_IDEMP
 * @property string $FC_TIPO
 * @property string $FC_PROCESO
 * @property string $FC_FRANJA
 * @property string $FC_MOD
 * @property string $FC_HOR
 * @property string $FC_DETALLE
 * @property string $FC_FPROCESA
 */
class TblFailcorrector extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_FAILCORRECTOR';
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
            [['FC_MARCA', 'FC_IDEMP', 'FC_TIPO', 'FC_PROCESO'], 'required'],
            [['FC_MARCA', 'FC_FPROCESA'], 'safe'],
            [['FC_FRANJA', 'FC_MOD', 'FC_HOR'], 'number'],
            [['FC_IDEMP'], 'string', 'max' => 6],
            [['FC_TIPO'], 'string', 'max' => 10],
            [['FC_PROCESO'], 'string', 'max' => 20],
            [['FC_DETALLE'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FC_MARCA' => 'Fc Marca',
            'FC_IDEMP' => 'Fc Idemp',
            'FC_TIPO' => 'Fc Tipo',
            'FC_PROCESO' => 'Fc Proceso',
            'FC_FRANJA' => 'Fc Franja',
            'FC_MOD' => 'Fc Mod',
            'FC_HOR' => 'Fc Hor',
            'FC_DETALLE' => 'Fc Detalle',
            'FC_FPROCESA' => 'Fc Fprocesa',
        ];
    }
}
