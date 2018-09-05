<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_incidents_reports".
 *
 * @property int $id ID INCIDENTE
 * @property string $subject ASUNTO
 * @property string $issue DETALLE PROBLEMA
 * @property string $date_reported FECHA REPORTE
 * @property string $date_solved FECHA SOLUCION
 * @property int $status ESTADO
 *
 * @property ItIncidentsReportsUser[] $itIncidentsReportsUsers
 * @property ItServicesAffectations[] $itServicesAffectations
 */
class ItIncidentsReports extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_incidents_reports';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject', 'issue', 'date_reported', 'status'], 'required'],
            [['issue'], 'string'],
            [['date_reported', 'date_solved'], 'safe'],
            [['status'], 'integer'],
            [['subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID INCIDENTE'),
            'subject' => Yii::t('app', 'ASUNTO'),
            'issue' => Yii::t('app', 'DETALLE PROBLEMA'),
            'date_reported' => Yii::t('app', 'FECHA REPORTE'),
            'date_solved' => Yii::t('app', 'FECHA SOLUCION'),
            'status' => Yii::t('app', 'ESTADO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItIncidentsReportsUsers()
    {
        return $this->hasMany(ItIncidentsReportsUser::className(), ['it_incidents_reports_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItServicesAffectations()
    {
        return $this->hasMany(ItServicesAffectations::className(), ['it_incidents_reports_id' => 'id']);
    }
}
