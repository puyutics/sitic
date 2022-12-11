<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "EQUIPOS_CORRIGE".
 *
 * @property string $EC_IDEQUIPO
 * @property string $EC_TIPOCORRIGE
 * @property string $EC_FRANJAS
 * @property string $EC_FECHAREGISTRO
 */
class EquiposCorrige extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'EQUIPOS_CORRIGE';
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
            [['EC_IDEQUIPO'], 'required'],
            [['EC_FRANJAS'], 'number'],
            [['EC_FECHAREGISTRO'], 'safe'],
            [['EC_IDEQUIPO'], 'string', 'max' => 4],
            [['EC_TIPOCORRIGE'], 'string', 'max' => 20],
            [['EC_IDEQUIPO'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'EC_IDEQUIPO' => 'Ec Idequipo',
            'EC_TIPOCORRIGE' => 'Ec Tipocorrige',
            'EC_FRANJAS' => 'Ec Franjas',
            'EC_FECHAREGISTRO' => 'Ec Fecharegistro',
        ];
    }
}
