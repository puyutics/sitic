<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "NOM_PARAM_VEH".
 *
 * @property string $P_ID
 * @property string $P_DESC_PARAM
 * @property string $P_VAL_PARAM
 */
class NomParamVeh extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NOM_PARAM_VEH';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_onlycontrol');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['P_ID', 'P_DESC_PARAM', 'P_VAL_PARAM'], 'required'],
            [['P_ID'], 'string', 'max' => 4],
            [['P_DESC_PARAM', 'P_VAL_PARAM'], 'string', 'max' => 64],
            [['P_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'P_ID' => 'P ID',
            'P_DESC_PARAM' => 'P Desc Param',
            'P_VAL_PARAM' => 'P Val Param',
        ];
    }
}
