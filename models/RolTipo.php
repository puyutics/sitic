<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol_tipo".
 *
 * @property int $id ID
 * @property string $nombre NOMBRE
 * @property string $nom_corto NOMBRE CORTO
 * @property int $status ESTADO
 *
 * @property RolUser[] $rolUsers
 */
class RolTipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rol_tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'nom_corto'], 'required'],
            [['status'], 'integer'],
            [['nombre', 'nom_corto'], 'string', 'max' => 255],
            [['nom_corto'], 'match',
                'pattern' => '/^[a-z-]+$/u',
                'message'=>'{attribute} no debe contener espacios en blanco, caracteres especiales, ni mayúscula'],];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'NOMBRE',
            'nom_corto' => 'NOMBRE CORTO',
            'status' => 'ESTADO',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolUsers()
    {
        return $this->hasMany(RolUser::className(), ['rol_tipo_id' => 'id']);
    }
}
