<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ccpp_proveedor_contacto".
 *
 * @property int $id ID
 * @property int $ccpp_proveedor_id PROVEEDOR
 * @property string $nombre NOMBRE
 * @property string $cargo CARGO
 * @property string $celular CELULAR
 * @property string $telefono TELEFONO
 * @property string $extension EXTENSION
 * @property string $email EMAIL
 * @property int $status ESTADO
 *
 * @property CcppProveedor $ccppProveedor
 */
class CcppProveedorContacto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ccpp_proveedor_contacto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ccpp_proveedor_id', 'nombre', 'cargo', 'celular', 'telefono', 'email'], 'required'],
            [['ccpp_proveedor_id', 'status'], 'integer'],
            [['nombre', 'cargo', 'celular', 'telefono', 'extension', 'email'], 'string', 'max' => 255],
            [['ccpp_proveedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => CcppProveedor::className(), 'targetAttribute' => ['ccpp_proveedor_id' => 'id']],
            [['email'], 'email'],
            [['email'], 'match',
                'pattern' => '/^[a-z0-9@._-]+$/u',
                'message'=>'{attribute} no debe contener espacios en blancos, caracteres especiales, ni mayúsculas'],
            [['celular', 'telefono', 'extension'], 'match',
                'pattern' => '/^[0-9.]+$/u',
                'message'=>'{attribute} no debe contener letras, caracteres especiales, ni espacios en blanco']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ccpp_proveedor_id' => 'PROVEEDOR',
            'nombre' => 'NOMBRE',
            'cargo' => 'CARGO',
            'celular' => 'CELULAR',
            'telefono' => 'TELÉFONO',
            'extension' => 'EXTENSIÓN',
            'email' => 'EMAIL',
            'status' => 'ESTADO',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCcppProveedor()
    {
        return $this->hasOne(CcppProveedor::className(), ['id' => 'ccpp_proveedor_id']);
    }
}
