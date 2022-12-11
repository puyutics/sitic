<?php

namespace app\models\siad_pregrado;

use Yii;

/**
 * This is the model class for table "estudiante_organizacionmalla".
 *
 * @property int $id_orgmalla
 * @property string $CIInfPer
 * @property string $tipo_orgmalla
 * @property int $estado_orgmalla
 * @property int $anio_mallacurricular
 * @property int $regimen_academico identifica el regimen academico del estudiante
 * @property string $idcarr
 * @property int $idcarr_relacionada
 *
 * @property HabilitadosTitulacion[] $habilitadosTitulacions
 */
class EstudiantesMalla extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estudiante_organizacionmalla';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_siad');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estado_orgmalla', 'anio_mallacurricular', 'regimen_academico', 'idcarr_relacionada'], 'integer'],
            [['anio_mallacurricular', 'regimen_academico', 'idcarr'], 'required'],
            [['CIInfPer'], 'string', 'max' => 20],
            [['tipo_orgmalla'], 'string', 'max' => 2],
            [['idcarr'], 'string', 'max' => 6],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_orgmalla' => 'Id Orgmalla',
            'CIInfPer' => 'Ci Inf Per',
            'tipo_orgmalla' => 'Tipo Orgmalla',
            'estado_orgmalla' => 'Estado Orgmalla',
            'anio_mallacurricular' => 'Anio Mallacurricular',
            'regimen_academico' => 'Regimen Academico',
            'idcarr' => 'Idcarr',
            'idcarr_relacionada' => 'Idcarr Relacionada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHabilitadosTitulacions()
    {
        return $this->hasMany(HabilitadosTitulacion::className(), ['id_orgmalla' => 'id_orgmalla']);
    }
}
