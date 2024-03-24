<?php

namespace app\models\siad_pregrado;

use Yii;
use yii\helpers\Security;
use yii\web\IdentityInterface;



/**
 * This is the model class for table "informacionpersonal".
 *
 * @property string $CIInfPer
 * @property string $num_expediente
 * @property string $cedula_pasaporte
 * @property string $TipoDocInfPer
 * @property string $ApellInfPer
 * @property string $ApellMatInfPer
 * @property string $NombInfPer
 * @property string $NacionalidadPer
 * @property integer $EtniaPer
 * @property string $FechNacimPer
 * @property string $LugarNacimientoPer
 * @property string $GeneroPer
 * @property string $EstadoCivilPer
 * @property string $paisCNE
 * @property string $provinciaCNE
 * @property string $habilitadoTPublicoCNE
 * @property string $domicilioRegCivil
 * @property string $CiudadPer
 * @property string $DirecDomicilioPer
 * @property string $Telf1InfPer
 * @property string $CelularInfPer
 * @property string $TipoInfPer
 * @property integer $statusper
 * @property string $mailPer
 * @property string $mailInst
 * @property integer $GrupoSanguineo
 * @property string $tipo_discapacidad
 * @property string $carnet_conadis
 * @property string $num_carnet_conadis
 * @property integer $porcentaje_discapacidad
 * @property resource $fotografia
 * @property resource $fotografia_reg_civil
 * @property string $codigo_dactilar
 * @property integer $hd_posicion
 * @property resource $huella_dactilar
 * @property resource $usu_alta
 * @property integer $actualizado
 * @property string $ultima_actualizacion
 * @property string $codigo_verificacion
 * @property integer $deshabilita_edicion
 * @property string $archivo
 * @property string $observacion
 * @property integer $cambia_nombres
 * @property integer $residente_amazonico
 * @property integer $actualizado_x_api
 * @property string $actualizado_x_api_usuario
 *
 * @property Matricula[] $matriculas
 * @property NotasAlumno[] $notasalumnoasignaturas

 */
class Estudiantes extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
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
        return Yii::$app->get('db_siad');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mailPer', 'mailInst'], 'string', 'max' => 60],
            [['mailPer', 'mailInst'], 'email'],
            [['statusper'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CIInfPer' => 'Ciinf Per',
            'num_expediente' => 'Num Expediente',
            'cedula_pasaporte' => 'Cedula Pasaporte',
            'TipoDocInfPer' => 'Tipo Doc Inf Per',
            'ApellInfPer' => 'Ape. Paterno',
            'ApellMatInfPer' => 'Ape. Materno',
            'NombInfPer' => 'Nombres',
            'NacionalidadPer' => 'Nacionalidad Per',
            'EtniaPer' => 'Etnia Per',
            'FechNacimPer' => 'Fech Nacim Per',
            'LugarNacimientoPer' => 'Lugar Nacimiento Per',
            'GeneroPer' => 'Genero Per',
            'EstadoCivilPer' => 'Estado Civil Per',
            'paisCNE' => 'Pais CNE',
            'provinciaCNE' => 'Provincia CNE',
            'habilitadoTPublicoCNE' => 'Habilitado T. Publico CNE',
            'domicilioRegCivil' => 'Domicilio Reg Civil',
            'CiudadPer' => 'Ciudad Per',
            'DirecDomicilioPer' => 'Direc Domicilio Per',
            'Telf1InfPer' => 'Telf1',
            'CelularInfPer' => 'Celular',
            'TipoInfPer' => 'Tipo Inf Per',
            'statusper' => '(SIAD) Estado',
            'mailPer' => 'Correo Personal',
            'mailInst' => ' (SIAD) Correo Institucional',
            'GrupoSanguineo' => 'Grupo Sanguineo',
            'tipo_discapacidad' => 'Tipo Discapacidad',
            'carnet_conadis' => 'Carnet Conadis',
            'num_carnet_conadis' => 'Num Carnet Conadis',
            'porcentaje_discapacidad' => 'Porcentaje Discapacidad',
            'lateralidad' => 'Lateralidad',
            'fotografia' => 'Fotografia',
            'fotografia_reg_civil' => 'Fotografia Reg Civil',
            'codigo_dactilar' => 'Codigo Dactilar',
            'hd_posicion' => 'Hd Posicion',
            'huella_dactilar' => 'Huella Dactilar',
            'usu_alta' => 'Usu Alta',
            'actualizado' => 'Actualizado',
            'ultima_actualizacion' => 'Ultima Actualizacion',
            'codigo_verificacion' => 'Codigo Verificacion',
            'deshabilita_edicion' => 'Deshabilita Edicion',
            'archivo' => 'Archivo',
            'observacion' => 'Observacion',
            'cambia_nombres' => 'Cambia Nombres',
            'residente_amazonico' => 'Residente Amazonico',
            'actualizado_x_api' => 'Actualizado API',
            'actualizado_x_api_usuario' => 'Actualizado API Usuario',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
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
        return $this->hasMany(NotasAlumno::className(), ['CIInfPer' => 'CIInfPer']);
    }


    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    /**
     * @inheritdoc
     */
    /* modified */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
    /* removed
        public static function findIdentityByAccessToken($token)
        {
            throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        }
    */
    /**
     * Finds user by username
     *
     * @param  string      $username     * @return static|null
     */
    public static function findByUsername($username)
    {
            return Estudiantes::findOne($username);
    }
    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null     */
    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */

    public function getFullName()
    {
      return $this->ApellInfPer." ".$this->ApellMatInfPer." ".$this->NombInfPer;
    }
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    /**
    122
     * @inheritdoc
    123
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
       return $this->CIInfPer === $password;
    }
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
