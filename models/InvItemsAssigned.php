<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inv_items_assigned".
 *
 * @property int $inv_purchase_id ID COMPRA
 * @property int $id ID ASIGNACION
 * @property string $username NOMBRE USUARIO
 * @property int $inv_purchase_item_id ID ITEM
 * @property string $date_asigned FECHA ASIGNACION
 * @property string $date_released FECHA LIBERACION
 * @property string $description DETALLE ASIGNACION
 * @property int $status ESTADO ASIGNACION
 */
class InvItemsAssigned extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inv_items_assigned';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inv_purchase_id', 'username', 'inv_purchase_item_id', 'date_asigned', 'description', 'status'], 'required'],
            [['inv_purchase_id', 'id', 'inv_purchase_item_id', 'status'], 'integer'],
            [['date_asigned'], 'safe'],
            [['description'], 'string'],
            [['username'], 'string', 'max' => 255],
            [['date_released'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inv_purchase_id' => Yii::t('app', 'ID COMPRA'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvPurchase()
    {
        return $this->hasOne(InvPurchase::className(), ['id' => 'inv_purchase_id']);
    }
}
