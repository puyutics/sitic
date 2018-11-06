<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_licenses".
 *
 * @property int $id ID
 * @property string $license LICENCIA
 * @property string $quantity CANTIDAD
 * @property string $description DETALLE
 * @property string $serial_number NUMERO DE SERIE
 * @property string $valid_since VALIDO DESDE
 * @property string $valid_until VALIDO HASTA
 * @property int $status ESTADO
 * @property int $inv_manufacturers_id FABRICANTE
 *
 * @property InvManufacturers $invManufacturers
 * @property ItLicensesUser[] $itLicensesUsers
 */
class ItLicenses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'it_licenses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['license', 'quantity', 'description', 'status', 'inv_manufacturers_id'], 'required'],
            [['description'], 'string'],
            [['valid_since', 'valid_until'], 'safe'],
            [['status', 'inv_manufacturers_id'], 'integer'],
            [['license', 'serial_number'], 'string', 'max' => 255],
            [['quantity'], 'string', 'max' => 45],
            [['inv_manufacturers_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvManufacturers::className(), 'targetAttribute' => ['inv_manufacturers_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'license' => Yii::t('app', 'LICENCIA'),
            'quantity' => Yii::t('app', 'CANTIDAD'),
            'description' => Yii::t('app', 'DETALLE'),
            'serial_number' => Yii::t('app', 'NUMERO DE SERIE'),
            'valid_since' => Yii::t('app', 'VALIDO DESDE'),
            'valid_until' => Yii::t('app', 'VALIDO HASTA'),
            'status' => Yii::t('app', 'ESTADO'),
            'inv_manufacturers_id' => Yii::t('app', 'FABRICANTE'),
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
    public function getItLicensesUsers()
    {
        return $this->hasMany(ItLicensesUser::className(), ['it_licenses_id' => 'id']);
    }
}
