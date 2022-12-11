<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "NOM_PUERTA_DEL".
 *
 * @property string $NOM_ID
 * @property string $PUER_ID
 * @property string $FLAG_T
 * @property string $TURN_ESTADO_DEL
 * @property string $TURN_FECHA_DEL
 */
class NomPuertaDel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NOM_PUERTA_DEL';
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
            [['FLAG_T', 'TURN_ESTADO_DEL'], 'number'],
            [['TURN_FECHA_DEL'], 'safe'],
            [['NOM_ID', 'PUER_ID'], 'string', 'max' => 6],
            [['NOM_ID', 'PUER_ID'], 'unique', 'targetAttribute' => ['NOM_ID', 'PUER_ID']],
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
            'FLAG_T' => 'Flag T',
            'TURN_ESTADO_DEL' => 'Turn Estado Del',
            'TURN_FECHA_DEL' => 'Turn Fecha Del',
        ];
    }
}
