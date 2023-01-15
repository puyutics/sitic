<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "NOM_PUERTALOG".
 *
 * @property string $NOM_ID
 * @property string $PUER_ID
 * @property int $TURN_ID
 * @property string $TURN_FECI
 * @property string $TURN_FECF
 * @property int $TURN_TIPO
 * @property int $TURN_STA
 * @property string $TURN_NOW
 * @property string $TURN_DELNOW
 */
class NomPuertalog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NOM_PUERTALOG';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_onlycontrol');
    }

    /*public static function primaryKey()
    {
        return ['TURN_NOW'];
    }*/

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TURN_ID', 'TURN_TIPO', 'TURN_STA'], 'integer'],
            [['TURN_FECI', 'TURN_FECF', 'TURN_NOW', 'TURN_DELNOW'], 'safe'],
            [['NOM_ID'], 'string', 'max' => 6],
            [['PUER_ID'], 'string', 'max' => 4],
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
            'TURN_DELNOW' => 'Turn Delnow',
        ];
    }
}
