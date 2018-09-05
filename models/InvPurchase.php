<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inv_purchase".
 *
 * @property int $id ID COMPRA
 * @property string $code CODIGO COMPRA
 * @property string $description DETALLE COMPRA
 * @property string $date FECHA RECEPCION
 * @property string $username NOMBRE USUARIO
 *
 * @property User $username0
 * @property InvPurchaseItem[] $invPurchaseItems
 */
class InvPurchase extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inv_purchase';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'description', 'date', 'username'], 'required'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['code'], 'string', 'max' => 45],
            [['username'], 'string', 'max' => 255],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'username']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID COMPRA'),
            'code' => Yii::t('app', 'CODIGO COMPRA'),
            'description' => Yii::t('app', 'DETALLE COMPRA'),
            'date' => Yii::t('app', 'FECHA RECEPCION'),
            'username' => Yii::t('app', 'USUARIO'),
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
    public function getInvPurchaseItems()
    {
        return $this->hasMany(InvPurchaseItem::className(), ['inv_purchase_id' => 'id']);
    }
}
