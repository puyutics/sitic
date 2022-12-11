<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "OC_FESTIVOS".
 *
 * @property string $D_FESTIVO
 * @property string $D_DESC
 * @property string $D_LOCALD
 * @property string $D_UCREA
 * @property string $D_FCREA
 */
class OcFestivos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'OC_FESTIVOS';
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
            [['D_FESTIVO', 'D_DESC'], 'required'],
            [['D_FESTIVO', 'D_FCREA'], 'safe'],
            [['D_DESC', 'D_LOCALD'], 'string', 'max' => 50],
            [['D_UCREA'], 'string', 'max' => 10],
            [['D_FESTIVO'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'D_FESTIVO' => 'D Festivo',
            'D_DESC' => 'D Desc',
            'D_LOCALD' => 'D Locald',
            'D_UCREA' => 'D Ucrea',
            'D_FCREA' => 'D Fcrea',
        ];
    }
}
