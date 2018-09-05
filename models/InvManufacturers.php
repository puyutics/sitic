<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inv_manufacturers".
 *
 * @property int $id ID FABRICANTE
 * @property string $manufacturer NOMBRE FABRICANTE
 *
 * @property InvModels[] $invModels
 */
class InvManufacturers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inv_manufacturers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manufacturer'], 'required'],
            [['manufacturer'], 'string', 'max' => 45],
            [['manufacturer'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID FABRICANTE'),
            'manufacturer' => Yii::t('app', 'NOMBRE FABRICANTE'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvModels()
    {
        return $this->hasMany(InvModels::className(), ['inv_manufacturers_id' => 'id']);
    }
}
