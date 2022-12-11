<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_V_MODELO".
 *
 * @property string $VMO_MODELO
 * @property string $VMO_MARCA
 * @property string $VMO_FCREA
 * @property string $VMO_UCREA
 *
 * @property AcVMarca $vMOMARCA
 * @property AcVehiculos[] $acVehiculos
 */
class AcVModelo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_V_MODELO';
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
            [['VMO_MODELO', 'VMO_MARCA'], 'required'],
            [['VMO_FCREA'], 'safe'],
            [['VMO_MODELO', 'VMO_MARCA'], 'string', 'max' => 25],
            [['VMO_UCREA'], 'string', 'max' => 10],
            [['VMO_MARCA', 'VMO_MODELO'], 'unique', 'targetAttribute' => ['VMO_MARCA', 'VMO_MODELO']],
            [['VMO_MARCA'], 'exist', 'skipOnError' => true, 'targetClass' => AcVMarca::className(), 'targetAttribute' => ['VMO_MARCA' => 'VM_MARCA']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'VMO_MODELO' => 'Vmo Modelo',
            'VMO_MARCA' => 'Vmo Marca',
            'VMO_FCREA' => 'Vmo Fcrea',
            'VMO_UCREA' => 'Vmo Ucrea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVMOMARCA()
    {
        return $this->hasOne(AcVMarca::className(), ['VM_MARCA' => 'VMO_MARCA']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcVehiculos()
    {
        return $this->hasMany(AcVehiculos::className(), ['VE_MARCA' => 'VMO_MARCA', 'VE_MODELO' => 'VMO_MODELO']);
    }
}
