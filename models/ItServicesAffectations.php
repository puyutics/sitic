<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_services_affectations".
 *
 * @property int $id ID AFECTACION
 * @property int $it_services_id ID SERVICIO
 * @property int $it_incidents_reports_id ID INCIDENTE
 * @property string $description DETALLE
 * @property int $affected_users USUARIOS AFECTADOS
 * @property int $affected_time TIEMPO MINUTOS
 * @property int $type TIPO AFECTACION
 * @property int $status ESTADO
 *
 * @property ItIncidentsReports $itIncidentsReports
 * @property ItServices $itServices
 */
class ItServicesAffectations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_services_affectations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['it_services_id', 'it_incidents_reports_id', 'description', 'affected_users', 'affected_time', 'type', 'status'], 'required'],
            [['it_services_id', 'it_incidents_reports_id', 'affected_users', 'affected_time', 'type', 'status'], 'integer'],
            [['description'], 'string'],
            [['it_incidents_reports_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItIncidentsReports::className(), 'targetAttribute' => ['it_incidents_reports_id' => 'id']],
            [['it_services_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItServices::className(), 'targetAttribute' => ['it_services_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID AFECTACION'),
            'it_services_id' => Yii::t('app', 'ID SERVICIO'),
            'it_incidents_reports_id' => Yii::t('app', 'ID INCIDENTE'),
            'description' => Yii::t('app', 'DETALLE'),
            'affected_users' => Yii::t('app', 'USUARIOS AFECTADOS'),
            'affected_time' => Yii::t('app', 'TIEMPO MINUTOS'),
            'type' => Yii::t('app', 'TIPO AFECTACION'),
            'status' => Yii::t('app', 'ESTADO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItIncidentsReports()
    {
        return $this->hasOne(ItIncidentsReports::className(), ['id' => 'it_incidents_reports_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItServices()
    {
        return $this->hasOne(ItServices::className(), ['id' => 'it_services_id']);
    }
}
