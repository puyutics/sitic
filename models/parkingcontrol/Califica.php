<?php

namespace app\models\parkingcontrol;

use Yii;

/**
 * This is the model class for table "CALIFICA".
 *
 * @property string $CALI_ID
 * @property string $CALI_NOM
 * @property string $CALI_DES
 * @property int $CALI_SYNC
 * @property int $CALI_SYNCID
 * @property int $CALI_ORIGEN
 *
 * @property ACNOMINA[] $aCNOMINAs
 * @property NOMINA[] $nOMINAs
 */
class CALIFICA extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CALIFICA';
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
            [['CALI_NOM'], 'required'],
            [['CALI_SYNC', 'CALI_SYNCID', 'CALI_ORIGEN'], 'integer'],
            [['CALI_NOM'], 'string', 'max' => 100],
            [['CALI_DES'], 'string', 'max' => 30],
            [['CALI_NOM'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CALI_ID' => 'Cali ID',
            'CALI_NOM' => 'Cali Nom',
            'CALI_DES' => 'Cali Des',
            'CALI_SYNC' => 'Cali Sync',
            'CALI_SYNCID' => 'Cali Syncid',
            'CALI_ORIGEN' => 'Cali Origen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getACNOMINAs()
    {
        return $this->hasMany(ACNOMINA::className(), ['NOMINA_CARGO' => 'CALI_ID', 'NOMINA_CARGOC' => 'CALI_NOM']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOMINAs()
    {
        return $this->hasMany(NOMINA::className(), ['NOMINA_CAL' => 'CALI_ID', 'NOMINA_CAL1' => 'CALI_NOM']);
    }
}
