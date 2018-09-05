<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_projects".
 *
 * @property int $id ID PROYECTO
 * @property string $code CODIGO PROYECTO
 * @property string $project NOMBRE PROYECTO
 * @property string $description DESCRIPCION PROYECTO
 * @property double $amount MONTO COSTO
 * @property string $date_creation FECHA CREACION
 * @property string $date_closed FECHA CIERRE
 * @property int $status ESTADO PROYECTO
 *
 * @property ItProjectsParents[] $itProjectsParents
 * @property ItProjectsParents[] $itProjectsParents0
 * @property ItProjectsPurchase[] $itProjectsPurchases
 * @property ItProjectsServices[] $itProjectsServices
 * @property ItProjectsStages[] $itProjectsStages
 * @property ItProjectsUser[] $itProjectsUsers
 */
class ItProjects extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_projects';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'project', 'description', 'amount', 'date_creation', 'status'], 'required'],
            [['description'], 'string'],
            [['amount'], 'number'],
            [['date_creation', 'date_closed'], 'safe'],
            [['status'], 'integer'],
            [['code'], 'string', 'max' => 45],
            [['project'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID PROYECTO'),
            'code' => Yii::t('app', 'CODIGO PROYECTO'),
            'project' => Yii::t('app', 'NOMBRE PROYECTO'),
            'description' => Yii::t('app', 'DESCRIPCION PROYECTO'),
            'amount' => Yii::t('app', 'MONTO COSTO'),
            'date_creation' => Yii::t('app', 'FECHA CREACION'),
            'date_closed' => Yii::t('app', 'FECHA CIERRE'),
            'status' => Yii::t('app', 'ESTADO PROYECTO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProjectsParents()
    {
        return $this->hasMany(ItProjectsParents::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProjectsParents0()
    {
        return $this->hasMany(ItProjectsParents::className(), ['it_projects_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProjectsPurchases()
    {
        return $this->hasMany(ItProjectsPurchase::className(), ['it_projects_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProjectsServices()
    {
        return $this->hasMany(ItProjectsServices::className(), ['it_projects_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProjectsStages()
    {
        return $this->hasMany(ItProjectsStages::className(), ['it_projects_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItProjectsUsers()
    {
        return $this->hasMany(ItProjectsUser::className(), ['it_projects_id' => 'id']);
    }
}
