<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_HandHeldHuellas".
 *
 * @property string $ID
 * @property resource $HUELLA1
 * @property resource $HUELLA2
 * @property string $NOW
 */
class AcHandheldhuellas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_HandHeldHuellas';
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
            [['ID'], 'required'],
            [['HUELLA1', 'HUELLA2'], 'string'],
            [['NOW'], 'safe'],
            [['ID'], 'string', 'max' => 12],
            [['ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'HUELLA1' => 'Huella1',
            'HUELLA2' => 'Huella2',
            'NOW' => 'Now',
        ];
    }
}
