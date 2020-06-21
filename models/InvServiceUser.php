<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inv_service_user".
 *
 * @property int $id ID
 * @property string $username
 * @property int $inv_purchase_service_id
 * @property string $date_assigned FECHA ASIGNACION
 * @property string $date_released FECHA LIBERACION
 * @property string $description DESCRIPCION
 * @property int $status ESTADO
 *
 * @property InvPurchaseService $invPurchaseService
 * @property User $username0
 * @property TabIntFormularioInvServiceUser[] $tabIntFormularioInvServiceUsers
 */
class InvServiceUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inv_service_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'inv_purchase_service_id'], 'required'],
            [['inv_purchase_service_id', 'status'], 'integer'],
            [['date_assigned', 'date_released'], 'safe'],
            [['description'], 'string'],
            [['username'], 'string', 'max' => 255],
            [['inv_purchase_service_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvPurchaseService::className(), 'targetAttribute' => ['inv_purchase_service_id' => 'id']],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'username']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'inv_purchase_service_id' => 'Inv Purchase Service ID',
            'date_assigned' => 'Date Assigned',
            'date_released' => 'Date Released',
            'description' => 'Description',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvPurchaseService()
    {
        return $this->hasOne(InvPurchaseService::className(), ['id' => 'inv_purchase_service_id']);
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
    public function getTabIntFormularioInvServiceUsers()
    {
        return $this->hasMany(TabIntFormularioInvServiceUser::className(), ['inv_service_user_id' => 'id']);
    }
}
