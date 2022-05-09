<?php

namespace app\models;

use yii\base\Model;

/**
 * ForgetForm is the model behind the contact form.
 */
class AdldapOuMoveForm extends Model
{
    public $dn_new;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['dn_new'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'dn_new' => 'Unidad Organizativa Nueva',
        ];
    }
}