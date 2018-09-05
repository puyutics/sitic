<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_projects_user".
 *
 * @property int $id ID ASIGNACION
 * @property string $username NOMBRE USUARIO
 * @property int $it_projects_id ID PROYECTO
 * @property string $description DESCRIPCION ASIGNACION
 * @property string $date_asigned FECHA ASIGNACION
 * @property string $date_released FECHA LIBERACION
 * @property string $status ESTADO ASIGNACION
 *
 * @property ItProjects $itProjects
 * @property User $username0
 */
class ItProjectsUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_projects_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'it_projects_id', 'description', 'date_asigned', 'status'], 'required'],
            [['it_projects_id'], 'integer'],
            [['description'], 'string'],
            [['date_asigned', 'date_released'], 'safe'],
            [['username'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 45],
            [['it_projects_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItProjects::className(), 'targetAttribute' => ['it_projects_id' => 'id']],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'username']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID ASIGNACION'),
            'username' => Yii::t('app', 'NOMBRE USUARIO'),
            'it_projects_id' => Yii::t('app', 'ID PROYECTO'),
            'description' => Yii::t('app', 'DESCRIPCION ASIGNACION'),
            'date_asigned' => Yii::t('app', 'FECHA ASIGNACION'),
            'date_released' => Yii::t('app', 'FECHA LIBERACION'),
            'status' => Yii::t('app', 'ESTADO ASIGNACION'),
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
    public function getUsername0()
    {
        return $this->hasOne(User::className(), ['username' => 'username']);
    }
}
