<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "logs".
 *
 * @property int $id ID
 * @property string $type TIPO
 * @property string $username USUARIO
 * @property string $datetime FECHA
 * @property string $description DETALLE
 * @property string $ipaddress IP
 * @property string $external_id ID EXTERNO
 * @property string $external_type TIPO
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'username', 'datetime', 'description'], 'required'],
            [['datetime'], 'safe'],
            [['description'], 'string'],
            [['type', 'username', 'ipaddress', 'external_id', 'external_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'TIPO'),
            'username' => Yii::t('app', 'USUARIO'),
            'datetime' => Yii::t('app', 'FECHA'),
            'description' => Yii::t('app', 'DETALLE'),
            'ipaddress' => Yii::t('app', 'IP'),
            'external_id' => Yii::t('app', 'ID EXTERNO'),
            'external_type' => Yii::t('app', 'TIPO'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return LogsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LogsQuery(get_called_class());
    }
}
