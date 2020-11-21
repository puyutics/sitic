<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "becas_conectividad".
 *
 * @property int $id ID
 * @property string $dni CEDULA PASAPORTE
 * @property string $username USUARIO
 * @property string $email EMAIL
 * @property string $nombres NOMBRES
 * @property string $apellidos APELLIDOS
 * @property string $provincia PROVINCIA
 * @property string $cel_contacto CELULAR
 * @property string $tel_contacto TELEFONO
 * @property string $cuenta_dni CEDULA TITULAR
 * @property string $cuenta_numero NUMERO DE CUENTA
 * @property string $cuenta_titular NOMBRE TITULAR
 * @property string $cuenta_tipo TIPO DE CUENTA
 * @property string $cuenta_institucion INSTITUCION FINANCIERA
 * @property string $siad_matriculado SIAD MATRICULADO
 * @property string $siad_semestre SIAD SEMESTRE
 * @property string $siad_carrera SIAD CARRERA
 * @property string $ficha_escasos_recursos FICHA ESCASOS RECURSOS
 * @property int $status ESTADO
 */
class BecasConectividad extends \yii\db\ActiveRecord
{
    public $upload_libreta;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'becas_conectividad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fec_registro'], 'safe'],
            [['status'], 'integer'],
            [['dni', 'username', 'email', 'nombres', 'apellidos', 'provincia', 'cel_contacto', 'tel_contacto', 'cuenta_dni', 'cuenta_numero', 'cuenta_titular', 'cuenta_tipo', 'cuenta_institucion', 'siad_matriculado', 'siad_semestre', 'siad_carrera', 'ficha_escasos_recursos'], 'string', 'max' => 255],
            [['cuenta_numero', 'cuenta_tipo', 'cuenta_institucion', 'upload_libreta', 'provincia', 'cel_contacto', 'tel_contacto'], 'required'],
            [['cuenta_numero', 'cel_contacto', 'tel_contacto'], 'match',
                'pattern' => '/^[0-9]+$/u',
                'message'=>'INGRESE SOLO NÚMEROS. {attribute} no puede contener caracteres especiales, ni letras'],
            [['upload_libreta'], 'file', 'extensions' => 'jpg'],
        ];
}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dni' => 'CEDULA PASAPORTE',
            'username' => 'USUARIO',
            'email' => 'EMAIL',
            'nombres' => 'NOMBRES',
            'apellidos' => 'APELLIDOS',
            'provincia' => 'PROVINCIA RESIDENCIA',
            'cel_contacto' => 'CELULAR',
            'tel_contacto' => 'TELÉFONO',
            'cuenta_dni' => 'CÉDULA TITULAR',
            'cuenta_numero' => 'NÚMERO DE CUENTA',
            'cuenta_titular' => 'NOMBRE TITULAR',
            'cuenta_tipo' => 'TIPO DE CUENTA',
            'cuenta_institucion' => 'INSTITUCIÓN FINANCIERA',
            'siad_matriculado' => 'SIAD MATRICULADO',
            'siad_semestre' => 'SIAD SEMESTRE',
            'siad_carrera' => 'SIAD CARRERA',
            'ficha_escasos_recursos' => 'FICHA ESCASOS RECURSOS',
            'upload_libreta' => 'SUBIR LIBRETA',
            'doc_libreta' => 'DOCUMENTO LIBRETA',
            'fec_registro' => 'FECHA REGISTRO',
            'status' => 'ESTADO',
        ];
    }

    //Función Subir Archivos
    //https://www.yiiframework.com/doc/guide/2.0/en/input-file-upload

    public function uploadDocumentos($model)
    {
        if ($this->validate()) {
            $this->upload_libreta->saveAs('uploads/becasconectividad/libretas/' . $model->doc_libreta,false);
            return true;
        } else {
            return false;
        }
    }
}
