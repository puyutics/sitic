<?php

namespace app\models\siad_pregrado;

use Yii;

/**
 * This is the model class for table "asistencia_alumno".
 *
 * @property int $id_asist
 * @property string $ciinfper
 * @property string $fecha_asal
 * @property string $hora_asal
 * @property int $idPer
 * @property string $idnaa
 * @property string $observacion_asal
 * @property int $numsesion_asal
 * @property int $presente
 * @property int $ausente
 * @property int $atraso
 * @property int $justificada
 * @property string $fecha_creacion fecha de creacion del registro
 * @property string $fecha_modif fecha de ultima modificacion
 * @property string $observacion observaciones al registro
 * @property int $id_plasig
 * @property string $fecha_just_asal
 * @property string $usu_reg_just_asal
 *
 * @property NotasAlumno $naa
 * @property PlanificacionAsignatura $plasig
 * @property Periodo $per
 */
class AsistenciaAlumno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'asistencia_alumno';
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
            [['fecha_asal', 'hora_asal', 'fecha_creacion', 'fecha_modif', 'fecha_just_asal'], 'safe'],
            [['idPer', 'idnaa', 'numsesion_asal', 'presente', 'ausente', 'atraso', 'justificada', 'id_plasig'], 'integer'],
            [['fecha_creacion', 'fecha_modif', 'observacion', 'id_plasig'], 'required'],
            [['observacion'], 'string'],
            [['ciinfper'], 'string', 'max' => 20],
            [['observacion_asal'], 'string', 'max' => 60],
            [['usu_reg_just_asal'], 'string', 'max' => 200],
            [['idnaa'], 'exist', 'skipOnError' => true, 'targetClass' => NotasAlumno::className(), 'targetAttribute' => ['idnaa' => 'idnaa']],
            [['id_plasig'], 'exist', 'skipOnError' => true, 'targetClass' => PlanificacionAsignatura::className(), 'targetAttribute' => ['id_plasig' => 'id_plasig']],
            [['idPer'], 'exist', 'skipOnError' => true, 'targetClass' => Periodo::className(), 'targetAttribute' => ['idPer' => 'idper']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_asist' => 'Id Asist',
            'ciinfper' => 'Ciinfper',
            'fecha_asal' => 'Fecha Asal',
            'hora_asal' => 'Hora Asal',
            'idPer' => 'Id Per',
            'idnaa' => 'Idnaa',
            'observacion_asal' => 'Observacion Asal',
            'numsesion_asal' => 'Numsesion Asal',
            'presente' => 'Presente',
            'ausente' => 'Ausente',
            'atraso' => 'Atraso',
            'justificada' => 'Justificada',
            'fecha_creacion' => 'fecha de creacion del registro',
            'fecha_modif' => 'fecha de ultima modificacion',
            'observacion' => 'observaciones al registro',
            'id_plasig' => 'Id Plasig',
            'fecha_just_asal' => 'Fecha Just Asal',
            'usu_reg_just_asal' => 'Usu Reg Just Asal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNaa()
    {
        return $this->hasOne(NotasAlumno::className(), ['idnaa' => 'idnaa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlasig()
    {
        return $this->hasOne(PlanificacionAsignatura::className(), ['id_plasig' => 'id_plasig']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPer()
    {
        return $this->hasOne(Periodo::className(), ['idper' => 'idPer']);
    }
}
