<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "ONLY_CAFECONSULTAS".
 *
 * @property string $CO_NOMBRE
 * @property string $CO_DESCRIPCION
 * @property string $CO_FECHA
 * @property string $CO_MAQ
 */
class OnlyCafeconsultas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ONLY_CAFECONSULTAS';
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
            [['CO_NOMBRE', 'CO_DESCRIPCION'], 'required'],
            [['CO_FECHA'], 'safe'],
            [['CO_NOMBRE'], 'string', 'max' => 50],
            [['CO_DESCRIPCION'], 'string', 'max' => 5000],
            [['CO_MAQ'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CO_NOMBRE' => 'Co Nombre',
            'CO_DESCRIPCION' => 'Co Descripcion',
            'CO_FECHA' => 'Co Fecha',
            'CO_MAQ' => 'Co Maq',
        ];
    }
}
