<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "matricula".
 *
 * @property string $idMatricula
 * @property string $idMatricula_anual
 * @property integer $idPer
 * @property string $CIInfPer
 * @property string $idCarr
 * @property integer $idanio
 * @property integer $idsemestre
 * @property string $FechaMatricula
 * @property string $idParalelo
 * @property string $idMatricula_ant
 * @property string $tipoMatricula
 * @property string $statusMatricula
 * @property integer $anulada
 * @property string $observMatricula
 * @property integer $promocion
 * @property string $Usu_registra
 * @property string $Fecha_crea
 * @property string $Usu_modifica
 * @property string $Fecha_ultima_modif
 * @property string $archivo_aprobado
 * @property string $archivo_negado
 * @property string $archivo_anulado
 *
 * @property Estudiantes $cIInfPer
 * @property Carrera $idCarr0
 * @property Periodo $idPer0
 * @property NotasAlumno[] $notasalumnoasignaturas
 */
class MatriculaNivelacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'matricula';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_siad_nivelacion');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idMatricula', 'anulada', 'observMatricula', 'Usu_registra', 'Fecha_crea', 'Usu_modifica', 'Fecha_ultima_modif', 'archivo_aprobado', 'archivo_negado', 'archivo_anulado'], 'required'],
            [['idPer', 'idanio', 'idsemestre', 'anulada', 'promocion'], 'integer'],
            [['FechaMatricula', 'Fecha_crea', 'Fecha_ultima_modif'], 'safe'],
            [['idMatricula', 'idMatricula_anual', 'CIInfPer', 'idMatricula_ant', 'Usu_registra', 'Usu_modifica'], 'string', 'max' => 20],
            [['idCarr'], 'string', 'max' => 6],
            [['idParalelo', 'tipoMatricula'], 'string', 'max' => 1],
            [['statusMatricula'], 'string', 'max' => 10],
            [['observMatricula'], 'string', 'max' => 200],
            [['archivo_aprobado', 'archivo_negado', 'archivo_anulado'], 'string', 'max' => 100],
            [['CIInfPer'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiantes::className(), 'targetAttribute' => ['CIInfPer' => 'CIInfPer']],
            //[['idCarr'], 'exist', 'skipOnError' => true, 'targetClass' => Carrera::className(), 'targetAttribute' => ['idCarr' => 'idCarr']],
            //[['idPer'], 'exist', 'skipOnError' => true, 'targetClass' => Periodo::className(), 'targetAttribute' => ['idPer' => 'idper']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMatricula' => 'Id Matricula',
            'idMatricula_anual' => 'Id Matricula Anual',
            'idPer' => 'Periodo',
            'CIInfPer' => 'Cédula',
            'idCarr' => 'Carrera',
            'idanio' => 'Año',
            'idsemestre' => 'Semestre',
            'FechaMatricula' => 'Fecha Matricula',
            'idParalelo' => 'Paralelo',
            'idMatricula_ant' => 'Id Matricula Ant',
            'tipoMatricula' => 'Tipo Matricula',
            'statusMatricula' => 'Status Matricula',
            'anulada' => 'Anulada',
            'observMatricula' => 'Observ Matricula',
            'promocion' => 'Promocion',
            'Usu_registra' => 'Usu Registra',
            'Fecha_crea' => 'Fecha Crea',
            'Usu_modifica' => 'Usu Modifica',
            'Fecha_ultima_modif' => 'Fecha Ultima Modif',
            'archivo_aprobado' => 'Archivo Aprobado',
            'archivo_negado' => 'Archivo Negado',
            'archivo_anulado' => 'Archivo Anulado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfoEstudiante()
    {
        return $this->hasOne(Estudiantes::className(), ['CIInfPer' => 'CIInfPer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCarr0()
    {
        return $this->hasOne(Carrera::className(), ['idCarr' => 'idCarr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPer0()
    {
        return $this->hasOne(Periodo::className(), ['idper' => 'idPer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotasalumnoasignaturas()
    {
        return $this->hasMany(NotasAlumno::className(), ['idMatricula' => 'idMatricula']);
    }
}
