<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_PERFIL_NOMINA".
 *
 * @property string $NOMINA
 * @property int $PERFIL
 */
class TblPerfilNomina extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_PERFIL_NOMINA';
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
            [['PERFIL'], 'integer'],
            [['NOMINA'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NOMINA' => 'Nomina',
            'PERFIL' => 'Perfil',
        ];
    }
}
