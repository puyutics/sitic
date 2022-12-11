<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "FC_TAG_CONTROL".
 *
 * @property int $TG_ID
 * @property string $TG_NUM_PRINT Numero Impreso en el TAG
 * @property string $TG_NUM_RF Numero Interno del TAG
 * @property string $TG_NOW Fecha de Ingreso
 * @property string $TG_ESTADO 0 No Utilizado, 1 En Operacion
 */
class FcTagControl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'FC_TAG_CONTROL';
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
            [['TG_NOW'], 'safe'],
            [['TG_NUM_PRINT', 'TG_NUM_RF'], 'string', 'max' => 10],
            [['TG_ESTADO'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TG_ID' => 'Tg ID',
            'TG_NUM_PRINT' => 'Numero Impreso en el TAG',
            'TG_NUM_RF' => 'Numero Interno del TAG',
            'TG_NOW' => 'Fecha de Ingreso',
            'TG_ESTADO' => '0 No Utilizado, 1 En Operacion',
        ];
    }
}
