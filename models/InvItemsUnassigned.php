<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inv_items_unassigned".
 *
 * @property int $id ID ITEM
 * @property string $description DETALLE ITEM
 * @property double $amount PRECIO ITEM
 * @property string $control_code CODIGO CONTROL
 * @property int $inv_models_id ID MODELO
 * @property string $serial_number NUMERO SERIE
 * @property int $inv_purchase_id ID COMPRA
 */
class InvItemsUnassigned extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inv_items_unassigned';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['inv_models_id', 'inv_purchase_id'], 'integer'],
            [['description', 'amount', 'inv_models_id', 'serial_number', 'inv_purchase_id'], 'required'],
            [['description'], 'string'],
            [['amount'], 'number'],
            [['control_code'], 'string', 'max' => 100],
            [['serial_number'], 'string', 'max' => 45],
            [['inv_models_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvModels::className(), 'targetAttribute' => ['inv_models_id' => 'id']],
            [['inv_purchase_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvPurchase::className(), 'targetAttribute' => ['inv_purchase_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID ITEM'),
            'description' => Yii::t('app', 'DETALLE ITEM'),
            'amount' => Yii::t('app', 'PRECIO ITEM'),
            'control_code' => Yii::t('app', 'CODIGO CONTROL'),
            'inv_models_id' => Yii::t('app', 'ID MODELO'),
            'serial_number' => Yii::t('app', 'NUMERO SERIE'),
            'inv_purchase_id' => Yii::t('app', 'ID COMPRA'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvItemUsers()
    {
        return $this->hasMany(InvItemUser::className(), ['inv_purchase_item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvModels()
    {
        return $this->hasOne(InvModels::className(), ['id' => 'inv_models_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvPurchase()
    {
        return $this->hasOne(InvPurchase::className(), ['id' => 'inv_purchase_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhonesExtensions()
    {
        return $this->hasMany(PhonesExtensions::className(), ['inv_purchase_item_id' => 'id']);
    }
}
