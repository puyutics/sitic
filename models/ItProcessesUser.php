<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_processes_user".
 *
 * @property int $id ID ASIGNACION
 * @property string $username NOMBRE USUARIO
 * @property int $it_processes_id ID PROCESO
 * @property string $description DETALLE ASIGNACION
 * @property string $date_assigned FECHA ASIGNACION
 * @property string $date_released FECHA LIBERACION
 * @property int $status ESTADO ASIGNACION
 *
 * @property User $username0
 * @property ItProcesses $itProcesses
 */
class ItProcessesUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_processes_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'it_processes_id', 'description', 'date_assigned', 'status'], 'required'],
            [['it_processes_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['date_assigned', 'date_released'], 'safe'],
            [['username'], 'string', 'max' => 255],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'username']],
            [['it_processes_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItProcesses::className(), 'targetAttribute' => ['it_processes_id' => 'id']],
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
            'it_processes_id' => Yii::t('app', 'ID PROCESO'),
            'description' => Yii::t('app', 'DETALLE ASIGNACION'),
            'date_assigned' => Yii::t('app', 'FECHA ASIGNACION'),
            'date_released' => Yii::t('app', 'FECHA LIBERACION'),
            'status' => Yii::t('app', 'ESTADO ASIGNACION'),
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
    public function getItProcesses()
    {
        return $this->hasOne(ItProcesses::className(), ['id' => 'it_processes_id']);
    }
}
