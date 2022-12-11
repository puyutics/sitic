<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "CC_GRUPO".
 *
 * @property string $C_MID
 * @property string $C_DES
 * @property string $C_FCREA
 * @property string $C_UCREA
 */
class CcGrupo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CC_GRUPO';
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
            [['C_MID'], 'required'],
            [['C_FCREA'], 'safe'],
            [['C_MID', 'C_DES'], 'string', 'max' => 50],
            [['C_UCREA'], 'string', 'max' => 10],
            [['C_MID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'C_MID' => 'C Mid',
            'C_DES' => 'C Des',
            'C_FCREA' => 'C Fcrea',
            'C_UCREA' => 'C Ucrea',
        ];
    }
}
