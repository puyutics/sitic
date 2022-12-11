<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "CALIFICA".
 *
 * @property string $CALI_ID
 * @property string $CALI_NOM
 * @property string $CALI_DES
 *
 * @property AcNomina[] $acNominas
 * @property Nomina[] $nominas
 */
class Califica extends \yii\db\ActiveRecord
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
        return Yii::$app->get('db_onlycontrol');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['CALI_NOM'], 'required'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcNominas()
    {
        return $this->hasMany(AcNomina::className(), ['NOMINA_CARGO' => 'CALI_ID', 'NOMINA_CARGOC' => 'CALI_NOM']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNominas()
    {
        return $this->hasMany(Nomina::className(), ['NOMINA_CAL' => 'CALI_ID', 'NOMINA_CAL1' => 'CALI_NOM']);
    }
}
