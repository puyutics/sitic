<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_AUD_CORRECTOR".
 *
 * @property string $AUC_OPCION
 * @property string $AUC_ACCION
 * @property string $AUC_DETALLE
 * @property string $AUC_IP
 * @property string $AUC_HOST
 * @property string $AUC_FECHA
 */
class TblAudCorrector extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_AUD_CORRECTOR';
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
            [['AUC_OPCION', 'AUC_ACCION', 'AUC_DETALLE'], 'required'],
            [['AUC_FECHA'], 'safe'],
            [['AUC_OPCION', 'AUC_HOST'], 'string', 'max' => 100],
            [['AUC_ACCION'], 'string', 'max' => 20],
            [['AUC_DETALLE'], 'string', 'max' => 300],
            [['AUC_IP'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AUC_OPCION' => 'Auc Opcion',
            'AUC_ACCION' => 'Auc Accion',
            'AUC_DETALLE' => 'Auc Detalle',
            'AUC_IP' => 'Auc Ip',
            'AUC_HOST' => 'Auc Host',
            'AUC_FECHA' => 'Auc Fecha',
        ];
    }
}
