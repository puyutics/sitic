<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "CR_DATOS".
 *
 * @property string $CR_ID
 * @property string $CR_C0
 * @property string $CR_C1
 * @property string $CR_C2
 * @property string $CR_C3
 * @property string $CR_C4
 * @property string $CR_C5
 */
class CrDatos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CR_DATOS';
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
            [['CR_ID'], 'required'],
            [['CR_ID'], 'string', 'max' => 10],
            [['CR_C0', 'CR_C1', 'CR_C2', 'CR_C3', 'CR_C4', 'CR_C5'], 'string', 'max' => 50],
            [['CR_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CR_ID' => 'Cr ID',
            'CR_C0' => 'Cr C0',
            'CR_C1' => 'Cr C1',
            'CR_C2' => 'Cr C2',
            'CR_C3' => 'Cr C3',
            'CR_C4' => 'Cr C4',
            'CR_C5' => 'Cr C5',
        ];
    }
}
