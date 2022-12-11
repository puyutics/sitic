<?php

namespace app\models\sisges;

use Yii;

/**
 * This is the model class for table "tthh_tipo_asistencia".
 *
 * @property string $id_ta
 * @property string $tipo
 * @property string $descripcion
 * @property string $funcion A=aumentar. D=decrementar
 * @property int $status
 * @property int $vacaciones
 *
 * @property TthhAsistencia[] $tthhAsistencias
 */
class TthhTipoAsistencia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tthh_tipo_asistencia';
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
            [['id_ta'], 'required'],
            [['descripcion'], 'string'],
            [['status', 'vacaciones'], 'integer'],
            [['id_ta'], 'string', 'max' => 2],
            [['tipo'], 'string', 'max' => 45],
            [['funcion'], 'string', 'max' => 1],
            [['id_ta'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ta' => 'Id Ta',
            'tipo' => 'Tipo',
            'descripcion' => 'Descripcion',
            'funcion' => 'Funcion',
            'status' => 'Status',
            'vacaciones' => 'Vacaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTthhAsistencias()
    {
        return $this->hasMany(TthhAsistencia::className(), ['idx_tipoasistencia' => 'id_ta']);
    }
}
