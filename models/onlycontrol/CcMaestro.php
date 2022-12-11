<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "CC_MAESTRO".
 *
 * @property string $CC_ID
 * @property string $CC_NOM
 * @property string $CC_FCREA
 * @property string $CC_UCREA
 * @property string $CC_ORG
 */
class CcMaestro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CC_MAESTRO';
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
            [['CC_ID', 'CC_NOM'], 'required'],
            [['CC_FCREA'], 'safe'],
            [['CC_ID', 'CC_UCREA'], 'string', 'max' => 10],
            [['CC_NOM', 'CC_ORG'], 'string', 'max' => 50],
            [['CC_NOM'], 'unique'],
            [['CC_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CC_ID' => 'Cc ID',
            'CC_NOM' => 'Cc Nom',
            'CC_FCREA' => 'Cc Fcrea',
            'CC_UCREA' => 'Cc Ucrea',
            'CC_ORG' => 'Cc Org',
        ];
    }
}
