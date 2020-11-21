<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "becas_cuentas_banc".
 *
 * @property int $id
 * @property string $cedula
 * @property string $nombres
 * @property string $cuenta
 * @property string $tipo
 * @property string $institucion
 * @property string $observaciones
 * @property int $status 0 pendiente 1 recibido
 * @property string $fecha_reg
 */
class BecasCuentasBanc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'becas_cuentas_banc';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_bservicios');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cedula', 'cuenta', 'institucion'], 'required'],
            [['observaciones'], 'string'],
            [['status'], 'integer'],
            [['fecha_reg'], 'safe'],
            [['cedula'], 'string', 'max' => 13],
            [['nombres'], 'string', 'max' => 120],
            [['cuenta'], 'string', 'max' => 20],
            [['tipo'], 'string', 'max' => 15],
            [['institucion'], 'string', 'max' => 100],
            [['cedula'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cedula' => 'Cedula',
            'nombres' => 'Nombres',
            'cuenta' => 'Cuenta',
            'tipo' => 'Tipo',
            'institucion' => 'Institucion',
            'observaciones' => 'Observaciones',
            'status' => '0 pendiente 1 recibido',
            'fecha_reg' => 'Fecha Reg',
        ];
    }
}
