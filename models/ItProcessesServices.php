<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_processes_services".
 *
 * @property int $id ID RELACION
 * @property int $it_processes_id ID PROCESO
 * @property int $it_services_id ID SERVICIO
 * @property int $status ESTADO
 *
 * @property ItProcesses $itProcesses
 * @property ItServices $itServices
 */
class ItProcessesServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_processes_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['it_processes_id', 'it_services_id', 'status'], 'required'],
            [['it_processes_id', 'it_services_id', 'status'], 'integer'],
            [['it_processes_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItProcesses::className(), 'targetAttribute' => ['it_processes_id' => 'id']],
            [['it_services_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItServices::className(), 'targetAttribute' => ['it_services_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID RELACION'),
            'it_processes_id' => Yii::t('app', 'ID PROCESO'),
            'it_services_id' => Yii::t('app', 'ID SERVICIO'),
            'status' => Yii::t('app', 'ESTADO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProcesses()
    {
        return $this->hasOne(ItProcesses::className(), ['id' => 'it_processes_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItServices()
    {
        return $this->hasOne(ItServices::className(), ['id' => 'it_services_id']);
    }
}
