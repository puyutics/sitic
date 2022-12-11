<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "Apbmaster".
 *
 * @property string $APB_ID
 * @property int $NOMINA_CONTROLAPB1
 * @property int $NOMINA_STATUSAPB1
 */
class Apbmaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Apbmaster';
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
            [['APB_ID'], 'required'],
            [['NOMINA_CONTROLAPB1', 'NOMINA_STATUSAPB1'], 'integer'],
            [['APB_ID'], 'string', 'max' => 6],
            [['APB_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'APB_ID' => 'Apb ID',
            'NOMINA_CONTROLAPB1' => 'Nomina Controlapb1',
            'NOMINA_STATUSAPB1' => 'Nomina Statusapb1',
        ];
    }
}
