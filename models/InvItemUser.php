<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inv_item_user".
 *
 * @property int $id ID ASIGNACION
 * @property string $username NOMBRE USUARIO
 * @property int $inv_purchase_item_id ID ITEM
 * @property string $date_asigned FECHA ASIGNACION
 * @property string $date_released FECHA LIBERACION
 * @property string $description DETALLE ASIGNACION
 * @property int $status ESTADO ASIGNACION
 *
 * @property User $username0
 * @property InvPurchaseItem $invPurchaseItem
 */
class InvItemUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inv_item_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'inv_purchase_item_id', 'date_asigned', 'description', 'status'], 'required'],
            [['inv_purchase_item_id', 'status'], 'integer'],
            [['date_asigned'], 'safe'],
            [['description'], 'string'],
            [['username'], 'string', 'max' => 255],
            [['date_released'], 'string', 'max' => 45],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'username']],
            [['inv_purchase_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvPurchaseItem::className(), 'targetAttribute' => ['inv_purchase_item_id' => 'id']],
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
            'inv_purchase_item_id' => Yii::t('app', 'ID ITEM'),
            'date_asigned' => Yii::t('app', 'FECHA ASIGNACION'),
            'date_released' => Yii::t('app', 'FECHA LIBERACION'),
            'description' => Yii::t('app', 'DETALLE ASIGNACION'),
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
    public function getInvPurchaseItem()
    {
        return $this->hasOne(InvPurchaseItem::className(), ['id' => 'inv_purchase_item_id']);
    }
}
