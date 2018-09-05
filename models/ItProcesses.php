<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_processes".
 *
 * @property int $id ID PROCESO
 * @property string $process NOMBRE PROCESO
 * @property string $description DETALLE PROCESO
 * @property string $metrics METRICA EVALUACION
 * @property string $date_creation FECHA CREACION
 * @property string $date_closed FECHA CIERRE
 * @property int $magnitude IMPORTANCIA
 * @property int $status ESTADO
 *
 * @property ItProcessesProjects[] $itProcessesProjects
 * @property ItProcessesServices[] $itProcessesServices
 * @property ItProcessesUser[] $itProcessesUsers
 */
class ItProcesses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_processes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['process', 'description', 'metrics', 'date_creation', 'magnitude', 'status'], 'required'],
            [['description', 'metrics'], 'string'],
            [['date_creation', 'date_closed'], 'safe'],
            [['magnitude', 'status'], 'integer'],
            [['process'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID PROCESO'),
            'process' => Yii::t('app', 'NOMBRE PROCESO'),
            'description' => Yii::t('app', 'DETALLE PROCESO'),
            'metrics' => Yii::t('app', 'METRICA EVALUACION'),
            'date_creation' => Yii::t('app', 'FECHA CREACION'),
            'date_closed' => Yii::t('app', 'FECHA CIERRE'),
            'magnitude' => Yii::t('app', 'IMPORTANCIA'),
            'status' => Yii::t('app', 'ESTADO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProcessesProjects()
    {
        return $this->hasMany(ItProcessesProjects::className(), ['it_processes_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProcessesServices()
    {
        return $this->hasMany(ItProcessesServices::className(), ['it_processes_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProcessesUsers()
    {
        return $this->hasMany(ItProcessesUser::className(), ['it_processes_id' => 'id']);
    }
}
