<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AUX_NOMINA".
 *
 * @property string $ANOM_ID
 * @property string $ANOM_APE
 * @property string $ANOM_NOM
 * @property string $ANOM_CED
 * @property string $ANOM_EMP
 * @property string $ANOM_AREA
 * @property string $ANOM_DPTO
 * @property string $ANOM_CAR
 * @property string $ANOM_FECN
 * @property string $ANOM_OBS
 * @property int $ANOM_TIPO
 */
class AuxNomina extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AUX_NOMINA';
    }

    public static function primaryKey()
    {
        return ['ANOM_ID'];
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
            [['ANOM_FECN'], 'safe'],
            [['ANOM_TIPO'], 'integer'],
            [['ANOM_ID'], 'string', 'max' => 6],
            [['ANOM_APE', 'ANOM_EMP', 'ANOM_AREA', 'ANOM_DPTO', 'ANOM_CAR', 'ANOM_OBS'], 'string', 'max' => 100],
            [['ANOM_NOM'], 'string', 'max' => 50],
            [['ANOM_CED'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ANOM_ID' => 'Anom ID',
            'ANOM_APE' => 'Anom Ape',
            'ANOM_NOM' => 'Anom Nom',
            'ANOM_CED' => 'Anom Ced',
            'ANOM_EMP' => 'Anom Emp',
            'ANOM_AREA' => 'Anom Area',
            'ANOM_DPTO' => 'Anom Dpto',
            'ANOM_CAR' => 'Anom Car',
            'ANOM_FECN' => 'Anom Fecn',
            'ANOM_OBS' => 'Anom Obs',
            'ANOM_TIPO' => 'Anom Tipo',
        ];
    }
}
