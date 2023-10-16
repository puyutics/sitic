<?php

namespace app\models\parkingcontrol;

use Yii;

/**
 * This is the model class for table "AREA".
 *
 * @property string $AREA_ID
 * @property string $AREA_NOM
 * @property string $AREA_DES
 * @property string $AREA_OBS
 * @property string $AREA_EM
 * @property string $AREA_SEL
 * @property int $AREA_SYNC
 * @property int $AREA_SYNCID
 * @property int $AREA_ORIGEN
 *
 * @property ACPUERTA[] $aCPUERTAs
 * @property NOMINA[] $nOMINAs
 * @property PUERTA[] $pUERTAs
 */
class AREA extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AREA';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_parkingcontrol');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AREA_NOM'], 'required'],
            [['AREA_SYNC', 'AREA_SYNCID', 'AREA_ORIGEN'], 'integer'],
            [['AREA_NOM', 'AREA_SEL'], 'string', 'max' => 100],
            [['AREA_DES'], 'string', 'max' => 40],
            [['AREA_OBS', 'AREA_EM'], 'string', 'max' => 50],
            [['AREA_NOM'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AREA_ID' => 'Area ID',
            'AREA_NOM' => 'Area Nom',
            'AREA_DES' => 'Area Des',
            'AREA_OBS' => 'Area Obs',
            'AREA_EM' => 'Area Em',
            'AREA_SEL' => 'Area Sel',
            'AREA_SYNC' => 'Area Sync',
            'AREA_SYNCID' => 'Area Syncid',
            'AREA_ORIGEN' => 'Area Origen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getACPUERTAs()
    {
        return $this->hasMany(ACPUERTA::className(), ['PRI_AREA' => 'AREA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOMINAs()
    {
        return $this->hasMany(NOMINA::className(), ['NOMINA_AREA' => 'AREA_ID', 'NOMINA_AREA1' => 'AREA_NOM']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPUERTAs()
    {
        return $this->hasMany(PUERTA::className(), ['PRI_AREA' => 'AREA_ID']);
    }
}
