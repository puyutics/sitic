<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "R_MAESTRO".
 *
 * @property string $A_ID
 * @property string $A_TIPO
 * @property string $A_DESCRIPCION
 * @property string $A_UCREA
 * @property string $A_FCREA
 */
class RMaestro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'R_MAESTRO';
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
            [['A_ID', 'A_TIPO'], 'required'],
            [['A_FCREA'], 'safe'],
            [['A_ID', 'A_DESCRIPCION'], 'string', 'max' => 50],
            [['A_TIPO'], 'string', 'max' => 1],
            [['A_UCREA'], 'string', 'max' => 20],
            [['A_ID', 'A_TIPO'], 'unique', 'targetAttribute' => ['A_ID', 'A_TIPO']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'A_ID' => 'A ID',
            'A_TIPO' => 'A Tipo',
            'A_DESCRIPCION' => 'A Descripcion',
            'A_UCREA' => 'A Ucrea',
            'A_FCREA' => 'A Fcrea',
        ];
    }
}
