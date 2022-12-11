<?php

namespace app\models\siad_posgrado;

use Yii;

/**
 * This is the model class for table "informacionpersonal".
 *
 * @property string $CIInfPer
 * @property string $num_expediente
 * @property string $cedula_pasaporte numero de identificacion del estudiante
 * @property string $TipoDocInfPer
 * @property string $ApellInfPer
 * @property string $ApellMatInfPer
 * @property string $NombInfPer
 * @property string $NacionalidadPer
 * @property int $EtniaPer
 * @property string $FechNacimPer
 * @property string $LugarNacimientoPer
 * @property string $GeneroPer
 * @property string $EstadoCivilPer
 * @property string $CiudadPer
 * @property string $DirecDomicilioPer
 * @property string $Telf1InfPer
 * @property string $CelularInfPer
 * @property string $TipoInfPer
 * @property int $statusper
 * @property string $mailPer
 * @property string $mailInst
 * @property int $GrupoSanguineo
 * @property string $tipo_discapacidad tipo de discapacidad
 * @property string $carnet_conadis indica si tiene carnet del conadis
 * @property string $num_carnet_conadis numero de carnet del conadis si lo tiene
 * @property int $porcentaje_discapacidad procentaje de discapacidad que tiene
 * @property string $lateralidad
 * @property resource $fotografia
 * @property string $codigo_dactilar codigo dactilar para tomarlo como password de ingreso
 * @property int $hd_posicion indica la huella de que dedo es capturada
 * @property resource $huella_dactilar captura informacion de la huella dactilar del estudiante
 * @property string $ultima_actualizacion
 * @property string $codigo_verificacion codigo de verificacion para becas
 * @property int $deshabilita_edicion permite hailitar el boton de guardar modificaciones
 * @property string $archivo
 *
 * @property AcademicoAlumno[] $academicoAlumnos
 * @property Acaduea[] $acadueas
 * @property Matricula[] $matriculas
 * @property Notasalumnoasignatura[] $notasalumnoasignaturas
 */
class EstudiantesPosgrado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'informacionpersonal';
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
            [['CIInfPer', 'cedula_pasaporte', 'EtniaPer', 'tipo_discapacidad', 'carnet_conadis', 'num_carnet_conadis', 'porcentaje_discapacidad', 'codigo_dactilar', 'hd_posicion', 'huella_dactilar', 'ultima_actualizacion', 'codigo_verificacion'], 'required'],
            [['EtniaPer', 'statusper', 'GrupoSanguineo', 'porcentaje_discapacidad', 'hd_posicion', 'deshabilita_edicion'], 'integer'],
            [['FechNacimPer', 'ultima_actualizacion'], 'safe'],
            [['fotografia', 'huella_dactilar'], 'string'],
            [['CIInfPer', 'num_expediente', 'num_carnet_conadis'], 'string', 'max' => 20],
            [['cedula_pasaporte'], 'string', 'max' => 13],
            [['TipoDocInfPer', 'GeneroPer', 'EstadoCivilPer', 'tipo_discapacidad'], 'string', 'max' => 1],
            [['ApellInfPer', 'ApellMatInfPer', 'NombInfPer'], 'string', 'max' => 45],
            [['NacionalidadPer', 'TipoInfPer', 'carnet_conadis'], 'string', 'max' => 2],
            [['LugarNacimientoPer'], 'string', 'max' => 120],
            [['CiudadPer', 'DirecDomicilioPer', 'codigo_dactilar'], 'string', 'max' => 100],
            [['Telf1InfPer', 'CelularInfPer'], 'string', 'max' => 12],
            [['mailPer', 'mailInst'], 'string', 'max' => 60],
            [['lateralidad'], 'string', 'max' => 15],
            [['codigo_verificacion'], 'string', 'max' => 50],
            [['archivo'], 'string', 'max' => 255],
            [['CIInfPer'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CIInfPer' => 'Ci Inf Per',
            'num_expediente' => 'Num Expediente',
            'cedula_pasaporte' => 'Cedula Pasaporte',
            'TipoDocInfPer' => 'Tipo Doc Inf Per',
            'ApellInfPer' => 'Apell Inf Per',
            'ApellMatInfPer' => 'Apell Mat Inf Per',
            'NombInfPer' => 'Nomb Inf Per',
            'NacionalidadPer' => 'Nacionalidad Per',
            'EtniaPer' => 'Etnia Per',
            'FechNacimPer' => 'Fech Nacim Per',
            'LugarNacimientoPer' => 'Lugar Nacimiento Per',
            'GeneroPer' => 'Genero Per',
            'EstadoCivilPer' => 'Estado Civil Per',
            'CiudadPer' => 'Ciudad Per',
            'DirecDomicilioPer' => 'Direc Domicilio Per',
            'Telf1InfPer' => 'Telf 1 Inf Per',
            'CelularInfPer' => 'Celular Inf Per',
            'TipoInfPer' => 'Tipo Inf Per',
            'statusper' => 'Statusper',
            'mailPer' => 'Mail Per',
            'mailInst' => 'Mail Inst',
            'GrupoSanguineo' => 'Grupo Sanguineo',
            'tipo_discapacidad' => 'Tipo Discapacidad',
            'carnet_conadis' => 'Carnet Conadis',
            'num_carnet_conadis' => 'Num Carnet Conadis',
            'porcentaje_discapacidad' => 'Porcentaje Discapacidad',
            'lateralidad' => 'Lateralidad',
            'fotografia' => 'Fotografia',
            'codigo_dactilar' => 'Codigo Dactilar',
            'hd_posicion' => 'Hd Posicion',
            'huella_dactilar' => 'Huella Dactilar',
            'ultima_actualizacion' => 'Ultima Actualizacion',
            'codigo_verificacion' => 'Codigo Verificacion',
            'deshabilita_edicion' => 'Deshabilita Edicion',
            'archivo' => 'Archivo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcademicoAlumnos()
    {
        return $this->hasMany(AcademicoAlumno::className(), ['CIInfPer' => 'CIInfPer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcadueas()
    {
        return $this->hasMany(Acaduea::className(), ['CIInfper' => 'CIInfPer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMatriculas()
    {
        return $this->hasMany(Matricula::className(), ['CIInfPer' => 'CIInfPer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotasalumnoasignaturas()
    {
        return $this->hasMany(Notasalumnoasignatura::className(), ['CIInfPer' => 'CIInfPer']);
    }
}
