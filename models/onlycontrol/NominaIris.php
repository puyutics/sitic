<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "NOMINA_IRIS".
 *
 * @property string $NOMINA_ID
 * @property resource $IRIS_TEMPLATE1
 * @property resource $IRIS_TEMPLATE2
 * @property resource $IRIS_CAPTURE
 */
class NominaIris extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NOMINA_IRIS';
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
            [['NOMINA_ID'], 'required'],
            [['IRIS_TEMPLATE1', 'IRIS_TEMPLATE2', 'IRIS_CAPTURE'], 'string'],
            [['NOMINA_ID'], 'string', 'max' => 8],
            [['NOMINA_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NOMINA_ID' => 'Nomina ID',
            'IRIS_TEMPLATE1' => 'Iris Template1',
            'IRIS_TEMPLATE2' => 'Iris Template2',
            'IRIS_CAPTURE' => 'Iris Capture',
        ];
    }
}
