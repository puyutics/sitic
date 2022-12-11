<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TMP_LISTA".
 *
 * @property string $TMP_ID
 */
class TmpLista extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TMP_LISTA';
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
            [['TMP_ID'], 'required'],
            [['TMP_ID'], 'string', 'max' => 10],
            [['TMP_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TMP_ID' => 'Tmp ID',
        ];
    }
}
