<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TMP_JEFES".
 *
 * @property string $NOMINA_COD
 * @property string $NOMINA_JEF
 */
class TmpJefes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TMP_JEFES';
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
            [['NOMINA_COD', 'NOMINA_JEF'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NOMINA_COD' => 'Nomina Cod',
            'NOMINA_JEF' => 'Nomina Jef',
        ];
    }
}
