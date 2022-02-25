<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rol_user".
 *
 * @property int $id ID
 * @property string $username USUARIO
 * @property int $rol_tipo_id ROL TIPO
 * @property int $anio AÑO
 * @property int $mes MES
 * @property string $filefolder CARPETA
 * @property string $filename ARCHIVO
 * @property string $filetype EXTENSION
 * @property int $status ESTADO
 *
 * @property RolTipo $rolTipo
 * @property User $username0
 */
class RolUser extends \yii\db\ActiveRecord
{
    public $upload_rol;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rol_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'rol_tipo_id', 'anio', 'mes', 'filefolder',  'filename', 'filetype'], 'required'],
            [['rol_tipo_id', 'anio', 'mes', 'status'], 'integer'],
            [['username', 'filefolder', 'filename'], 'string', 'max' => 255],
            [['filetype'], 'string', 'max' => 45],
            [['rol_tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => RolTipo::className(), 'targetAttribute' => ['rol_tipo_id' => 'id']],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'username']],
            [['upload_rol'], 'file', 'extensions' => 'pdf'],
            [['upload_rol'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'USUARIO',
            'rol_tipo_id' => 'ROL TIPO',
            'anio' => 'AÑO',
            'mes' => 'MES',
            'filefolder' => 'CARPETA',
            'filename' => 'ARCHIVO',
            'filetype' => 'EXTENSION',
            'status' => 'ESTADO',
            'upload_rol' => 'Subir Rol',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolTipo()
    {
        return $this->hasOne(RolTipo::className(), ['id' => 'rol_tipo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(User::className(), ['username' => 'username']);
    }

    //Función Subir Archivos
    //https://www.yiiframework.com/doc/guide/2.0/en/input-file-upload

    public function uploadRol($model)
    {
        if ($this->validate()) {
            $this->upload_rol->saveAs($model->filefolder.$model->filename.'.'.$model->filetype,false);
            return true;
        } else {
            return false;
        }
    }
}
