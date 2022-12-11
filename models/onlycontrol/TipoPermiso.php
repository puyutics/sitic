<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TIPO_PERMISO".
 *
 * @property string $TIPO_ID
 * @property string $TIPO_NOM
 * @property int $TIPO_COD_N
 * @property int $TIPO_COD_A
 * @property int $TIPO_FACE
 * @property int $TIPO_IRIS
 */
class TipoPermiso extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TIPO_PERMISO';
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
            [['TIPO_ID', 'TIPO_NOM'], 'required'],
            [['TIPO_COD_N', 'TIPO_COD_A', 'TIPO_FACE', 'TIPO_IRIS'], 'integer'],
            [['TIPO_ID'], 'string', 'max' => 5],
            [['TIPO_NOM'], 'string', 'max' => 35],
            [['TIPO_ID', 'TIPO_NOM'], 'unique', 'targetAttribute' => ['TIPO_ID', 'TIPO_NOM']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TIPO_ID' => 'Tipo ID',
            'TIPO_NOM' => 'Tipo Nom',
            'TIPO_COD_N' => 'Tipo Cod N',
            'TIPO_COD_A' => 'Tipo Cod A',
            'TIPO_FACE' => 'Tipo Face',
            'TIPO_IRIS' => 'Tipo Iris',
        ];
    }
}
