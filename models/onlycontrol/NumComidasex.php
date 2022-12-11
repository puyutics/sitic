<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "NUM_COMIDASEX".
 *
 * @property string $NOMINA_ID
 * @property int $TOT_COMIDA
 */
class NumComidasex extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NUM_COMIDASEX';
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
            [['NOMINA_ID', 'TOT_COMIDA'], 'required'],
            [['TOT_COMIDA'], 'integer'],
            [['NOMINA_ID'], 'string', 'max' => 6],
            [['NOMINA_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NOMINA_ID' => 'Nomina ID',
            'TOT_COMIDA' => 'Tot Comida',
        ];
    }
}
