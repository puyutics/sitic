<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ForgetForm is the model behind the contact form.
 */
class AdldapEditForm extends Model
{
    public $search;
    public $dni;
    public $firstname;
    public $lastname;
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

    public $addGroup;
    public $deleteGroup;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['dni','firstname', 'lastname','mail','commonname',
                'displayname','personalmail','uac'], 'required'],
            [['department','title','addGroup','deleteGroup'],'string'],
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
            'search'       => 'Buscar',
            'dni'          => 'DNI/Cédula/Pasaporte',
            'lastname'     => 'Apellidos',
            'firstname'    => 'Nombres',
            'commonname'   => 'Nombre completo',
            'displayname'  => 'Nombre para mostrar',
            'mail'         => 'Correo institucional',
            'personalmail' => 'Correo personal',
            'mobile'       => 'Celular',
            'title'        => 'Puesto',
            'department'   => 'Departamento',
            'dn'           => 'Unidad Organizativa',
            'groups'       => 'Grupo(s)',
            'uac'          => 'Estado',

            'addGroup'     => 'Agregar Grupo',
            'deleteGroup'  => 'Eliminar Grupo',
        ];
    }
}