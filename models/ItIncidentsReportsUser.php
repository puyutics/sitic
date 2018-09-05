<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%it_incidents_reports_user}}".
 *
 * @property int $id
 * @property int $it_incidents_reports_id ID REPORTE INCIDENTE
 * @property string $username USUARIO
 * @property string $description DETALLE
 * @property string $date_assigned FECHA ASIGNACION
 * @property string $date_released FECHA CIERRE
 * @property int $status ESTADO
 *
 * @property User $username0
 * @property ItIncidentsReports $itIncidentsReports
 */
class ItIncidentsReportsUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%it_incidents_reports_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['it_incidents_reports_id', 'username', 'description', 'date_assigned', 'status'], 'required'],
            [['it_incidents_reports_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['date_assigned', 'date_released'], 'safe'],
            [['username'], 'string', 'max' => 255],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'username']],
            [['it_incidents_reports_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItIncidentsReports::className(), 'targetAttribute' => ['it_incidents_reports_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'it_incidents_reports_id' => Yii::t('app', 'ID REPORTE INCIDENTE'),
            'username' => Yii::t('app', 'USUARIO'),
            'description' => Yii::t('app', 'DETALLE'),
            'date_assigned' => Yii::t('app', 'FECHA ASIGNACION'),
            'date_released' => Yii::t('app', 'FECHA CIERRE'),
            'status' => Yii::t('app', 'ESTADO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(User::className(), ['username' => 'username']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItIncidentsReports()
    {
        return $this->hasOne(ItIncidentsReports::className(), ['id' => 'it_incidents_reports_id']);
    }
}
