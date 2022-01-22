<?php

namespace app\models;

use kartik\password\StrengthValidator;
use Yii;
use yii\base\Model;

/**
 * ForgetForm is the model behind the contact form.
 */
class AdldapCreateStudentForm extends Model
{
    public $dni;
    public $firstname;
    public $lastname;
    public $samaccountname;
    public $mail;
    public $personalmail;
    public $commonname;
    public $displayname;
    public $mobile;
    public $uac;
    public $groups;
    public $dn;
    public $department;
    public $title;
    public $fec_nacimiento;
    public $step;
    public $token;
    public $newPassword;
    public $verifyNewPassword;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['samaccountname','dni','firstname', 'lastname','mail','commonname',
                'displayname','personalmail','uac','dn'], 'required'],
            [['fec_nacimiento','step','token','newPassword','verifyNewPassword'], 'required'],
            [['department','title'],'string'],
            [['mobile','uac'],'number'],
            [['mail','personalmail'], 'email'],
            [['mail','personalmail'], 'email'],
            [['samaccountname'], 'match',
                'pattern' => '/^[a-z0-9.]+$/u',
                'message'=>'{attribute} no debe contener caracteres especiales, ni mayùscula'],
            [['mail'], 'match',
                'pattern' => '/^[a-z0-9@.]+$/u',
                'message'=>'{attribute} no debe contener caracteres especiales, ni mayùscula'],
            [['newPassword','verifyNewPassword'], StrengthValidator::className(),
                'userAttribute'=>'mail',
                'min'=>8,
                'upper' => 1,
                'lower' => 1,
                'digit'=>1,
                'special'=>0
            ],
            [['dni'], 'match',
                'pattern' => '/^[0-9A-Z]+$/u',
                'message'=>'Ingrese solo números y/o letras mayúsculas. {attribute} no puede contener caracteres especiales, ni espacios en blanco'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'dni'               => 'Cédula/Pasaporte/Código',
            'firstname'         => 'Nombres',
            'lastname'          => 'Apellidos',
            'samaccountname'    => 'Usuario',
            'mail'              => 'Correo institucional',
            'commonname'        => 'Nombre completo',
            'displayname'       => 'Nombre para mostrar',
            'personalmail'      => 'Correo personal',
            'mobile'            => 'Celular',
            'department'        => 'Departamento',
            'title'             => 'Puesto',
            'dn'                => 'Unidad Organizativa',
            'groups'            => 'Grupo(s)',
            'uac'               => 'Estado',
            'fec_nacimiento'    => 'Fecha Nacimiento',
            'token'             => 'TOKEN',
            'newPassword'       => 'Nueva Contraseña',
            'verifyNewPassword' => 'Verificar Contraseña',
        ];
    }
}