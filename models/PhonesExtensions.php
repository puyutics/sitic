<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "phones_extensions".
 *
 * @property int $id ID EXTENSION
 * @property string $extension NUMERO EXTENSION
 * @property string $description DETALLE EXTENSION
 * @property string $ipv4_address IPV4 TELEFONO
 * @property string $username NOMBRE USUARIO
 * @property int $department_id ID DEPARTAMENTO
 * @property int $inv_purchase_item_id ID ITEM
 *
 * @property Department $department
 * @property InvPurchaseItem $invPurchaseItem
 */
class PhonesExtensions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phones_extensions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['extension', 'description', 'ipv4_address', 'username', 'department_id', 'inv_purchase_item_id'], 'required'],
            [['extension'],'unique'],
            [['department_id', 'inv_purchase_item_id'], 'integer'],
            [['extension'], 'string', 'max' => 45],
            [['description', 'username'], 'string', 'max' => 255],
            [['ipv4_address'], 'string', 'max' => 15],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['inv_purchase_item_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvPurchaseItem::className(), 'targetAttribute' => ['inv_purchase_item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID EXTENSION'),
            'extension' => Yii::t('app', 'NUMERO EXTENSION'),
            'description' => Yii::t('app', 'DETALLE EXTENSION'),
            'ipv4_address' => Yii::t('app', 'IPV4 TELEFONO'),
            'username' => Yii::t('app', 'NOMBRE USUARIO'),
            'department_id' => Yii::t('app', 'ID DEPARTAMENTO'),
            'inv_purchase_item_id' => Yii::t('app', 'ID ITEM'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvPurchaseItem()
    {
        return $this->hasOne(InvPurchaseItem::className(), ['id' => 'inv_purchase_item_id']);
    }
}
