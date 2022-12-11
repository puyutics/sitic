<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_V_MARCA".
 *
 * @property string $VM_MARCA
 * @property string $VM_DES
 * @property string $VM_FCREA
 * @property string $VM_UCREA
 *
 * @property AcVModelo[] $acVModelos
 */
class AcVMarca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_V_MARCA';
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
            [['VM_MARCA'], 'required'],
            [['VM_FCREA'], 'safe'],
            [['VM_MARCA'], 'string', 'max' => 25],
            [['VM_DES'], 'string', 'max' => 50],
            [['VM_UCREA'], 'string', 'max' => 10],
            [['VM_MARCA'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'VM_MARCA' => 'Vm Marca',
            'VM_DES' => 'Vm Des',
            'VM_FCREA' => 'Vm Fcrea',
            'VM_UCREA' => 'Vm Ucrea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcVModelos()
    {
        return $this->hasMany(AcVModelo::className(), ['VMO_MARCA' => 'VM_MARCA']);
    }
}
