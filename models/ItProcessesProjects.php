<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_processes_projects".
 *
 * @property int $id ID RELACION
 * @property int $it_processes_id ID PROCESO
 * @property int $it_projects_id ID PROYECTO 
 * @property int $status ESTADO 
 *
 * @property ItProcesses $itProcesses
 * @property ItProjects $itProjects
 */
class ItProcessesProjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_processes_projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['it_processes_id', 'it_projects_id', 'status'], 'required'],
            [['it_processes_id', 'it_projects_id', 'status'], 'integer'],
            [['it_processes_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItProcesses::className(), 'targetAttribute' => ['it_processes_id' => 'id']],
            [['it_projects_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItProjects::className(), 'targetAttribute' => ['it_projects_id' => 'id']],
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
            'it_projects_id' => Yii::t('app', 'ID PROYECTO
'),
            'status' => Yii::t('app', 'ESTADO
'),
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
    public function getItProjects()
    {
        return $this->hasOne(ItProjects::className(), ['id' => 'it_projects_id']);
    }
}
