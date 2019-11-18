<?php

namespace app\models;

use Yii;
use yii\base\Model;
use kartik\password\StrengthValidator;

/**
 * ForgetForm is the model behind the contact form.
 */
class AdldapPasswordForm extends Model
{
    public $mail;
    public $oldPassword;
    public $newPassword;
    public $verifyNewPassword;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['mail','oldPassword', 'newPassword','verifyNewPassword'], 'required'],
            [['mail'], 'email'],
            [['newPassword'], StrengthValidator::className(),
                'userAttribute'=>'mail',
                'min'=>8,
                'upper' => 1,
                'lower' => 1,
                'digit'=>1,
                'special'=>0
            ]
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'mail' => 'Correo institucional',
            'olPassword' => 'Contraseña Actual',
            'newPassword' => 'Contraseña Nueva',
            'verifyNewPassword' => 'Verificar Contraseña',
        ];
    }
}