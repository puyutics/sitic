<?php

namespace app\models\siad_pregrado;

use Yii;

/**
 * This is the model class for table "planificacion_asignatura".
 *
 * @property int $id_plasig
 * @property int $dpa_id
 * @property int $num_unidad
 * @property string $desc_unidad
 * @property string $tema_clase
 * @property string $contenido
 * @property string $metodologia
 * @property int $num_encuentro
 * @property string $fecha
 * @property string $hora_ini_planif hora inicial planificada 
 * @property string $hora_fin_planif hora final de planificacion
 * @property string $fecha_reg fecha de registro de la planificacion
 * @property string $objetivo_plasig objetivo de la planificación de la asignatura
 * @property string $fecha_rcd
 * @property string $hora_inicio
 * @property string $hora_fin
 * @property string $fecha_cierre
 * @property string $hora_cierre
 * @property string $hc_periodo
 * @property int $num_periodos
 * @property string $ip_pcacceso
 * @property string $nomb_pcacceso
 * @property string $observacion
 * @property int $atraso identifica si se inicio clases con atraso
 * @property int $status
 * @property int $ps_id
 * @property string $fecha_recp
 * @property string $hora_ini_recp
 * @property string $hora_fin_recp
 * @property string $autorizacion_recp
 * @property int $estado_asist indica si ya se ha realizado la toma de asistencia para la planificacion de clase
 * @property string $acceso indica el acceso de donde se relalizo a la planificacion
 * @property int $id_amb identificadro del ambiente
 * @property int $habilita_asist permite habilitar el ingreso de   asistencia
 * @property string $usu_habilita_asist idica el usuario que habilitara el registro de asistencia de los estudiantes
 * @property string $usu_habilita_pldoc usuario que habilita la planificacion docente
 * @property int $id_actdist
 * @property int $habilita_frec
 * @property string $usu_habilita_frec
 * @property int $ce_id identificador de control de evidencia
 * @property int $bloqueado_x_parcial
 * @property string $usu_dicta numero unico del usuario que dicta la clase
 * @property int $extra
 * @property int $excluida_x_disposicion pemrite excluir la planificacion por disposicion de no actividad y por justificacion del docente
 * @property string $archivo_justificativo registra el archivo de justificativo del encuentro
 *
 * @property AsistenciaAlumno[] $asistenciaAlumnos
 * @property EvalFrecActividad[] $evalFrecActividads
 */
class PlanificacionAsignatura extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'planificacion_asignatura';
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
            [['dpa_id', 'num_unidad', 'num_encuentro', 'num_periodos', 'atraso', 'status', 'ps_id', 'estado_asist', 'id_amb', 'habilita_asist', 'id_actdist', 'habilita_frec', 'ce_id', 'bloqueado_x_parcial', 'extra', 'excluida_x_disposicion'], 'integer'],
            [['num_unidad', 'contenido', 'hora_ini_planif', 'hora_fin_planif', 'fecha_reg', 'objetivo_plasig', 'atraso', 'ps_id', 'fecha_recp', 'hora_ini_recp', 'hora_fin_recp', 'autorizacion_recp', 'estado_asist', 'acceso', 'id_amb', 'habilita_asist', 'usu_habilita_asist', 'usu_habilita_pldoc', 'usu_habilita_frec', 'usu_dicta'], 'required'],
            [['fecha', 'hora_ini_planif', 'hora_fin_planif', 'fecha_reg', 'fecha_rcd', 'hora_inicio', 'hora_fin', 'fecha_cierre', 'hora_cierre', 'fecha_recp', 'hora_ini_recp', 'hora_fin_recp'], 'safe'],
            [['objetivo_plasig', 'observacion'], 'string'],
            [['desc_unidad', 'tema_clase', 'contenido', 'autorizacion_recp', 'usu_habilita_asist', 'usu_habilita_pldoc'], 'string', 'max' => 200],
            [['metodologia'], 'string', 'max' => 150],
            [['hc_periodo', 'ip_pcacceso', 'usu_dicta'], 'string', 'max' => 20],
            [['nomb_pcacceso', 'usu_habilita_frec'], 'string', 'max' => 30],
            [['acceso'], 'string', 'max' => 100],
            [['archivo_justificativo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_plasig' => 'Id Plasig',
            'dpa_id' => 'Dpa ID',
            'num_unidad' => 'Num Unidad',
            'desc_unidad' => 'Desc Unidad',
            'tema_clase' => 'Tema Clase',
            'contenido' => 'Contenido',
            'metodologia' => 'Metodologia',
            'num_encuentro' => 'Num Encuentro',
            'fecha' => 'Fecha',
            'hora_ini_planif' => 'hora inicial planificada ',
            'hora_fin_planif' => 'hora final de planificacion',
            'fecha_reg' => 'fecha de registro de la planificacion',
            'objetivo_plasig' => 'objetivo de la planificación de la asignatura',
            'fecha_rcd' => 'Fecha Rcd',
            'hora_inicio' => 'Hora Inicio',
            'hora_fin' => 'Hora Fin',
            'fecha_cierre' => 'Fecha Cierre',
            'hora_cierre' => 'Hora Cierre',
            'hc_periodo' => 'Hc Periodo',
            'num_periodos' => 'Num Periodos',
            'ip_pcacceso' => 'Ip Pcacceso',
            'nomb_pcacceso' => 'Nomb Pcacceso',
            'observacion' => 'Observacion',
            'atraso' => 'identifica si se inicio clases con atraso',
            'status' => 'Status',
            'ps_id' => 'Ps ID',
            'fecha_recp' => 'Fecha Recp',
            'hora_ini_recp' => 'Hora Ini Recp',
            'hora_fin_recp' => 'Hora Fin Recp',
            'autorizacion_recp' => 'Autorizacion Recp',
            'estado_asist' => 'indica si ya se ha realizado la toma de asistencia para la planificacion de clase',
            'acceso' => 'indica el acceso de donde se relalizo a la planificacion',
            'id_amb' => 'identificadro del ambiente',
            'habilita_asist' => 'permite habilitar el ingreso de 

asistencia',
            'usu_habilita_asist' => 'idica el usuario que habilitara el registro de asistencia de los estudiantes',
            'usu_habilita_pldoc' => 'usuario que habilita la planificacion docente',
            'id_actdist' => 'Id Actdist',
            'habilita_frec' => 'Habilita Frec',
            'usu_habilita_frec' => 'Usu Habilita Frec',
            'ce_id' => 'identificador de control de evidencia',
            'bloqueado_x_parcial' => 'Bloqueado X Parcial',
            'usu_dicta' => 'numero unico del usuario que dicta la clase',
            'extra' => 'Extra',
            'excluida_x_disposicion' => 'pemrite excluir la planificacion por disposicion de no actividad y por justificacion del docente',
            'archivo_justificativo' => 'registra el archivo de justificativo del encuentro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsistenciaAlumnos()
    {
        return $this->hasMany(AsistenciaAlumno::className(), ['id_plasig' => 'id_plasig']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvalFrecActividads()
    {
        return $this->hasMany(EvalFrecActividad::className(), ['id_plasig' => 'id_plasig']);
    }
}
