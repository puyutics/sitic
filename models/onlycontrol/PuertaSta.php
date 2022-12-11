<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "PUERTA_STA".
 *
 * @property string $P_ID
 * @property string $P_Fecha
 * @property string $P_Status
 * @property string $P_User
 * @property string $P_Maq
 */
class PuertaSta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PUERTA_STA';
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
            [['P_ID', 'P_Fecha', 'P_User'], 'required'],
            [['P_Fecha'], 'safe'],
            [['P_Status'], 'string'],
            [['P_ID'], 'string', 'max' => 20],
            [['P_User'], 'string', 'max' => 60],
            [['P_Maq'], 'string', 'max' => 30],
            [['P_Fecha', 'P_ID', 'P_User'], 'unique', 'targetAttribute' => ['P_Fecha', 'P_ID', 'P_User']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'P_ID' => 'P ID',
            'P_Fecha' => 'P Fecha',
            'P_Status' => 'P Status',
            'P_User' => 'P User',
            'P_Maq' => 'P Maq',
        ];
    }
}
