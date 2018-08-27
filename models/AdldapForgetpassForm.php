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

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['dni', 'mail','verifyCode'], 'required'],
            [['mail'], 'email'],
            [['verifyCode'],'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'dni' => 'Identificador (DNI, Cédula, Pasaporte)',
            'mail' => 'Usuario / Correo institucional',
            'verifyCode' => 'Código de verificación',
        ];
    }

}