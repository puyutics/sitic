<?php

namespace app\models\onlycontrol;

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
 *
 * @property AcPuerta[] $acPuertas
 * @property Nomina[] $nominas
 * @property Puerta[] $puertas
 */
class Area extends \yii\db\ActiveRecord
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
        return Yii::$app->get('db_onlycontrol');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AREA_NOM'], 'required'],
            [['AREA_NOM'], 'string', 'max' => 100],
            [['AREA_DES'], 'string', 'max' => 40],
            [['AREA_OBS', 'AREA_EM'], 'string', 'max' => 50],
            [['AREA_SEL'], 'string', 'max' => 1],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcPuertas()
    {
        return $this->hasMany(AcPuerta::className(), ['PRI_AREA' => 'AREA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNominas()
    {
        return $this->hasMany(Nomina::className(), ['NOMINA_AREA' => 'AREA_ID', 'NOMINA_AREA1' => 'AREA_NOM']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPuertas()
    {
        return $this->hasMany(Puerta::className(), ['PRI_AREA' => 'AREA_ID']);
    }
}
