<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ForgetForm is the model behind the contact form.
 */
class AdldapCreateForm extends Model
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
    public $whatsapp;
    public $uac;
    public $groups;
    public $dn;
    public $department;
    public $title;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['samaccountname','dni','firstname', 'lastname','mail','commonname',
                'displayname','personalmail','uac','dn'], 'required'],
            [['department','title'],'string'],
            [['mobile','uac'],'number'],
            [['mail','personalmail'], 'email'],
            [['mail','personalmail'], 'email'],
            [['samaccountname'], 'match',
                'pattern' => '/^[a-z0-9.-]+$/u',
                'message'=>'{attribute} no debe contener caracteres especiales, ni mayùscula'],
            [['mail'], 'match',
                'pattern' => '/^[a-z0-9@.-]+$/u',
                'message'=>'{attribute} no debe contener caracteres especiales, ni mayùscula'],
            [['whatsapp'], 'match',
                'pattern' => '/^[0-9+]+$/u',
                'message'=>'{attribute} no debe contener caracteres alfabéticos o espacios en blanco'],
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
            'whatsapp'          => 'WhatsApp',
            'department'        => 'Departamento',
            'title'             => 'Puesto',
            'dn'                => 'Unidad Organizativa',
            'groups'            => 'Grupo(s)',
            'uac'               => 'Estado',
        ];
    }
}