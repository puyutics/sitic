<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "matricula".
 *
 * @property string $idMatricula
 * @property string $idMatricula_anual identificador de matricula anual que correspnde al total de ciclos en el aÃ±o y se mostrara en las matriculas independientes y libro de matriculas
 * @property int $idPer
 * @property string $CIInfPer
 * @property string $idCarr
 * @property int $idanio
 * @property int $idsemestre
 * @property string $FechaMatricula
 * @property string $idParalelo
 * @property string $idMatricula_ant
 * @property string $tipoMatricula
 * @property string $statusMatricula
 * @property int $anulada INDICA SI LA MATRICULA HA SIDO ANULADA
 * @property string $observMatricula observacion de la matricula si se presenta alguna
 * @property int $promocion indica si el estudiante cn la matricula fue promovido 1=promovido 0=no promovido
 * @property string $Usu_registra usuario que crea el registro
 * @property string $Usu_legaliza
 * @property string $Fecha_crea fecha que se crea el registro
 * @property string $Usu_modifica usuario que modifica el registro
 * @property string $Fecha_ultima_modif Fecha de ultima modificaciÃ³n del registro
 * @property string $archivo_aprobado
 * @property string $archivo_retirado
 * @property string $archivo_anulado
 * @property string $leg_observacion
 *
 * @property EstudiantesPosgrado $cIInfPer
 * @property CarreraPosgrado $carr
 * @property PeriodoPosgrado $per
 * @property NotasAlumnoPosgrado[] $notasalumnoasignaturas
 */
class MatriculaPosgrado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
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
        return Yii::$app->get('db_siad_posgrado');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idMatricula', 'anulada', 'observMatricula', 'Usu_registra', 'Fecha_crea', 'Usu_modifica', 'Fecha_ultima_modif', 'archivo_aprobado', 'archivo_retirado', 'archivo_anulado'], 'required'],
            [['idPer', 'idanio', 'idsemestre', 'anulada', 'promocion'], 'integer'],
            [['FechaMatricula', 'Fecha_crea', 'Fecha_ultima_modif'], 'safe'],
            [['idMatricula', 'idMatricula_anual', 'CIInfPer', 'idMatricula_ant'], 'string', 'max' => 20],
            [['idCarr'], 'string', 'max' => 6],
            [['idParalelo', 'tipoMatricula'], 'string', 'max' => 1],
            [['statusMatricula'], 'string', 'max' => 10],
            [['observMatricula', 'Usu_legaliza', 'Usu_modifica', 'leg_observacion'], 'string', 'max' => 200],
            [['Usu_registra'], 'string', 'max' => 60],
            [['archivo_aprobado', 'archivo_retirado', 'archivo_anulado'], 'string', 'max' => 100],
            [['idMatricula'], 'unique'],
            [['CIInfPer'], 'exist', 'skipOnError' => true, 'targetClass' => EstudiantesPosgrado::className(), 'targetAttribute' => ['CIInfPer' => 'CIInfPer']],
            [['idCarr'], 'exist', 'skipOnError' => true, 'targetClass' => Carrera::className(), 'targetAttribute' => ['idCarr' => 'idCarr']],
            [['idPer'], 'exist', 'skipOnError' => true, 'targetClass' => PeriodoPosgrado::className(), 'targetAttribute' => ['idPer' => 'idper']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idMatricula' => 'Id Matricula',
            'idMatricula_anual' => 'Id Matricula Anual',
            'idPer' => 'Id Per',
            'CIInfPer' => 'Ci Inf Per',
            'idCarr' => 'Id Carr',
            'idanio' => 'Idanio',
            'idsemestre' => 'Idsemestre',
            'FechaMatricula' => 'Fecha Matricula',
            'idParalelo' => 'Id Paralelo',
            'idMatricula_ant' => 'Id Matricula Ant',
            'tipoMatricula' => 'Tipo Matricula',
            'statusMatricula' => 'Status Matricula',
            'anulada' => 'Anulada',
            'observMatricula' => 'Observ Matricula',
            'promocion' => 'Promocion',
            'Usu_registra' => 'Usu Registra',
            'Usu_legaliza' => 'Usu Legaliza',
            'Fecha_crea' => 'Fecha Crea',
            'Usu_modifica' => 'Usu Modifica',
            'Fecha_ultima_modif' => 'Fecha Ultima Modif',
            'archivo_aprobado' => 'Archivo Aprobado',
            'archivo_retirado' => 'Archivo Retirado',
            'archivo_anulado' => 'Archivo Anulado',
            'leg_observacion' => 'Leg Observacion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCIInfPer()
    {
        return $this->hasOne(EstudiantesPosgrado::className(), ['CIInfPer' => 'CIInfPer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarr()
    {
        return $this->hasOne(CarreraPosgrado::className(), ['idCarr' => 'idCarr']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPer()
    {
        return $this->hasOne(PeriodoPosgrado::className(), ['idper' => 'idPer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotasalumnoasignaturas()
    {
        return $this->hasMany(NotasAlumnoPosgrado::className(), ['idMatricula' => 'idMatricula']);
    }
}
