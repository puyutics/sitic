<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adldap_new_users".
 *
 * @property int $id ID
 * @property string $dni CEDULA/PASAPORTE
 * @property string $nombres NOMBRES
 * @property string $apellidos APELLIDOS
 * @property string $fec_nacimiento FECHA NACIMIENTO
 * @property string $campus CAMPUS
 * @property string $carrera CARRERA
 * @property string $email_personal EMAIL PERSONAL
 * @property string $celular CELULAR
 * @property string $proceso PROCESO
 * @property int $status ESTADO
 */
class AdldapNewUsers extends \yii\db\ActiveRecord
{
    public $whatsapp = NULL;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adldap_new_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fec_nacimiento'], 'safe'],
            [['status'], 'integer'],
            [['dni', 'nombres', 'apellidos', 'campus', 'carrera', 'email_personal', 'celular', 'proceso'], 'string', 'max' => 255],
            [['email_personal'], 'email'],
            [['dni'], 'match',
                'pattern' => '/^[A-Z0-9]+$/u',
                'message'=>'{attribute} no puede contener letras minúsculas, espacios en blanco o caracteres especiales'],
            [['nombres', 'apellidos'], 'match',
                'pattern' => '/^[A-Z ]+$/u',
                'message'=>'{attribute} no puede contener letras minúsculas, números, espacios en blanco o caracteres especiales'],
            [['email_personal'], 'match',
                'pattern' => '/^[a-z0-9.@_]+$/u',
                'message'=>'{attribute} no puede contener letras mayúsculas, espacios en blanco o caracteres especiales'],
            [['celular'], 'match',
                'pattern' => '/^[0-9]+$/u',
                'message'=>'{attribute} no puede contener letras, espacios en blanco o caracteres especiales'],
            [['whatsapp'], 'match',
                'pattern' => '/^[0-9+]+$/u',
                'message'=>'{attribute} no debe contener caracteres alfabéticos o espacios en blanco'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dni' => 'CÉDULA / PASAPORTE',
            'nombres' => 'NOMBRES',
            'apellidos' => 'APELLIDOS',
            'fec_nacimiento' => 'FEC. NAC.',
            'campus' => 'CAMPUS',
            'carrera' => 'CARRERA',
            'email_personal' => 'EMAIL PERSONAL',
            'celular' => 'CELULAR',
            'whatsapp' => 'WHATSAPP',
            'proceso' => 'PROCESO',
            'status' => 'ESTADO',
        ];
    }

    public function getDatosCompletos()
    {
        return $this->dni.": ".$this->apellidos." ".$this->nombres;
    }
}
