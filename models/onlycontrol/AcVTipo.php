<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_V_TIPO".
 *
 * @property string $VT_NOM
 * @property string $VT_DES
 * @property string $VT_FCREA
 * @property string $VT_UCREA
 *
 * @property AcVehiculos[] $acVehiculos
 */
class AcVTipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_V_TIPO';
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
            [['VT_NOM'], 'required'],
            [['VT_FCREA'], 'safe'],
            [['VT_NOM'], 'string', 'max' => 25],
            [['VT_DES'], 'string', 'max' => 50],
            [['VT_UCREA'], 'string', 'max' => 10],
            [['VT_NOM'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'VT_NOM' => 'Vt Nom',
            'VT_DES' => 'Vt Des',
            'VT_FCREA' => 'Vt Fcrea',
            'VT_UCREA' => 'Vt Ucrea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcVehiculos()
    {
        return $this->hasMany(AcVehiculos::className(), ['VE_TIPO' => 'VT_NOM']);
    }
}
