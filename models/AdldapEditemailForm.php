<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ForgetPassForm is the model behind the contact form.
 */
class AdldapEditemailForm extends Model
{
    public $dni;
    public $mail;
    public $personalmail;
    public $commonname;
    public $fec_nacimiento;
    public $step;
    public $token;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['dni','mail','personalmail','fec_nacimiento','step','token'], 'required'],
            [['mail'], 'filter', 'filter'=>'strtolower'],
            [['dni'], 'match',
                'pattern' => '/^[0-9A-Z]+$/u',
                'message'=>'Ingrese solo números y/o letras mayúsculas. {attribute} no puede contener caracteres especiales, ni espacios en blanco'],
            [['mail','personalmail'], 'match',
                'pattern' => '/^[a-z0-9@._-]+$/u',
                'message'=>'{attribute} no debe contener espacios en blancos, caracteres especiales, ni mayúsculas'],
            [['mail','personalmail'], 'email'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'dni' => 'Cédula/Pasaporte',
            'mail' => 'Correo institucional',
            'personalmail' => 'Nuevo Correo personal',
            'commonname' => 'Nombre completo',
            'fec_nacimiento' => 'Fecha nacimiento',
            'token' => 'TOKEN',
        ];
    }

}