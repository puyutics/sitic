<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tab_int_formulario_inv_item_user".
 *
 * @property int $id ID
 * @property int $tab_int_formulario_id
 * @property int $inv_item_user_id
 * @property int $status
 *
 * @property InvItemUser $invItemUser
 * @property TabIntFormulario $tabIntFormulario
 */
class TabIntFormularioInvItemUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tab_int_formulario_inv_item_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tab_int_formulario_id', 'inv_item_user_id'], 'required'],
            [['tab_int_formulario_id', 'inv_item_user_id', 'status'], 'integer'],
            [['inv_item_user_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvItemUser::className(), 'targetAttribute' => ['inv_item_user_id' => 'id']],
            [['tab_int_formulario_id'], 'exist', 'skipOnError' => true, 'targetClass' => TabIntFormulario::className(), 'targetAttribute' => ['tab_int_formulario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tab_int_formulario_id' => 'Tab Int Formulario ID',
            'inv_item_user_id' => 'Inv Item User ID',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvItemUser()
    {
        return $this->hasOne(InvItemUser::className(), ['id' => 'inv_item_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabIntFormulario()
    {
        return $this->hasOne(TabIntFormulario::className(), ['id' => 'tab_int_formulario_id']);
    }
}
