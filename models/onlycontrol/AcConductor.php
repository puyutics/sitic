<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_CONDUCTOR".
 *
 * @property string $CO_ID
 * @property string $CO_EMPRESA
 * @property string $CO_FCREA
 * @property string $CO_UCREA
 */
class AcConductor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_CONDUCTOR';
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
            [['CO_ID', 'CO_EMPRESA'], 'required'],
            [['CO_EMPRESA'], 'number'],
            [['CO_FCREA'], 'safe'],
            [['CO_ID', 'CO_UCREA'], 'string', 'max' => 10],
            [['CO_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CO_ID' => 'Co ID',
            'CO_EMPRESA' => 'Co Empresa',
            'CO_FCREA' => 'Co Fcrea',
            'CO_UCREA' => 'Co Ucrea',
        ];
    }
}
