<?php

namespace app\models\parkingcontrol;

use Yii;

/**
 * This is the model class for table "NOM_PUERTA".
 *
 * @property string $NOM_ID
 * @property string $PUER_ID
 * @property int $TURN_ID
 * @property string $TURN_FECI
 * @property string $TURN_FECF
 * @property int $TURN_TIPO 1
 * @property int $TURN_STA 0 Control Activo 1 Sin Control
 * @property string $TURN_NOW
 * @property int $TURN_MARCA
 * @property string $TURN_TCOD
 * @property string $TURN_SEL
 * @property string $TURN_ESTADO_UP
 * @property string $TURN_FECHA_UP
 *
 * @property NOMINA $nOM
 * @property PUERTA $pUER
 */
class NomPuerta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NOM_PUERTA';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_parkingcontrol');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NOM_ID', 'PUER_ID'], 'required'],
            [['TURN_ID', 'TURN_TIPO', 'TURN_STA', 'TURN_MARCA'], 'integer'],
            [['TURN_FECI', 'TURN_FECF', 'TURN_NOW', 'TURN_FECHA_UP'], 'safe'],
            [['TURN_ESTADO_UP'], 'number'],
            [['NOM_ID'], 'string', 'max' => 6],
            [['PUER_ID'], 'string', 'max' => 4],
            [['TURN_TCOD'], 'string', 'max' => 5],
            [['TURN_SEL'], 'string', 'max' => 1],
            [['NOM_ID', 'PUER_ID'], 'unique', 'targetAttribute' => ['NOM_ID', 'PUER_ID']],
            [['NOM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => NOMINA::className(), 'targetAttribute' => ['NOM_ID' => 'NOMINA_ID']],
            [['PUER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => PUERTA::className(), 'targetAttribute' => ['PUER_ID' => 'PRT_COD']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NOM_ID' => 'Nom ID',
            'PUER_ID' => 'Puer ID',
            'TURN_ID' => 'Turn ID',
            'TURN_FECI' => 'Turn Feci',
            'TURN_FECF' => 'Turn Fecf',
            'TURN_TIPO' => '1',
            'TURN_STA' => '0 Control Activo 1 Sin Control',
            'TURN_NOW' => 'Turn Now',
            'TURN_MARCA' => 'Turn Marca',
            'TURN_TCOD' => 'Turn Tcod',
            'TURN_SEL' => 'Turn Sel',
            'TURN_ESTADO_UP' => 'Turn Estado Up',
            'TURN_FECHA_UP' => 'Turn Fecha Up',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOM()
    {
        return $this->hasOne(NOMINA::className(), ['NOMINA_ID' => 'NOM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPUER()
    {
        return $this->hasOne(PUERTA::className(), ['PRT_COD' => 'PUER_ID']);
    }
}
