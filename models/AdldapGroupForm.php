<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ForgetForm is the model behind the contact form.
 */
class AdldapGroupForm extends Model
{
    public $search;
    public $name;
    public $dn;
    public $groupType;
    public $members;
    public $deleteMember;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name','dn','deleteMember'],'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'search'       => 'Buscar',
            'name'         => 'Nombre del grupo',
            'dn'           => 'Unidad Organizativa',
            'groupType'    => 'Tipo de grupo',
            'members'      => 'Miembro(s)',
            'deleteMember' => 'Eliminar miembro',

        ];
    }
}