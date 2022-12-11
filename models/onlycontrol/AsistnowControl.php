<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "ASISTNOW_CONTROL".
 *
 * @property string $ASIS_ID
 * @property string $ASIS_ING
 */
class AsistnowControl extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ASISTNOW_CONTROL';
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
            [['ASIS_ID'], 'required'],
            [['ASIS_ING'], 'safe'],
            [['ASIS_ID'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ASIS_ID' => 'Asis ID',
            'ASIS_ING' => 'Asis Ing',
        ];
    }
}
