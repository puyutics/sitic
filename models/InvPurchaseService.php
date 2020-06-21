<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inv_purchase_service".
 *
 * @property int $id ID
 * @property int $inv_purchase_id
 * @property string $description DESCRIPCION
 * @property double $amount COSTO
 * @property string $control_code CODIGO
 *
 * @property InvPurchase $invPurchase
 * @property InvServiceUser[] $invServiceUsers
 */
class InvPurchaseService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inv_purchase_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inv_purchase_id'], 'required'],
            [['inv_purchase_id'], 'integer'],
            [['description'], 'string'],
            [['amount'], 'number'],
            [['control_code'], 'string', 'max' => 255],
            [['inv_purchase_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvPurchase::className(), 'targetAttribute' => ['inv_purchase_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'inv_purchase_id' => 'Inv Purchase ID',
            'description' => 'Description',
            'amount' => 'Amount',
            'control_code' => 'Control Code',
        ];
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
    public function getInvServiceUsers()
    {
        return $this->hasMany(InvServiceUser::className(), ['inv_purchase_service_id' => 'id']);
    }
}
