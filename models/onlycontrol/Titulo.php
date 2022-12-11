<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TITULO".
 *
 * @property string $TIT_LINEA1
 * @property string $TIT_LINEA2
 * @property string $TIT_LINEA3
 * @property resource $TIT_LOGO1
 * @property resource $TIT_LOGO2
 * @property string $TIT_RUTA
 * @property string $TIT_UCOD
 */
class Titulo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TITULO';
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
            [['TIT_LOGO1', 'TIT_LOGO2'], 'string'],
            [['TIT_LINEA1', 'TIT_LINEA2', 'TIT_LINEA3', 'TIT_RUTA', 'TIT_UCOD'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TIT_LINEA1' => 'Tit Linea1',
            'TIT_LINEA2' => 'Tit Linea2',
            'TIT_LINEA3' => 'Tit Linea3',
            'TIT_LOGO1' => 'Tit Logo1',
            'TIT_LOGO2' => 'Tit Logo2',
            'TIT_RUTA' => 'Tit Ruta',
            'TIT_UCOD' => 'Tit Ucod',
        ];
    }
}
