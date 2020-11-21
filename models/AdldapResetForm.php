<?php

namespace app\models;

use Yii;
use yii\base\Model;
use kartik\password\StrengthValidator;

/**
 * ForgetForm is the model behind the contact form.
 */
class AdldapResetForm extends Model
{
    public $mail;
    public $commonname;
    public $resetToken;
    public $newPassword;
    public $verifyNewPassword;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['mail','resetToken', 'newPassword','verifyNewPassword'], 'required'],
            [['mail'], 'email'],
            [['newPassword','verifyNewPassword'], StrengthValidator::className(),
                'userAttribute'=>'mail',
                'min'=>8,
                'upper' => 1,
                'lower' => 1,
                'digit'=>1,
                'special'=>0
            ],

        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'mail' => 'Correo institucional',
            'commonname' => 'Nombres Completos',
            'resetToken' => 'TOKEN (Enviado a su correo personal)',
            'newPassword' => 'Nueva Contraseña',
            'verifyNewPassword' => 'Verificar Contraseña',
        ];
    }
}