<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "phones_logs".
 *
 * @property int $id ID LLAMADA
 * @property string $date FECHA LLAMADA
 * @property string $source ORIGEN LLAMADA
 * @property string $destination DESTINO LLAMADA
 * @property string $src_channel CANAL ORIGEN
 * @property string $dst_channel CANAL DESTINO
 * @property string $status ESTADO LLAMADA
 * @property int $time TIEMPO DURACION LLAMADA
 */
class PhonesLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phones_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'time'], 'integer'],
            [['date'], 'safe'],
            [['source', 'destination', 'src_channel', 'dst_channel', 'status'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID LLAMADA'),
            'date' => Yii::t('app', 'FECHA LLAMADA'),
            'source' => Yii::t('app', 'ORIGEN LLAMADA'),
            'destination' => Yii::t('app', 'DESTINO LLAMADA'),
            'src_channel' => Yii::t('app', 'CANAL ORIGEN'),
            'dst_channel' => Yii::t('app', 'CANAL DESTINO'),
            'status' => Yii::t('app', 'ESTADO LLAMADA'),
            'time' => Yii::t('app', 'DURACION (S)'),
        ];
    }
}
