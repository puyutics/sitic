<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "PUERTA_ENROLL".
 *
 * @property int $PE_ID
 * @property string $PE_IPCLIENTE
 * @property string $PE_DESCRIPCION
 * @property string $PE_IP_PUERTA
 * @property string $PE_PUERTO
 */
class PuertaEnroll extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PUERTA_ENROLL';
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
            [['PE_IPCLIENTE', 'PE_IP_PUERTA'], 'string', 'max' => 20],
            [['PE_DESCRIPCION'], 'string', 'max' => 200],
            [['PE_PUERTO'], 'string', 'max' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PE_ID' => 'Pe ID',
            'PE_IPCLIENTE' => 'Pe Ipcliente',
            'PE_DESCRIPCION' => 'Pe Descripcion',
            'PE_IP_PUERTA' => 'Pe Ip Puerta',
            'PE_PUERTO' => 'Pe Puerto',
        ];
    }
}
