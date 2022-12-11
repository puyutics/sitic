<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_WEB".
 *
 * @property string $W_ID
 * @property string $W_SOURCE
 * @property string $W_DES
 * @property string $W_URL
 * @property int $W_STATE
 */
class TblWeb extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_WEB';
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
            [['W_ID'], 'required'],
            [['W_ID', 'W_SOURCE'], 'number'],
            [['W_STATE'], 'integer'],
            [['W_DES'], 'string', 'max' => 50],
            [['W_URL'], 'string', 'max' => 60],
            [['W_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'W_ID' => 'W ID',
            'W_SOURCE' => 'W Source',
            'W_DES' => 'W Des',
            'W_URL' => 'W Url',
            'W_STATE' => 'W State',
        ];
    }
}
