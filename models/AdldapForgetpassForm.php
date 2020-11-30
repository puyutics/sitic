<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ForgetPassForm is the model behind the contact form.
 */
class AdldapForgetpassForm extends Model
{
    public $dni;
    public $mail;
    public $personalmail;
    public $verifyCode;
    public $commonname;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['dni', 'mail','verifyCode'], 'required'],
            [['mail'], 'filter', 'filter'=>'strtolower'],
            [['verifyCode'],'captcha'],
            [['dni'], 'match',
                'pattern' => '/^[0-9A-Z]+$/u',
                'message'=>'Ingrese solo números y/o letras mayúsculas. {attribute} no puede contener caracteres especiales, ni espacios en blanco'],
            [['mail'], 'match',
                'pattern' => '/^[a-z0-9@._-]+$/u',
                'message'=>'{attribute} no debe contener espacios en blancos, caracteres especiales, ni mayúsculas'],
            [['mail'], 'email'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'dni' => 'Cédula/Pasaporte/Código',
            'mail' => 'Correo institucional',
            'personalmail' => 'Correo personal',
            'verifyCode' => 'Código de verificación',
            'commonname' => 'Nombre completo',
        ];
    }

}