<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "NOM_PUERTAEX".
 *
 * @property string $NOM_ID
 * @property string $TURN_FEC
 * @property string $TURN_USER
 * @property string $TURN_NOW
 */
class NomPuertaex extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NOM_PUERTAEX';
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
            [['NOM_ID', 'TURN_FEC'], 'required'],
            [['TURN_FEC', 'TURN_NOW'], 'safe'],
            [['NOM_ID'], 'string', 'max' => 6],
            [['TURN_USER'], 'string', 'max' => 20],
            [['NOM_ID', 'TURN_FEC'], 'unique', 'targetAttribute' => ['NOM_ID', 'TURN_FEC']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NOM_ID' => 'Nom ID',
            'TURN_FEC' => 'Turn Fec',
            'TURN_USER' => 'Turn User',
            'TURN_NOW' => 'Turn Now',
        ];
    }
}
