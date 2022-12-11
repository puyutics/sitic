<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "OC_REMOTECONFIG".
 *
 * @property int $CR_B1
 * @property int $CR_B2
 * @property int $CR_B3
 * @property int $CR_B4
 * @property int $CR_ACTIVO
 */
class OcRemoteconfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'OC_REMOTECONFIG';
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
            [['CR_B1', 'CR_B2', 'CR_B3', 'CR_B4', 'CR_ACTIVO'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CR_B1' => 'Cr B1',
            'CR_B2' => 'Cr B2',
            'CR_B3' => 'Cr B3',
            'CR_B4' => 'Cr B4',
            'CR_ACTIVO' => 'Cr Activo',
        ];
    }
}
