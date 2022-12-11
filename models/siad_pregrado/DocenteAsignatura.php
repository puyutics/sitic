<?php

namespace app\models\siad_pregrado;

use Yii;

/**
 * This is the model class for table "docenteperasig".
 *
 * @property string $dpa_id
 * @property string $CIInfPer
 * @property integer $idPer
 * @property string $idAsig
 * @property string $idCarr
 * @property integer $idAnio
 * @property integer $idSemestre
 * @property string $idParalelo
 * @property integer $status
 * @property double $idMc
 * @property string $tipo_orgmalla
 * @property integer $id_actdist
 * @property double $id_contdoc
 * @property integer $transf_asistencia
 * @property integer $transf_frecuente
 * @property integer $transf_parcial
 * @property integer $transf_final
 * @property integer $arrastre
 * @property integer $extra
 * @property integer $compensar_horas
 * @property string $compensar_tipo
 *
 * @property Periodo $idPer0
 * @property Docentes $cIInfPer
 */
class DocenteAsignatura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'docenteperasig';
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
            [['idPer', 'idAnio', 'idSemestre', 'status', 'id_actdist', 'transf_asistencia', 'transf_frecuente', 'transf_parcial', 'transf_final', 'arrastre', 'extra', 'compensar_horas'], 'integer'],
            [['idMc', 'tipo_orgmalla', 'id_actdist', 'id_contdoc', 'transf_asistencia', 'transf_frecuente', 'transf_parcial', 'transf_final', 'compensar_horas', 'compensar_tipo'], 'required'],
            [['idMc', 'id_contdoc'], 'number'],
            [['CIInfPer'], 'string', 'max' => 20],
            [['idAsig'], 'string', 'max' => 10],
            [['idCarr'], 'string', 'max' => 6],
            [['idParalelo'], 'string', 'max' => 1],
            [['tipo_orgmalla'], 'string', 'max' => 2],
            [['compensar_tipo'], 'string', 'max' => 100],
            [['idPer'], 'exist', 'skipOnError' => true, 'targetClass' => Periodo::className(), 'targetAttribute' => ['idPer' => 'idper']],
            [['CIInfPer'], 'exist', 'skipOnError' => true, 'targetClass' => Docentes::className(), 'targetAttribute' => ['CIInfPer' => 'CIInfPer']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dpa_id' => 'Dpa ID',
            'CIInfPer' => 'Cédula/DNI',
            'idPer' => 'Periodo',
            'idAsig' => 'Asignatura',
            'idCarr' => 'Carrera',
            'idAnio' => 'Año',
            'idSemestre' => 'Semestre',
            'idParalelo' => 'Paralelo',
            'status' => 'Status',
            'idMc' => 'Id Mc',
            'tipo_orgmalla' => 'Tipo Orgmalla',
            'id_actdist' => 'Id Actdist',
            'id_contdoc' => 'Id Contdoc',
            'transf_asistencia' => 'Transf Asistencia',
            'transf_frecuente' => 'Transf Frecuente',
            'transf_parcial' => 'Transf Parcial',
            'transf_final' => 'Transf Final',
            'arrastre' => 'Arrastre',
            'extra' => 'Extra',
            'compensar_horas' => 'Compensar Horas',
            'compensar_tipo' => 'Compensar Tipo',
        ];
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
    public function getInfoDocente()
    {
        return $this->hasOne(Docentes::className(), ['CIInfPer' => 'CIInfPer']);
    }
}

