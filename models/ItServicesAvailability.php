<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_services_availability".
 *
 * @property int $id ID DISPONIBILIDAD
 * @property int $it_services_id
 * @property string $description DETALLE
 * @property string $date_start FECHA INICIO
 * @property string $date_end FECHA FIN
 * @property int $availability_time TIEMPO MINUTOS
 * @property int $status ESTADO
 *
 * @property ItServices $itServices
 */
class ItServicesAvailability extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_services_availability';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['it_services_id', 'description', 'date_start', 'date_end', 'availability_time', 'status'], 'required'],
            [['it_services_id', 'availability_time', 'status'], 'integer'],
            [['description'], 'string'],
            [['date_start', 'date_end'], 'safe'],
            [['it_services_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItServices::className(), 'targetAttribute' => ['it_services_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID DISPONIBILIDAD'),
            'it_services_id' => Yii::t('app', 'It Services ID'),
            'description' => Yii::t('app', 'DETALLE'),
            'date_start' => Yii::t('app', 'FECHA INICIO'),
            'date_end' => Yii::t('app', 'FECHA FIN'),
            'availability_time' => Yii::t('app', 'TIEMPO MINUTOS'),
            'status' => Yii::t('app', 'ESTADO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItServices()
    {
        return $this->hasOne(ItServices::className(), ['id' => 'it_services_id']);
    }
}
