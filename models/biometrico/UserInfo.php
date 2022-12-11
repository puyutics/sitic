<?php

namespace app\models\biometrico;

use Yii;

/**
 * This is the model class for table "USERINFO".
 *
 * @property int $USERID
 * @property string $BADGENUMBER
 * @property string $SSN
 * @property string $NAME
 * @property string $GENDER
 * @property string $TITLE
 * @property string $PAGER
 * @property string $BIRTHDAY
 * @property string $HIREDDAY
 * @property string $STREET
 * @property string $CITY
 * @property string $STATE
 * @property string $ZIP
 * @property string $OPHONE
 * @property string $FPHONE
 * @property int $VERIFICATIONMETHOD
 * @property int $DEFAULTDEPTID
 * @property int $SECURITYFLAGS
 * @property int $ATT
 * @property int $INLATE
 * @property int $OUTEARLY
 * @property int $OVERTIME
 * @property int $SEP
 * @property int $HOLIDAY
 * @property string $MINZU
 * @property string $PASSWORD
 * @property int $LUNCHDURATION
 * @property string $MVerifyPass
 * @property resource $PHOTO
 * @property resource $Notes
 * @property int $privilege
 * @property int $InheritDeptSch
 * @property int $InheritDeptSchClass
 * @property int $AutoSchPlan
 * @property int $MinAutoSchInterval
 * @property int $RegisterOT
 * @property int $InheritDeptRule
 * @property int $EMPRIVILEGE
 * @property string $CardNo
 * @property string $sca_IESSID
 * @property string $sca_Estado
 * @property string $sca_FormaPago
 * @property int $sca_1Quincena
 * @property string $sca_Nombre
 * @property string $sca_Apellido
 * @property string $sca_Cargo
 * @property int $sca_IdCentroCostos
 * @property string $sca_EstadoCivil
 * @property string $sca_Sexo
 * @property string $sca_FechaDespido
 * @property int $sca_CargasFamiliares
 * @property resource $sca_Firma
 * @property int $Pin1
 * @property string $sca_Discapacidad
 * @property string $sca_Correo
 * @property string $sca_MotivoInactivacion
 * @property int $sca_WEB_MarcaManual
 */
class UserInfo extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'USERINFO';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_biometrico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['USERID', 'BADGENUMBER', 'ATT', 'INLATE', 'OUTEARLY', 'OVERTIME', 'SEP', 'HOLIDAY', 'LUNCHDURATION'], 'required'],
            [['USERID', 'VERIFICATIONMETHOD', 'DEFAULTDEPTID', 'SECURITYFLAGS', 'ATT', 'INLATE', 'OUTEARLY', 'OVERTIME', 'SEP', 'HOLIDAY', 'LUNCHDURATION', 'privilege', 'InheritDeptSch', 'InheritDeptSchClass', 'AutoSchPlan', 'MinAutoSchInterval', 'RegisterOT', 'InheritDeptRule', 'EMPRIVILEGE', 'sca_1Quincena', 'sca_IdCentroCostos', 'sca_CargasFamiliares', 'Pin1', 'sca_WEB_MarcaManual'], 'integer'],
            [['BIRTHDAY', 'HIREDDAY', 'sca_FechaDespido'], 'safe'],
            [['PHOTO', 'Notes', 'sca_Firma'], 'string'],
            [['BADGENUMBER'], 'string', 'max' => 24],
            [['SSN', 'PAGER', 'OPHONE', 'FPHONE', 'MINZU', 'CardNo'], 'string', 'max' => 20],
            [['NAME'], 'string', 'max' => 40],
            [['GENDER'], 'string', 'max' => 8],
            [['TITLE', 'sca_Nombre', 'sca_Apellido', 'sca_Cargo', 'sca_EstadoCivil', 'sca_Sexo'], 'string', 'max' => 50],
            [['STREET'], 'string', 'max' => 80],
            [['CITY'], 'string', 'max' => 2],
            [['STATE'], 'string', 'max' => 6],
            [['ZIP'], 'string', 'max' => 12],
            [['PASSWORD', 'sca_Correo', 'sca_MotivoInactivacion'], 'string', 'max' => 100],
            [['MVerifyPass', 'sca_Discapacidad'], 'string', 'max' => 10],
            [['sca_IESSID', 'sca_Estado', 'sca_FormaPago'], 'string', 'max' => 30],
            [['USERID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'USERID' => 'Userid',
            'BADGENUMBER' => 'Código Biométrico',
            'SSN' => 'No. Cédula',
            'NAME' => 'Nombre Biométrico',
            'GENDER' => 'Gender',
            'TITLE' => 'Title',
            'PAGER' => 'Pager',
            'BIRTHDAY' => 'Birthday',
            'HIREDDAY' => 'Hiredday',
            'STREET' => 'Dirección',
            'CITY' => 'City',
            'STATE' => 'State',
            'ZIP' => 'Zip',
            'OPHONE' => 'Celular',
            'FPHONE' => 'Fphone',
            'VERIFICATIONMETHOD' => 'Verificationmethod',
            'DEFAULTDEPTID' => 'Departamento',
            'SECURITYFLAGS' => 'Securityflags',
            'ATT' => 'Att',
            'INLATE' => 'Inlate',
            'OUTEARLY' => 'Outearly',
            'OVERTIME' => 'Overtime',
            'SEP' => 'Sep',
            'HOLIDAY' => 'Holiday',
            'MINZU' => 'Minzu',
            'PASSWORD' => 'Password',
            'LUNCHDURATION' => 'Lunchduration',
            'MVerifyPass' => 'M Verify Pass',
            'PHOTO' => 'Photo',
            'Notes' => 'Notes',
            'privilege' => 'Privilege',
            'InheritDeptSch' => 'Inherit Dept Sch',
            'InheritDeptSchClass' => 'Inherit Dept Sch Class',
            'AutoSchPlan' => 'Auto Sch Plan',
            'MinAutoSchInterval' => 'Min Auto Sch Interval',
            'RegisterOT' => 'Register Ot',
            'InheritDeptRule' => 'Inherit Dept Rule',
            'EMPRIVILEGE' => 'Emprivilege',
            'CardNo' => 'Card No',
            'sca_IESSID' => 'Sca Iessid',
            'sca_Estado' => 'Sca Estado',
            'sca_FormaPago' => 'Sca Forma Pago',
            'sca_1Quincena' => 'Sca 1 Quincena',
            'sca_Nombre' => 'Nombres',
            'sca_Apellido' => 'Apellidos',
            'sca_Cargo' => 'Sca Cargo',
            'sca_IdCentroCostos' => 'Sca Id Centro Costos',
            'sca_EstadoCivil' => 'Sca Estado Civil',
            'sca_Sexo' => 'Sca Sexo',
            'sca_FechaDespido' => 'Sca Fecha Despido',
            'sca_CargasFamiliares' => 'Sca Cargas Familiares',
            'sca_Firma' => 'Sca Firma',
            'Pin1' => 'Pin1',
            'sca_Discapacidad' => 'Sca Discapacidad',
            'sca_Correo' => 'Correo',
            'sca_MotivoInactivacion' => 'Sca Motivo Inactivacion',
            'sca_WEB_MarcaManual' => 'Sca Web Marca Manual',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasOne(Departments::className(), ['DEPTID' => 'DEFAULTDEPTID']);
    }

}
