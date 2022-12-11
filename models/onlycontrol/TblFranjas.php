<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_FRANJAS".
 *
 * @property string $FJ_ID
 * @property string $FJ_NOMBRE
 * @property string $FJ_FECHACREA
 */
class TblFranjas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_FRANJAS';
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
            [['FJ_NOMBRE'], 'required'],
            [['FJ_FECHACREA'], 'safe'],
            [['FJ_NOMBRE'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FJ_ID' => 'Fj ID',
            'FJ_NOMBRE' => 'Fj Nombre',
            'FJ_FECHACREA' => 'Fj Fechacrea',
        ];
    }
}
