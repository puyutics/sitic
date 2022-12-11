<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_SERVER".
 *
 * @property string $PR_ID
 * @property string $PR_UCOD
 * @property int $PR_CODA
 */
class AcServer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_SERVER';
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
            [['PR_ID'], 'required'],
            [['PR_CODA'], 'integer'],
            [['PR_ID', 'PR_UCOD'], 'string', 'max' => 10],
            [['PR_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PR_ID' => 'Pr ID',
            'PR_UCOD' => 'Pr Ucod',
            'PR_CODA' => 'Pr Coda',
        ];
    }
}
