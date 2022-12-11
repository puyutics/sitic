<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "NOM_PUERTA_CAFE".
 *
 * @property string $NOM_ID
 * @property string $PUER_ID
 * @property int $TURN_ID
 * @property string $TURN_FECI
 * @property string $TURN_FECF
 * @property int $TURN_TIPO
 * @property int $TURN_STA
 * @property string $TURN_NOW
 * @property int $TURN_MARCA
 * @property string $TURN_TCOD
 */
class NomPuertaCafe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NOM_PUERTA_CAFE';
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
            [['NOM_ID', 'PUER_ID', 'TURN_ID'], 'required'],
            [['TURN_ID', 'TURN_TIPO', 'TURN_STA', 'TURN_MARCA'], 'integer'],
            [['TURN_FECI', 'TURN_FECF', 'TURN_NOW'], 'safe'],
            [['NOM_ID'], 'string', 'max' => 6],
            [['PUER_ID'], 'string', 'max' => 4],
            [['TURN_TCOD'], 'string', 'max' => 5],
            [['NOM_ID', 'PUER_ID', 'TURN_ID'], 'unique', 'targetAttribute' => ['NOM_ID', 'PUER_ID', 'TURN_ID']],
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
            'TURN_MARCA' => 'Turn Marca',
            'TURN_TCOD' => 'Turn Tcod',
        ];
    }
}
