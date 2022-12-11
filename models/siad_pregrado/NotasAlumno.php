<?php

namespace app\models\siad_pregrado;

use Yii;

/**
 * This is the model class for table "notasalumnoasignatura".
 *
 * @property string $idnaa
 * @property string $CIInfPer
 * @property string $idAsig
 * @property integer $idPer
 * @property string $CAC1
 * @property string $CAC2
 * @property string $CAC3
 * @property string $TCAC
 * @property string $CEF
 * @property string $CSP
 * @property string $CCR
 * @property string $CSP2
 * @property string $CalifFinal
 * @property integer $asistencia
 * @property integer $StatusCalif
 * @property string $idMatricula
 * @property integer $VRepite
 * @property string $observacion
 * @property integer $op1
 * @property integer $op2
 * @property integer $op3
 * @property integer $pierde_x_asistencia
 * @property integer $repite
 * @property integer $retirado
 * @property integer $excluidaxrepitencia
 * @property integer $excluidaxreingreso
 * @property integer $excluidaxresolucion
 * @property integer $convalidacion
 * @property integer $aprobada
 * @property integer $anulada
 * @property integer $arrastre
 * @property string $registro_asistencia
 * @property string $usu_registro_asistencia
 * @property string $registro
 * @property string $ultima_modificacion
 * @property string $usu_pregistro
 * @property string $usu_umodif_registro
 * @property string $archivo
 * @property double $idMc
 * @property string $institucion_proviene
 * @property string $porcentaje_convalidacion
 * @property integer $exam_final_atrasado
 * @property integer $exam_supl_atrasado
 * @property string $observacion_efa
 * @property string $observacion_espa
 * @property string $usu_habilita_efa
 * @property string $usu_habilita_espa
 * @property string $dpa_id
 *
 * @property Estudiantes $cIInfPer
 * @property Periodo $idPer0
 * @property Matricula $idMatricula0
 */
class NotasAlumno extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
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
        return Yii::$app->get('db_siad');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CIInfPer', 'observacion', 'op1', 'op2', 'op3', 'pierde_x_asistencia', 'repite', 'retirado', 'excluidaxrepitencia', 'excluidaxreingreso', 'convalidacion', 'aprobada', 'anulada', 'arrastre', 'registro_asistencia', 'usu_registro_asistencia', 'registro', 'ultima_modificacion', 'usu_pregistro', 'usu_umodif_registro', 'archivo', 'idMc', 'institucion_proviene', 'porcentaje_convalidacion', 'exam_final_atrasado', 'exam_supl_atrasado', 'observacion_efa', 'observacion_espa', 'usu_habilita_efa', 'usu_habilita_espa', 'dpa_id'], 'required'],
            [['idPer', 'asistencia', 'StatusCalif', 'VRepite', 'op1', 'op2', 'op3', 'pierde_x_asistencia', 'repite', 'retirado', 'excluidaxrepitencia', 'excluidaxreingreso', 'excluidaxresolucion', 'convalidacion', 'aprobada', 'anulada', 'arrastre', 'exam_final_atrasado', 'exam_supl_atrasado', 'dpa_id'], 'integer'],
            [['CAC1', 'CAC2', 'CAC3', 'TCAC', 'CEF', 'CSP', 'CCR', 'CSP2', 'CalifFinal', 'idMc'], 'number'],
            [['registro_asistencia', 'registro', 'ultima_modificacion'], 'safe'],
            [['CIInfPer', 'idMatricula', 'usu_registro_asistencia', 'usu_pregistro', 'usu_umodif_registro'], 'string', 'max' => 20],
            [['idAsig'], 'string', 'max' => 10],
            [['observacion'], 'string', 'max' => 200],
            [['archivo', 'institucion_proviene'], 'string', 'max' => 100],
            [['porcentaje_convalidacion'], 'string', 'max' => 5],
            [['observacion_efa', 'observacion_espa', 'usu_habilita_efa', 'usu_habilita_espa'], 'string', 'max' => 60],
            [['CIInfPer'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiantes::className(), 'targetAttribute' => ['CIInfPer' => 'CIInfPer']],
            [['idPer'], 'exist', 'skipOnError' => true, 'targetClass' => Periodo::className(), 'targetAttribute' => ['idPer' => 'idper']],
            [['idMatricula'], 'exist', 'skipOnError' => true, 'targetClass' => Matricula::className(), 'targetAttribute' => ['idMatricula' => 'idMatricula']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idnaa' => 'Idnaa',
            'CIInfPer' => 'Ciinf Per',
            'idAsig' => 'Id Asig',
            'idPer' => 'Id Per',
            'CAC1' => 'Cac1',
            'CAC2' => 'Cac2',
            'CAC3' => 'Cac3',
            'TCAC' => 'Tcac',
            'CEF' => 'Cef',
            'CSP' => 'Csp',
            'CCR' => 'Ccr',
            'CSP2' => 'Csp2',
            'CalifFinal' => 'Calif Final',
            'asistencia' => 'Asistencia',
            'StatusCalif' => 'Status Calif',
            'idMatricula' => 'Id Matricula',
            'VRepite' => 'Vrepite',
            'observacion' => 'Observacion',
            'op1' => 'Op1',
            'op2' => 'Op2',
            'op3' => 'Op3',
            'pierde_x_asistencia' => 'Pierde X Asistencia',
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


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCIInfPer()
    {
        return $this->hasOne(Estudiantes::className(), ['CIInfPer' => 'CIInfPer']);
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
    public function getIdMatricula0()
    {
        return $this->hasOne(Matricula::className(), ['idMatricula' => 'idMatricula']);
    }


}

