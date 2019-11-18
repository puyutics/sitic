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
            [['mail'], 'email'],
            [['mail'], 'filter', 'filter'=>'strtolower'],
            [['verifyCode'],'captcha'],
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