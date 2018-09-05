<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_projects_services".
 *
 * @property int $id ID RELACION
 * @property int $it_projects_id ID PROYECTO
 * @property int $it_services_id ID SERVICIO
 * @property string $description DETALLE
 * @property string $status ESTADO
 *
 * @property ItProjects $itProjects
 * @property ItServices $itServices
 */
class ItProjectsServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_projects_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['it_projects_id', 'it_services_id', 'description', 'status'], 'required'],
            [['it_projects_id', 'it_services_id'], 'integer'],
            [['description'], 'string'],
            [['status'], 'string', 'max' => 45],
            [['it_projects_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItProjects::className(), 'targetAttribute' => ['it_projects_id' => 'id']],
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
            'it_projects_id' => Yii::t('app', 'ID PROYECTO'),
            'it_services_id' => Yii::t('app', 'ID SERVICIO'),
            'description' => Yii::t('app', 'DETALLE'),
            'status' => Yii::t('app', 'ESTADO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProjects()
    {
        return $this->hasOne(ItProjects::className(), ['id' => 'it_projects_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItServices()
    {
        return $this->hasOne(ItServices::className(), ['id' => 'it_services_id']);
    }
}
