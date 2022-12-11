<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_ACTIVIDAD".
 *
 * @property string $ACT_ID
 * @property string $ACT_NOM
 * @property string $ACT_DES
 * @property string $ACT_FCREA
 * @property string $ACT_UCREA
 */
class AcActividad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_ACTIVIDAD';
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
            [['ACT_FCREA'], 'safe'],
            [['ACT_NOM', 'ACT_DES'], 'string', 'max' => 100],
            [['ACT_UCREA'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ACT_ID' => 'Act ID',
            'ACT_NOM' => 'Act Nom',
            'ACT_DES' => 'Act Des',
            'ACT_FCREA' => 'Act Fcrea',
            'ACT_UCREA' => 'Act Ucrea',
        ];
    }
}
