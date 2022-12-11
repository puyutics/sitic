<?php

namespace app\models\sisges;

use Yii;

/**
 * This is the model class for table "tthh_servidor".
 *
 * @property string $tipo_documento
 * @property string $id_documento número de identificación
 * @property string $nombres
 * @property string $apellidos
 * @property string $fecha_nacimiento
 * @property string $servidorpasante
 * @property string $num_libretamilitar
 * @property string $nacionalidad
 * @property string $sexo
 * @property string $tipo_sangre
 * @property string $estado_civil
 * @property string $discapacidad
 * @property string $numero_conadis
 * @property string $tipo_discapacidad
 * @property string $servidor_carrera
 * @property string $numero_certificado
 * @property string $identificacion_etnica
 * @property string $nacionalidad_indigena
 * @property string $dir_calleprincipal
 * @property string $dir_numero
 * @property string $dir_callesecundaria
 * @property string $dir_referencia
 * @property string $tel_domicilio
 * @property string $tel_celular
 * @property string $tel_trabajo
 * @property string $tel_extension
 * @property string $email
 * @property string $email_temp
 * @property string $provincia
 * @property string $canton
 * @property string $parroquia
 * @property string $contacto_apellidos
 * @property string $contacto_nombres
 * @property string $contacto_telefono
 * @property string $contacto_celular
 * @property string $notaria_lugar
 * @property string $notaria_numero
 * @property string $notaria_fecha
 * @property string $institucion_bancaria
 * @property string $cuenta_tipo
 * @property string $cuenta_numero
 * @property int $status 0 No activo 1 Activo 2 Pendiente
 *
 * @property TthhAsistencia[] $tthhAsistencias
 * @property TthhHorarios[] $tthhHorarios
 * @property TthhServidorTipo[] $tthhServidorTipos
 * @property TthhVacaciones[] $tthhVacaciones
 */
class TthhServidor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tthh_servidor';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_sisges');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_documento'], 'required'],
            [['fecha_nacimiento', 'notaria_fecha'], 'safe'],
            [['status'], 'integer'],
            [['tipo_documento', 'numero_conadis', 'numero_certificado', 'identificacion_etnica'], 'string', 'max' => 25],
            [['id_documento', 'cuenta_numero'], 'string', 'max' => 20],
            [['nombres', 'apellidos', 'num_libretamilitar', 'nacionalidad', 'tipo_discapacidad', 'nacionalidad_indigena', 'email_temp', 'provincia', 'canton', 'contacto_apellidos', 'contacto_nombres', 'cuenta_tipo'], 'string', 'max' => 45],
            [['servidorpasante', 'discapacidad', 'servidor_carrera'], 'string', 'max' => 2],
            [['sexo', 'dir_numero'], 'string', 'max' => 10],
            [['tipo_sangre'], 'string', 'max' => 5],
            [['estado_civil', 'tel_domicilio', 'tel_celular', 'tel_trabajo', 'tel_extension', 'contacto_telefono', 'contacto_celular'], 'string', 'max' => 15],
            [['dir_calleprincipal', 'dir_callesecundaria', 'email', 'notaria_lugar', 'notaria_numero'], 'string', 'max' => 60],
            [['dir_referencia', 'institucion_bancaria'], 'string', 'max' => 100],
            [['parroquia'], 'string', 'max' => 90],
            [['id_documento'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'tipo_documento' => 'Tipo Documento',
            'id_documento' => 'Id Documento',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'servidorpasante' => 'Servidorpasante',
            'num_libretamilitar' => 'Num Libretamilitar',
            'nacionalidad' => 'Nacionalidad',
            'sexo' => 'Sexo',
            'tipo_sangre' => 'Tipo Sangre',
            'estado_civil' => 'Estado Civil',
            'discapacidad' => 'Discapacidad',
            'numero_conadis' => 'Numero Conadis',
            'tipo_discapacidad' => 'Tipo Discapacidad',
            'servidor_carrera' => 'Servidor Carrera',
            'numero_certificado' => 'Numero Certificado',
            'identificacion_etnica' => 'Identificacion Etnica',
            'nacionalidad_indigena' => 'Nacionalidad Indigena',
            'dir_calleprincipal' => 'Dir Calleprincipal',
            'dir_numero' => 'Dir Numero',
            'dir_callesecundaria' => 'Dir Callesecundaria',
            'dir_referencia' => 'Dir Referencia',
            'tel_domicilio' => 'Tel Domicilio',
            'tel_celular' => 'Tel Celular',
            'tel_trabajo' => 'Tel Trabajo',
            'tel_extension' => 'Tel Extension',
            'email' => 'Email',
            'email_temp' => 'Email Temp',
            'provincia' => 'Provincia',
            'canton' => 'Canton',
            'parroquia' => 'Parroquia',
            'contacto_apellidos' => 'Contacto Apellidos',
            'contacto_nombres' => 'Contacto Nombres',
            'contacto_telefono' => 'Contacto Telefono',
            'contacto_celular' => 'Contacto Celular',
            'notaria_lugar' => 'Notaria Lugar',
            'notaria_numero' => 'Notaria Numero',
            'notaria_fecha' => 'Notaria Fecha',
            'institucion_bancaria' => 'Institucion Bancaria',
            'cuenta_tipo' => 'Cuenta Tipo',
            'cuenta_numero' => 'Cuenta Numero',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTthhAsistencias()
    {
        return $this->hasMany(TthhAsistencia::className(), ['idx_servidor' => 'id_documento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTthhHorarios()
    {
        return $this->hasMany(TthhHorarios::className(), ['idx_servidor' => 'id_documento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTthhServidorTipos()
    {
        return $this->hasMany(TthhServidorTipo::className(), ['idx_servidor' => 'id_documento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTthhVacaciones()
    {
        return $this->hasMany(TthhVacaciones::className(), ['idx_servidor' => 'id_documento']);
    }
}
