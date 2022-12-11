<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "CC_ASIST".
 *
 * @property string $C_NOW
 * @property string $C_USER
 * @property string $C_ZONA
 * @property string $C_TIPO
 * @property string $C_CCCOD
 * @property string $C_CCNOM
 */
class CcAsist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CC_ASIST';
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
            [['C_NOW', 'C_USER', 'C_ZONA', 'C_TIPO', 'C_CCCOD', 'C_CCNOM'], 'required'],
            [['C_NOW'], 'safe'],
            [['C_USER', 'C_TIPO', 'C_CCCOD'], 'string', 'max' => 10],
            [['C_ZONA'], 'string', 'max' => 20],
            [['C_CCNOM'], 'string', 'max' => 50],
            [['C_CCCOD', 'C_NOW', 'C_TIPO', 'C_USER', 'C_ZONA'], 'unique', 'targetAttribute' => ['C_CCCOD', 'C_NOW', 'C_TIPO', 'C_USER', 'C_ZONA']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'C_NOW' => 'C Now',
            'C_USER' => 'C User',
            'C_ZONA' => 'C Zona',
            'C_TIPO' => 'C Tipo',
            'C_CCCOD' => 'C Cccod',
            'C_CCNOM' => 'C Ccnom',
        ];
    }
}
