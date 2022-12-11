<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_ADMIN_EMPRESA".
 *
 * @property string $ID_NOMINA
 * @property int $ID_EMPE
 */
class TblAdminEmpresa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_ADMIN_EMPRESA';
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
            [['ID_EMPE'], 'integer'],
            [['ID_NOMINA'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_NOMINA' => 'Id Nomina',
            'ID_EMPE' => 'Id Empe',
        ];
    }
}
