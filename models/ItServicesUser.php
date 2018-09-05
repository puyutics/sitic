<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_services_user".
 *
 * @property int $id ID ASIGNACION
 * @property string $username NOMBRE USUARIO
 * @property int $it_services_id ID SERVICIO
 * @property string $description DESCRIPCION ASIGNACION
 * @property string $date_assigned FECHA ASIGNACION
 * @property string $date_released FECHA LIBERACION
 * @property int $status ESTADO ASIGNACION
 *
 * @property ItServices $itServices
 * @property User $username0
 */
class ItServicesUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'it_services_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'it_services_id', 'description', 'date_assigned', 'status'], 'required'],
            [['it_services_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['date_assigned', 'date_released'], 'safe'],
            [['username'], 'string', 'max' => 255],
            [['it_services_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItServices::className(), 'targetAttribute' => ['it_services_id' => 'id']],
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
            'it_services_id' => Yii::t('app', 'ID SERVICIO'),
            'description' => Yii::t('app', 'DESCRIPCION ASIGNACION'),
            'date_assigned' => Yii::t('app', 'FECHA ASIGNACION'),
            'date_released' => Yii::t('app', 'FECHA LIBERACION'),
            'status' => Yii::t('app', 'ESTADO ASIGNACION'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItServices()
    {
        return $this->hasOne(ItServices::className(), ['id' => 'it_services_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(User::className(), ['username' => 'username']);
    }
}
