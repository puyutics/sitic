<?php

namespace app\models\siad_posgrado;

use Yii;

/**
 * This is the model class for table "notasalumnoasignatura".
 *
 * @property string $idnaa
 * @property string $CIInfPer Nro de cedula del estudiante
 * @property string $idAsig Codigo de la asignatura
 * @property int $idPer Codigo del periodo lectivo
 * @property string $CAC1 Primera calificaciÃ³n 
 
 acumulativa
 * @property string $CAC2 Segunda calififcaciÃ³n 
 
 acumulativa
 * @property string $CAC3 Tercera calififcaciÃ³n 
 
 acumulativa
 * @property string $CAC4 Promedio calificaciones 
 
 acumulativas
 * @property string $CAC5 CalificaciÃ³n evaluaciÃ³n 
 
 Final
 * @property string $CSP CalificaciÃ³n supletorio
 * @property string $CCR calificacion curso 
 
 intensivo
 * @property string $CSP2 CalificaciÃ³n examen 
 
 suficiencia
 * @property string $CalifFinal Calificacion 
 
 final promediada
 * @property int $asistencia porcentaje de asistencia del estudiante en la asignatura
 * @property int $StatusCalif estado de la calificacion
 * @property string $idMatricula coidgo de matricula del estudiante en el periodo lectivo
 * @property int $VRepite Veces que repite la asignatura
 * @property string $observacion
 * @property int $op1 indica si el estudiante dio examen supletorio
 * @property int $op2 si el estudante tomo curso remediar
 * @property int $op3 indica si el estudiante dio examen suficiencia
 * @property int $pierde_x_asistencia indica si el estudiante pierde por asistencia
 * @property int $pierde_x_ppf
 * @property int $repite indica si el estudiante repite asignatura
 * @property int $retirado si se retira de la asignatura o desertor
 * @property int $excluidaxrepitencia se excluye si el estudiante pierde y toma nuevamente las asignatura
 * @property int $excluidaxreingreso se excluye la asignatura si ele studiante reingresa a la carrera
 * @property int $excluidaxresolucion
 * @property int $convalidacion indica si la asignatura es convalidacion
 * @property int $aprobada indica si la asignatura esta aprobada
 * @property int $anulada indentifica si una asignatura ha sidoa anuladada
 * @property int $arrastre si se trata de una asignatura de arrastre
 * @property string $registro_asistencia registra la fecha de transferencia de la asistencia
 * @property string $usu_registro_asistencia usuario que registro la asistencia
 * @property string $registro fecha de registro de la calificacion
 * @property string $ultima_modificacion
 * @property string $usu_pregistro usuario que realizo el 
 
 primer registro de la calificacion
 * @property string $usu_umodif_registro usuario que 
 
 realiza la ultima modificacion del registro
 * @property string $archivo
 * @property double $idMc
 * @property string $institucion_proviene institucion de la cual proviene el estudiante
 * @property string $porcentaje_convalidacion porcentaje que da en la convalidacion a la asignatura
 * @property int $exam_final_atrasado
 * @property int $exam_supl_atrasado
 * @property string $observacion_efa comentario habilitacion examen 
 
 final
 * @property string $observacion_espa comentario habilitacion supletorio
 * @property string $usu_habilita_efa usuario que habilita examen final
 * @property string $usu_habilita_espa usuario que habilita supletorio
 * @property int $dpa_id
 *
 * @property AsistenciaAlumno[] $asistenciaAlumnos
 * @property AsistenciaAlumno[] $asistenciaAlumnos0
 * @property AsistenciaAlumno[] $asistenciaAlumnos1
 * @property Califfinalalumnoasig[] $califfinalalumnoasigs
 * @property Califfinalalumnoasig[] $califfinalalumnoasigs0
 * @property Califfrecuentealumnoasig[] $califfrecuentealumnoasigs
 * @property Califfrecuentealumnoasig[] $califfrecuentealumnoasigs0
 * @property Califparcialalumnoasig[] $califparcialalumnoasigs
 * @property Califparcialalumnoasig[] $califparcialalumnoasigs0
 * @property Informacionpersonal $cIInfPer
 * @property Periodolectivo $per
 * @property Matricula $matricula
 */
class NotasAlumnoPosgrado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notasalumnoasignatura';
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
            [['CIInfPer', 'observacion', 'op1', 'op2', 'op3', 'pierde_x_asistencia', 'pierde_x_ppf', 'repite', 'retirado', 'excluidaxrepitencia', 'excluidaxreingreso', 'convalidacion', 'aprobada', 'anulada', 'arrastre', 'registro_asistencia', 'usu_registro_asistencia', 'registro', 'ultima_modificacion', 'usu_pregistro', 'usu_umodif_registro', 'archivo', 'idMc', 'institucion_proviene', 'porcentaje_convalidacion', 'exam_final_atrasado', 'exam_supl_atrasado', 'observacion_efa', 'observacion_espa', 'usu_habilita_efa', 'usu_habilita_espa', 'dpa_id'], 'required'],
            [['idPer', 'asistencia', 'StatusCalif', 'VRepite', 'op1', 'op2', 'op3', 'pierde_x_asistencia', 'pierde_x_ppf', 'repite', 'retirado', 'excluidaxrepitencia', 'excluidaxreingreso', 'excluidaxresolucion', 'convalidacion', 'aprobada', 'anulada', 'arrastre', 'exam_final_atrasado', 'exam_supl_atrasado', 'dpa_id'], 'integer'],
            [['CAC1', 'CAC2', 'CAC3', 'CAC4', 'CAC5', 'CSP', 'CCR', 'CSP2', 'CalifFinal', 'idMc'], 'number'],
            [['registro_asistencia', 'registro', 'ultima_modificacion'], 'safe'],
            [['CIInfPer', 'idMatricula'], 'string', 'max' => 20],
            [['idAsig'], 'string', 'max' => 10],
            [['observacion', 'observacion_efa', 'observacion_espa'], 'string', 'max' => 200],
            [['usu_registro_asistencia', 'usu_pregistro', 'usu_habilita_efa', 'usu_habilita_espa'], 'string', 'max' => 60],
            [['usu_umodif_registro'], 'string', 'max' => 255],
            [['archivo', 'institucion_proviene'], 'string', 'max' => 100],
            [['porcentaje_convalidacion'], 'string', 'max' => 5],
            [['CIInfPer'], 'exist', 'skipOnError' => true, 'targetClass' => Informacionpersonal::className(), 'targetAttribute' => ['CIInfPer' => 'CIInfPer']],
            [['idPer'], 'exist', 'skipOnError' => true, 'targetClass' => Periodolectivo::className(), 'targetAttribute' => ['idPer' => 'idper']],
            [['idMatricula'], 'exist', 'skipOnError' => true, 'targetClass' => Matricula::className(), 'targetAttribute' => ['idMatricula' => 'idMatricula']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idnaa' => 'Idnaa',
            'CIInfPer' => 'Ci Inf Per',
            'idAsig' => 'Id Asig',
            'idPer' => 'Id Per',
            'CAC1' => 'Cac 1',
            'CAC2' => 'Cac 2',
            'CAC3' => 'Cac 3',
            'CAC4' => 'Cac 4',
            'CAC5' => 'Cac 5',
            'CSP' => 'Csp',
            'CCR' => 'Ccr',
            'CSP2' => 'Csp 2',
            'CalifFinal' => 'Calif Final',
            'asistencia' => 'Asistencia',
            'StatusCalif' => 'Status Calif',
            'idMatricula' => 'Id Matricula',
            'VRepite' => 'V Repite',
            'observacion' => 'Observacion',
            'op1' => 'Op 1',
            'op2' => 'Op 2',
            'op3' => 'Op 3',
            'pierde_x_asistencia' => 'Pierde X Asistencia',
            'pierde_x_ppf' => 'Pierde X Ppf',
            'repite' => 'Repite',
            'retirado' => 'Retirado',
            'excluidaxrepitencia' => 'Excluidaxrepitencia',
            'excluidaxreingreso' => 'Excluidaxreingreso',
            'excluidaxresolucion' => 'Excluidaxresolucion',
            'convalidacion' => 'Convalidacion',
            'aprobada' => 'Aprobada',
            'anulada' => 'Anulada',
            'arrastre' => 'Arrastre',
            'registro_asistencia' => 'Registro Asistencia',
            'usu_registro_asistencia' => 'Usu Registro Asistencia',
            'registro' => 'Registro',
            'ultima_modificacion' => 'Ultima Modificacion',
            'usu_pregistro' => 'Usu Pregistro',
            'usu_umodif_registro' => 'Usu Umodif Registro',
            'archivo' => 'Archivo',
            'idMc' => 'Id Mc',
            'institucion_proviene' => 'Institucion Proviene',
            'porcentaje_convalidacion' => 'Porcentaje Convalidacion',
            'exam_final_atrasado' => 'Exam Final Atrasado',
            'exam_supl_atrasado' => 'Exam Supl Atrasado',
            'observacion_efa' => 'Observacion Efa',
            'observacion_espa' => 'Observacion Espa',
            'usu_habilita_efa' => 'Usu Habilita Efa',
            'usu_habilita_espa' => 'Usu Habilita Espa',
            'dpa_id' => 'Dpa ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsistenciaAlumnos()
    {
        return $this->hasMany(AsistenciaAlumno::className(), ['idnaa' => 'idnaa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsistenciaAlumnos0()
    {
        return $this->hasMany(AsistenciaAlumno::className(), ['idnaa' => 'idnaa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAsistenciaAlumnos1()
    {
        return $this->hasMany(AsistenciaAlumno::className(), ['idnaa' => 'idnaa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaliffinalalumnoasigs()
    {
        return $this->hasMany(Califfinalalumnoasig::className(), ['idnaa' => 'idnaa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaliffinalalumnoasigs0()
    {
        return $this->hasMany(Califfinalalumnoasig::className(), ['idnaa' => 'idnaa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaliffrecuentealumnoasigs()
    {
        return $this->hasMany(Califfrecuentealumnoasig::className(), ['idnaa' => 'idnaa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCaliffrecuentealumnoasigs0()
    {
        return $this->hasMany(Califfrecuentealumnoasig::className(), ['idnaa' => 'idnaa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalifparcialalumnoasigs()
    {
        return $this->hasMany(Califparcialalumnoasig::className(), ['idnaa' => 'idnaa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCalifparcialalumnoasigs0()
    {
        return $this->hasMany(Califparcialalumnoasig::className(), ['idnaa' => 'idnaa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCIInfPer()
    {
        return $this->hasOne(Informacionpersonal::className(), ['CIInfPer' => 'CIInfPer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPer()
    {
        return $this->hasOne(Periodolectivo::className(), ['idper' => 'idPer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatricula()
    {
        return $this->hasOne(Matricula::className(), ['idMatricula' => 'idMatricula']);
    }
}
