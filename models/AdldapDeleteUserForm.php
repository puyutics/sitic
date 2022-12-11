<?php

namespace app\models;

use yii\base\Model;

/**
 * ForgetForm is the model behind the contact form.
 */
class AdldapDeleteUserForm extends Model
{
    public $delete_user;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['delete_user'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'delete_user' => '¿Eliminar Usuario?',
        ];
    }
}