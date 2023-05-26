<?php

namespace app\models\siad_pregrado;

use Yii;
use yii\helpers\Security;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "informacionpersonal_d".
 *
 * @property string $CIInfPer
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
 * @property string $CiudadPer
 * @property string $DirecDomicilioPer
 * @property string $Telf1InfPer
 * @property string $Telf2InfPer
 * @property string $CelularInfPer
 * @property string $TipoInfPer
 * @property string $StatusPer
 * @property string $mailPer
 * @property string $mailInst
 * @property integer $GrupoSanguineo
 * @property string $tipo_discapacidad
 * @property string $carnet_conadis
 * @property string $num_carnet_conadis
 * @property integer $porcentaje_discapacidad
 * @property resource $fotografia
 * @property string $codigo_dactilar
 * @property integer $hd_posicion
 * @property resource $huella_dactilar
 * @property string $ultima_actualizacion
 * @property string $LoginUsu
 * @property string $ClaveUsu
 * @property integer $StatusUsu
 * @property string $idcarr
 * @property integer $usa_biometrico
 * @property string $fecha_reg
 * @property string $fecha_ultimo_acceso
 * @property string $usu_registra
 * @property string $usu_modifica
 * @property string $fecha_ultima_modif
 *
 * @property AcademicoDocente[] $academicoDocentes
 * @property Docenteperasig[] $docenteperasigs
 * @property PracticasPreprof[] $practicasPreprofs
 */
class Docentes extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'informacionpersonal_d';
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
            [['CIInfPer', 'cedula_pasaporte', 'EtniaPer', 'tipo_discapacidad', 'carnet_conadis', 'num_carnet_conadis', 'porcentaje_discapacidad', 'codigo_dactilar', 'hd_posicion', 'huella_dactilar', 'ultima_actualizacion', 'LoginUsu', 'ClaveUsu', 'StatusUsu', 'idcarr', 'usa_biometrico', 'fecha_reg', 'fecha_ultimo_acceso', 'usu_registra', 'usu_modifica', 'fecha_ultima_modif'], 'required'],
            [['EtniaPer', 'GrupoSanguineo', 'porcentaje_discapacidad', 'hd_posicion', 'StatusUsu', 'usa_biometrico'], 'integer'],
            [['FechNacimPer', 'ultima_actualizacion', 'fecha_reg', 'fecha_ultimo_acceso', 'fecha_ultima_modif'], 'safe'],
            [['fotografia', 'huella_dactilar'], 'string'],
            [['CIInfPer', 'num_carnet_conadis', 'LoginUsu', 'usu_registra', 'usu_modifica'], 'string', 'max' => 20],
            [['cedula_pasaporte'], 'string', 'max' => 13],
            [['TipoDocInfPer', 'GeneroPer', 'EstadoCivilPer', 'StatusPer', 'tipo_discapacidad'], 'string', 'max' => 1],
            [['ApellInfPer', 'ApellMatInfPer', 'NombInfPer', 'LugarNacimientoPer'], 'string', 'max' => 45],
            [['NacionalidadPer', 'TipoInfPer', 'carnet_conadis'], 'string', 'max' => 2],
            [['CiudadPer', 'ClaveUsu'], 'string', 'max' => 100],
            [['DirecDomicilioPer'], 'string', 'max' => 200],
            [['Telf1InfPer', 'Telf2InfPer', 'CelularInfPer'], 'string', 'max' => 12],
            [['mailPer', 'mailInst'], 'string', 'max' => 60],
            [['mailPer', 'mailInst'], 'email'],
            [['codigo_dactilar'], 'string', 'max' => 15],
            [['idcarr'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CIInfPer' => 'Ciinf Per',
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
            'Telf1InfPer' => 'Telf1 Inf Per',
            'Telf2InfPer' => 'Telf2 Inf Per',
            'CelularInfPer' => 'Celular Inf Per',
            'TipoInfPer' => 'Tipo Inf Per',
            'StatusPer' => 'Status Per',
            'mailPer' => 'Mail Per',
            'mailInst' => 'Mail Inst',
            'GrupoSanguineo' => 'Grupo Sanguineo',
            'tipo_discapacidad' => 'Tipo Discapacidad',
            'carnet_conadis' => 'Carnet Conadis',
            'num_carnet_conadis' => 'Num Carnet Conadis',
            'porcentaje_discapacidad' => 'Porcentaje Discapacidad',
            'fotografia' => 'Fotografia',
            'codigo_dactilar' => 'Codigo Dactilar',
            'hd_posicion' => 'Hd Posicion',
            'huella_dactilar' => 'Huella Dactilar',
            'ultima_actualizacion' => 'Ultima Actualizacion',
            'LoginUsu' => 'Login Usu',
            'ClaveUsu' => 'Clave Usu',
            'StatusUsu' => 'Status Usu',
            'idcarr' => 'Idcarr',
            'usa_biometrico' => 'Usa Biometrico',
            'fecha_reg' => 'Fecha Reg',
            'fecha_ultimo_acceso' => 'Fecha Ultimo Acceso',
            'usu_registra' => 'Usu Registra',
            'usu_modifica' => 'Usu Modifica',
            'fecha_ultima_modif' => 'Fecha Ultima Modif',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcademicoDocentes()
    {
        return $this->hasMany(AcademicoDocente::className(), ['ciinfper' => 'CIInfPer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocenteperasigs()
    {
        return $this->hasMany(Docenteperasig::className(), ['CIInfPer' => 'CIInfPer']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPracticasPreprofs()
    {
        return $this->hasMany(PracticasPreprof::className(), ['cedula_tutor' => 'CIInfPer']);
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
        return Docentes::findOne($username);
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

    public static function findByMail($mail){
        if ($ci = static::find()->select(['CIInfPer'])
            ->where(['mailPer' => $mail])
            ->one())
            return $ci->CIInfPer;
        else
            return 0;
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


    public function getDatosCompletos()
    {
        return $this->CIInfPer.": ".$this->ApellInfPer." ".$this->ApellMatInfPer." ".$this->NombInfPer;
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
        //return "a<ut@uea88" === $password ;
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

