<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "periodolectivo".
 *
 * @property integer $idper
 * @property string $fechinicioperlec
 * @property string $fechfinalperlec
 * @property string $DescPerLec
 * @property integer $StatusPerLec
 * @property integer $cicloPerLec
 * @property string $inicioClases
 * @property string $finClases
 * @property string $examfinal_ini
 * @property string $examfinal_fin
 * @property string $examsupletorio_ini
 * @property string $examsupletorio_fin
 * @property string $ci_fechinicio
 * @property string $ci_fechfin
 * @property string $examsuficiencia_ini
 * @property string $examsuficiencia_fin
 * @property string $org_mallacurr
 * @property string $periodosUnificado
 * @property string $descripcion_perlec
 *
 * @property Docenteperasig[] $docenteperasigs
 * @property Mallacurricularperiodo[] $mallacurricularperiodos
 * @property Matricula[] $matriculas
 * @property Notasalumnoasignatura[] $notasalumnoasignaturas
 */
class Periodo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'periodolectivo';
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
            [['fechinicioperlec', 'fechfinalperlec', 'inicioClases', 'finClases', 'examfinal_ini', 'examfinal_fin', 'examsupletorio_ini', 'examsupletorio_fin', 'ci_fechinicio', 'ci_fechfin', 'examsuficiencia_ini', 'examsuficiencia_fin'], 'safe'],
            [['StatusPerLec', 'cicloPerLec'], 'integer'],
            [['inicioClases', 'finClases', 'examfinal_ini', 'examfinal_fin', 'examsupletorio_ini', 'examsupletorio_fin', 'ci_fechinicio', 'ci_fechfin', 'examsuficiencia_ini', 'examsuficiencia_fin', 'org_mallacurr', 'periodosUnificado', 'descripcion_perlec'], 'required'],
            [['DescPerLec'], 'string', 'max' => 10],
            [['org_mallacurr'], 'string', 'max' => 2],
            [['periodosUnificado'], 'string', 'max' => 20],
            [['descripcion_perlec'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idper' => 'Idper',
            'fechinicioperlec' => 'Fechinicioperlec',
            'fechfinalperlec' => 'Fechfinalperlec',
            'DescPerLec' => 'Desc Per Lec',
            'StatusPerLec' => 'Status Per Lec',
            'cicloPerLec' => 'Ciclo Per Lec',
            'inicioClases' => 'Inicio Clases',
            'finClases' => 'Fin Clases',
            'examfinal_ini' => 'Examfinal Ini',
            'examfinal_fin' => 'Examfinal Fin',
            'examsupletorio_ini' => 'Examsupletorio Ini',
            'examsupletorio_fin' => 'Examsupletorio Fin',
            'ci_fechinicio' => 'Ci Fechinicio',
            'ci_fechfin' => 'Ci Fechfin',
            'examsuficiencia_ini' => 'Examsuficiencia Ini',
            'examsuficiencia_fin' => 'Examsuficiencia Fin',
            'org_mallacurr' => 'Org Mallacurr',
            'periodosUnificado' => 'Periodos Unificado',
            'descripcion_perlec' => 'Descripcion Perlec',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocenteperasigs()
    {
        return $this->hasMany(Docenteperasig::className(), ['idPer' => 'idper']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMallacurricularperiodos()
    {
        return $this->hasMany(Mallacurricularperiodo::className(), ['idPer' => 'idper']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatriculas()
    {
        return $this->hasMany(Matricula::className(), ['idPer' => 'idper']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotasalumnoasignaturas()
    {
        return $this->hasMany(Notasalumnoasignatura::className(), ['idPer' => 'idper']);
    }

    public function getPeriodoActivo(){
        $periodo = $this->find()->where(['StatusPerLec' => 1])->one();
        if ($periodo != null)
            return $periodo->idper."@".$periodo->DescPerLec;
        else return false;
    }

    public static function getUltimoPeriodoActivo(){
        $periodo = Periodo::find()->where(['StatusPerLec' => 1])->one();
        if ($periodo != null)
            return $periodo->idper;
        else return false;
    }

    public static function getDescripcion($periodo ){
        $fechainicial = substr($periodo,0,4);
        $fechafinal = substr($periodo,-4);
        return $fechainicial." - ".$fechafinal;
    }

    public static function Periododescriptivo($periodo){
        $datos = Periodo::findOne($periodo)->DescPerLec;
        $fechainicial = substr($datos,0,4);
        $fechafinal = substr($datos,-4);
        return $fechainicial." - ".$fechafinal;
    }

    public function getPeriodoDetalle( ){
        $periodo = $this->DescPerLec;
        $fechainicial = substr($periodo,0,4);
        $fechafinal = substr($periodo,-4);
        return $fechainicial." - ".$fechafinal;
    }

    public static function generarFecha(){
        $arrayMeses = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
            'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');

        $arrayDias = array( 'domingo', 'lunes', 'martes', 'miÃ©rcoles', 'jueves', 'viernes', 'sÃ¡bado');

        $fecha = $arrayDias[date('w')].", ".date('d')." de ".$arrayMeses[date('m')-1]." de ".date('Y');
        return $fecha;
    }

}

