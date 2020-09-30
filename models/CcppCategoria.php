<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ccpp_categoria".
 *
 * @property int $id ID
 * @property string $categoria CATEGORIA
 * @property int $status ESTADO
 *
 * @property CcppProveedorCategoria[] $ccppProveedorCategorias
 */
class CcppCategoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ccpp_categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['categoria'], 'required'],
            [['status'], 'integer'],
            [['categoria'], 'string', 'max' => 150],
            [['categoria'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoria' => 'CATEGORÍA',
            'status' => 'ESTADO',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCcppProveedorCategorias()
    {
        return $this->hasMany(CcppProveedorCategoria::className(), ['ccpp_categoria_id' => 'id']);
    }
}
