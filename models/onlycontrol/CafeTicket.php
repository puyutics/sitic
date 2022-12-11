<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "CAFE_TICKET".
 *
 * @property string $FECHA_TICKET
 * @property int $NUM_TICKET
 */
class CafeTicket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CAFE_TICKET';
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
            [['FECHA_TICKET'], 'required'],
            [['FECHA_TICKET'], 'safe'],
            [['NUM_TICKET'], 'integer'],
            [['FECHA_TICKET'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FECHA_TICKET' => 'Fecha Ticket',
            'NUM_TICKET' => 'Num Ticket',
        ];
    }
}
