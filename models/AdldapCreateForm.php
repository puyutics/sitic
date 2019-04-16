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

        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'dni'               => 'DNI/Cédula/Pasaporte',
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
        ];
    }
}