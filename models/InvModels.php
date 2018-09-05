<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inv_models".
 *
 * @property int $id ID MODELO
 * @property string $model NOMBRE MODELO
 * @property string $consumables CONSUMIBLES
 * @property int $inv_manufacturers_id ID FABRICANTE
 *
 * @property InvManufacturers $invManufacturers
 * @property InvPurchaseItem[] $invPurchaseItems
 * @property Printers[] $printers
 */
class InvModels extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inv_models';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'inv_manufacturers_id'], 'required'],
            [['consumables'], 'string'],
            [['inv_manufacturers_id'], 'integer'],
            [['model'], 'string', 'max' => 45],
            [['model'], 'unique'],
            [['inv_manufacturers_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvManufacturers::className(), 'targetAttribute' => ['inv_manufacturers_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID MODELO'),
            'model' => Yii::t('app', 'NOMBRE MODELO'),
            'consumables' => Yii::t('app', 'CONSUMIBLES'),
            'inv_manufacturers_id' => Yii::t('app', 'ID FABRICANTE'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvManufacturers()
    {
        return $this->hasOne(InvManufacturers::className(), ['id' => 'inv_manufacturers_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvPurchaseItems()
    {
        return $this->hasMany(InvPurchaseItem::className(), ['inv_models_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrinters()
    {
        return $this->hasMany(Printers::className(), ['inv_models_id' => 'id']);
    }
}
