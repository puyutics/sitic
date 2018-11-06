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

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['dni','firstname', 'lastname','mail','commonname',
                'displayname','personalmail','uac'], 'required'],
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
            'firstname'    => 'Nombres',
            'lastname'     => 'Apellidos',
            'mail'         => 'Correo institucional',
            'commonname'   => 'Nombre completo',
            'displayname'  => 'Nombre para mostrar',
            'personalmail' => 'Correo personal',
            'mobile'       => 'Celular',
            'uac'          => 'Estado',
            'groups'       => 'Grupo(s)',
            'dn'           => 'Unidad Organizativa',
        ];
    }
}