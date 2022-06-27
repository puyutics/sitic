<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "periodolectivo".
 *
 * @property int $idper
 * @property string $fechinicioperlec
 * @property string $fechfinalperlec
 * @property string $DescPerLec
 * @property int $StatusPerLec
 * @property int $cicloPerLec
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
 * @property string $org_mallacurr indica el tipo de organizacion de la malla curricular si es anual semestra u otro
 * @property string $periodosUnificado registra los id de periodos lectivos unificados
 * @property string $descripcion_perlec descripcion textual del periodo lectivo
 *
 * @property Cupoxcarrera[] $cupoxcarreras
 * @property DiasLaborables[] $diasLaborables
 * @property Docenteperasig[] $docenteperasigs
 * @property Mallacurricularperiodo[] $mallacurricularperiodos
 * @property MatriculaPosgrado[] $matriculas
 * @property Notasalumnoasignatura[] $notasalumnoasignaturas
 * @property ParamcalifPerlec[] $paramcalifPerlecs
 */
class PeriodoPosgrado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
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
        return Yii::$app->get('db_siad_posgrado');
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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
    public function getCupoxcarreras()
    {
        return $this->hasMany(Cupoxcarrera::className(), ['idper' => 'idper']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiasLaborables()
    {
        return $this->hasMany(DiasLaborables::className(), ['idPer' => 'idper']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParamcalifPerlecs()
    {
        return $this->hasMany(ParamcalifPerlec::className(), ['idPer' => 'idper']);
    }
}
