<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_EXCEP".
 *
 * @property string $EX_NOMINA
 * @property string $EX_NOMBRE
 * @property string $EX_TIPO
 * @property string $EX_MENU
 * @property string $EX_FECHA1
 * @property string $EX_FECHA2
 */
class TblExcep extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_EXCEP';
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
            [['EX_NOMINA', 'EX_NOMBRE', 'EX_TIPO', 'EX_MENU', 'EX_FECHA1', 'EX_FECHA2'], 'required'],
            [['EX_FECHA1', 'EX_FECHA2'], 'safe'],
            [['EX_NOMINA'], 'string', 'max' => 10],
            [['EX_NOMBRE'], 'string', 'max' => 100],
            [['EX_TIPO', 'EX_MENU'], 'string', 'max' => 20],
            [['EX_NOMINA'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'EX_NOMINA' => 'Ex Nomina',
            'EX_NOMBRE' => 'Ex Nombre',
            'EX_TIPO' => 'Ex Tipo',
            'EX_MENU' => 'Ex Menu',
            'EX_FECHA1' => 'Ex Fecha1',
            'EX_FECHA2' => 'Ex Fecha2',
        ];
    }
}
