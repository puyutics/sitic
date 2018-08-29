<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "auth_rule".
 *
 * @property string $name REGLE
 * @property resource $data DATOS
 * @property int $created_at CREADO
 * @property int $updated_at ACTUALIZADO
 *
 * @property AuthItem[] $authItems
 */
class AuthRule extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_rule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'REGLE'),
            'data' => Yii::t('app', 'DATOS'),
            'created_at' => Yii::t('app', 'CREADO'),
            'updated_at' => Yii::t('app', 'ACTUALIZADO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItems()
    {
        return $this->hasMany(AuthItem::className(), ['rule_name' => 'name']);
    }

    /**
     * {@inheritdoc}
     * @return AuthRuleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AuthRuleQuery(get_called_class());
    }
}
