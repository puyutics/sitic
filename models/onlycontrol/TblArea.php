<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_AREA".
 *
 * @property string $A_ID
 * @property string $A_DESCRIPCION
 * @property string $nomina_tipo
 * @property int $A_PLANIFICADO
 * @property string $A_FECHAI
 * @property string $A_FECHAF
 * @property int $A_MAXCOMIDA
 */
class TblArea extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_AREA';
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
            [['A_ID', 'A_DESCRIPCION', 'nomina_tipo', 'A_FECHAI', 'A_FECHAF'], 'required'],
            [['A_PLANIFICADO', 'A_MAXCOMIDA'], 'integer'],
            [['A_FECHAI', 'A_FECHAF'], 'safe'],
            [['A_ID'], 'string', 'max' => 10],
            [['A_DESCRIPCION', 'nomina_tipo'], 'string', 'max' => 20],
            [['A_DESCRIPCION', 'A_ID', 'nomina_tipo'], 'unique', 'targetAttribute' => ['A_DESCRIPCION', 'A_ID', 'nomina_tipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'A_ID' => 'A ID',
            'A_DESCRIPCION' => 'A Descripcion',
            'nomina_tipo' => 'Nomina Tipo',
            'A_PLANIFICADO' => 'A Planificado',
            'A_FECHAI' => 'A Fechai',
            'A_FECHAF' => 'A Fechaf',
            'A_MAXCOMIDA' => 'A Maxcomida',
        ];
    }
}
