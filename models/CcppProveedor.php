<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ccpp_proveedor".
 *
 * @property int $id ID
 * @property string $razon_social RAZON SOCIAL
 * @property string $ruc RUC
 * @property string $ciudad CIUDAD
 * @property string $direccion DIRECCION
 * @property string $sitio_web SITIO WEB
 * @property int $status ESTADO
 *
 * @property CcppProveedorCategoria[] $ccppProveedorCategorias
 * @property CcppProveedorContacto[] $ccppProveedorContactos
 */
class CcppProveedor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ccpp_proveedor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['razon_social', 'ruc', 'ciudad', 'direccion','sitio_web'], 'required'],
            [['status'], 'integer'],
            [['razon_social', 'ruc', 'ciudad', 'direccion','sitio_web'], 'string', 'max' => 255],
            [['ruc'], 'unique'],
            [['ruc'], 'match',
                'pattern' => '/^[0-9.]+$/u',
                'message'=>'{attribute} no debe contener letras, caracteres especiales, ni espacios en blanco'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'razon_social' => 'RAZÓN SOCIAL',
            'ruc' => 'RUC',
            'ciudad' => 'CIUDAD',
            'direccion' => 'DIRECCIÓN',
            'sitio_web' => 'SITIO WEB',
            'status' => 'ESTADO',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCcppProveedorCategorias()
    {
        return $this->hasMany(CcppProveedorCategoria::className(), ['ccpp_proveedor_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCcppProveedorContactos()
    {
        return $this->hasMany(CcppProveedorContacto::className(), ['ccpp_proveedor_id' => 'id']);
    }
}
