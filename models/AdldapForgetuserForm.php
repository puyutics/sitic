<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ForgetForm is the model behind the contact form.
 */
class AdldapForgetuserForm extends Model
{
    public $dni;
    public $mail;
    public $verifyCode;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['dni','verifyCode'], 'required'],
            [['verifyCode'],'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'dni' => 'Identificador (DNI/Cédula/Pasaporte)',
            'verifyCode' => 'Código de verificación',
        ];
    }


}