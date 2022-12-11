<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "dtproperties".
 *
 * @property int $id
 * @property int $objectid
 * @property string $property
 * @property string $value
 * @property string $uvalue
 * @property resource $lvalue
 * @property int $version
 */
class Dtproperties extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dtproperties';
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
            [['objectid', 'version'], 'integer'],
            [['property'], 'required'],
            [['lvalue'], 'string'],
            [['property'], 'string', 'max' => 64],
            [['value', 'uvalue'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'objectid' => 'Objectid',
            'property' => 'Property',
            'value' => 'Value',
            'uvalue' => 'Uvalue',
            'lvalue' => 'Lvalue',
            'version' => 'Version',
        ];
    }
}
