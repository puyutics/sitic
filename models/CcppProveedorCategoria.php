<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ccpp_proveedor_categoria".
 *
 * @property int $id ID
 * @property int $ccpp_proveedor_id
 * @property int $ccpp_categoria_id
 * @property int $status ESTADO
 *
 * @property CcppCategoria $ccppCategoria
 * @property CcppProveedor $ccppProveedor
 */
class CcppProveedorCategoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ccpp_proveedor_categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ccpp_proveedor_id', 'ccpp_categoria_id'], 'required'],
            [['ccpp_proveedor_id', 'ccpp_categoria_id', 'status'], 'integer'],
            [['ccpp_categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => CcppCategoria::className(), 'targetAttribute' => ['ccpp_categoria_id' => 'id']],
            [['ccpp_proveedor_id'], 'exist', 'skipOnError' => true, 'targetClass' => CcppProveedor::className(), 'targetAttribute' => ['ccpp_proveedor_id' => 'id']],
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
            'ccpp_categoria_id' => 'CATEGORIA',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCcppCategoria()
    {
        return $this->hasOne(CcppCategoria::className(), ['id' => 'ccpp_categoria_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCcppProveedor()
    {
        return $this->hasOne(CcppProveedor::className(), ['id' => 'ccpp_proveedor_id']);
    }
}
