<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_AREA".
 *
 * @property string $AREA_ID
 * @property string $AREA_NOM
 * @property string $AREA_DES
 * @property string $AREA_FCREA
 * @property string $AREA_UCREA
 */
class AcArea extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_AREA';
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
            [['AREA_FCREA'], 'safe'],
            [['AREA_NOM', 'AREA_DES'], 'string', 'max' => 100],
            [['AREA_UCREA'], 'string', 'max' => 10],
            [['AREA_NOM'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AREA_ID' => 'Area ID',
            'AREA_NOM' => 'Area Nom',
            'AREA_DES' => 'Area Des',
            'AREA_FCREA' => 'Area Fcrea',
            'AREA_UCREA' => 'Area Ucrea',
        ];
    }
}
