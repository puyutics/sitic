<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_services".
 *
 * @property int $id ID SERVICIO
 * @property string $service NOMBRE SERVICIO
 * @property string $description DESCRIPCION SERVICIO
 * @property string $type TIPO SERVICIO
 * @property string $date_renovation FECHA RENOVACION
 * @property string $date_creation FECHA CREACION
 * @property string $date_closed FECHA CULMINACION
 * @property string $stakeholders BENEFICIARIOS
 * @property int $magnitude IMPORTANCIA DEL SERVICIO
 * @property int $status ESTADO PROCESO
 *
 * @property ItProjectsServices[] $itProjectsServices
 * @property ItServicesAffectations[] $itServicesAffectations
 * @property ItServicesAvailability[] $itServicesAvailabilities
 * @property ItServicesResult[] $itServicesResults
 * @property ItServicesUser[] $itServicesUsers
 */
class ItServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['service', 'description', 'type', 'date_creation', 'stakeholders', 'magnitude', 'status'], 'required'],
            [['description'], 'string'],
            [['date_renovation', 'date_creation', 'date_closed'], 'safe'],
            [['magnitude', 'status'], 'integer'],
            [['service', 'type', 'stakeholders'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID SERVICIO'),
            'service' => Yii::t('app', 'NOMBRE SERVICIO'),
            'description' => Yii::t('app', 'DESCRIPCION SERVICIO'),
            'type' => Yii::t('app', 'TIPO SERVICIO'),
            'date_renovation' => Yii::t('app', 'FECHA RENOVACION'),
            'date_creation' => Yii::t('app', 'FECHA CREACION'),
            'date_closed' => Yii::t('app', 'FECHA CULMINACION'),
            'stakeholders' => Yii::t('app', 'BENEFICIARIOS'),
            'magnitude' => Yii::t('app', 'IMPORTANCIA DEL SERVICIO'),
            'status' => Yii::t('app', 'ESTADO PROCESO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProjectsServices()
    {
        return $this->hasMany(ItProjectsServices::className(), ['it_services_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItServicesAffectations()
    {
        return $this->hasMany(ItServicesAffectations::className(), ['it_services_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItServicesAvailabilities()
    {
        return $this->hasMany(ItServicesAvailability::className(), ['it_services_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItServicesResults()
    {
        return $this->hasMany(ItServicesResult::className(), ['it_services_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItServicesUsers()
    {
        return $this->hasMany(ItServicesUser::className(), ['it_services_id' => 'id']);
    }
}
