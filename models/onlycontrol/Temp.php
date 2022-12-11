<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TEMP".
 *
 * @property string $TMP_COD
 * @property string $TMP_PRUEBA
 */
class Temp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TEMP';
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
            [['TMP_COD'], 'required'],
            [['TMP_COD', 'TMP_PRUEBA'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TMP_COD' => 'Tmp Cod',
            'TMP_PRUEBA' => 'Tmp Prueba',
        ];
    }
}
