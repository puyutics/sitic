<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_EMPRESA_CREDENCIAL".
 *
 * @property string $ID_EMPRESA
 */
class TblEmpresaCredencial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_EMPRESA_CREDENCIAL';
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
            [['ID_EMPRESA'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_EMPRESA' => 'Id Empresa',
        ];
    }
}
