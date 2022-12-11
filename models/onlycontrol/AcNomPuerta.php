<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_NOM_PUERTA".
 *
 * @property string $NOM_ID
 * @property string $PUER_ID
 * @property int $TURN_ID
 * @property string $TURN_FECI
 * @property string $TURN_FECF
 * @property int $TURN_TIPO
 * @property int $TURN_STA
 * @property string $TURN_NOW
 *
 * @property Nomina $nOM
 * @property AcPuerta $pUER
 */
class AcNomPuerta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_NOM_PUERTA';
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
            [['NOM_ID', 'PUER_ID'], 'required'],
            [['TURN_ID', 'TURN_TIPO', 'TURN_STA'], 'integer'],
            [['TURN_FECI', 'TURN_FECF', 'TURN_NOW'], 'safe'],
            [['NOM_ID'], 'string', 'max' => 6],
            [['PUER_ID'], 'string', 'max' => 4],
            [['NOM_ID', 'PUER_ID'], 'unique', 'targetAttribute' => ['NOM_ID', 'PUER_ID']],
            [['NOM_ID'], 'exist', 'skipOnError' => true, 'targetClass' => Nomina::className(), 'targetAttribute' => ['NOM_ID' => 'NOMINA_ID']],
            [['PUER_ID'], 'exist', 'skipOnError' => true, 'targetClass' => AcPuerta::className(), 'targetAttribute' => ['PUER_ID' => 'PRT_COD']],
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
            'TURN_TIPO' => 'Turn Tipo',
            'TURN_STA' => 'Turn Sta',
            'TURN_NOW' => 'Turn Now',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOM()
    {
        return $this->hasOne(Nomina::className(), ['NOMINA_ID' => 'NOM_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPUER()
    {
        return $this->hasOne(AcPuerta::className(), ['PRT_COD' => 'PUER_ID']);
    }
}
