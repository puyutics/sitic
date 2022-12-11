<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "CAFE_POSICION_DATOS".
 *
 * @property string $CAFE_DATOS
 * @property string $CAFE_POSICIONX
 * @property string $CAFE_POSICIONY
 * @property string $CAFE_ESTADO
 */
class CafePosicionDatos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CAFE_POSICION_DATOS';
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
            [['CAFE_POSICIONX', 'CAFE_POSICIONY'], 'number'],
            [['CAFE_DATOS'], 'string', 'max' => 50],
            [['CAFE_ESTADO'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CAFE_DATOS' => 'Cafe Datos',
            'CAFE_POSICIONX' => 'Cafe Posicionx',
            'CAFE_POSICIONY' => 'Cafe Posiciony',
            'CAFE_ESTADO' => 'Cafe Estado',
        ];
    }
}
