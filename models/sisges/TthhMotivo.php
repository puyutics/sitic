<?php

namespace app\models\sisges;

use Yii;

/**
 * This is the model class for table "tthh_motivo".
 *
 * @property string $id_m
 * @property string $motivo
 * @property string $decripcion
 * @property int $cargo_vacaciones
 * @property string $tiempo_adicional
 * @property int $institucional
 * @property string $tiempo_maximo
 *
 * @property TthhAsistencia[] $tthhAsistencias
 */
class TthhMotivo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tthh_motivo';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_sisges');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_m'], 'required'],
            [['decripcion'], 'string'],
            [['cargo_vacaciones', 'institucional'], 'integer'],
            [['tiempo_adicional', 'tiempo_maximo'], 'number'],
            [['id_m'], 'string', 'max' => 2],
            [['motivo'], 'string', 'max' => 25],
            [['id_m'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_m' => 'Id M',
            'motivo' => 'Motivo',
            'decripcion' => 'Decripcion',
            'cargo_vacaciones' => 'Cargo Vacaciones',
            'tiempo_adicional' => 'Tiempo Adicional',
            'institucional' => 'Institucional',
            'tiempo_maximo' => 'Tiempo Maximo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTthhAsistencias()
    {
        return $this->hasMany(TthhAsistencia::className(), ['idx_motivo' => 'id_m']);
    }
}
