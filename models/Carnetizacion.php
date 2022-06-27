<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "carnetizacion".
 *
 * @property int $id
 * @property string $username
 * @property string $CIInfPer
 * @property string $cedula_pasaporte
 * @property string $TipoDocInfPer
 * @property string $ApellInfPer
 * @property string $ApellMatInfPer
 * @property string $NombInfPer
 * @property string $FechNacimPer
 * @property string $mailInst
 * @property resource $fotografia
 * @property string $idMatricula
 * @property string $idCarr
 * @property int $idPer
 * @property string $fechfinalperlec
 * @property string $filefolder
 * @property string $filename
 * @property string $filetype
 * @property string $fec_registro
 * @property int $status
 *
 * @property User $username0
 */
class Carnetizacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'carnetizacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'CIInfPer', 'cedula_pasaporte', 'TipoDocInfPer', 'ApellInfPer', 'ApellMatInfPer', 'NombInfPer', 'FechNacimPer', 'mailInst', 'fotografia', 'idMatricula', 'idCarr', 'idPer', 'fechfinalperlec', 'filefolder', 'filename', 'filetype', 'fec_registro', 'status'], 'required'],
            [['FechNacimPer', 'fechfinalperlec', 'fec_registro'], 'safe'],
            [['fotografia'], 'string'],
            [['idPer', 'status'], 'integer'],
            [['username', 'CIInfPer', 'cedula_pasaporte', 'TipoDocInfPer', 'ApellInfPer', 'ApellMatInfPer', 'NombInfPer', 'mailInst', 'idMatricula', 'idCarr', 'filefolder', 'filename', 'filetype'], 'string', 'max' => 255],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'username']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'CIInfPer' => 'ID',
            'cedula_pasaporte' => 'DNI',
            'TipoDocInfPer' => 'Tipo Documento',
            'ApellInfPer' => 'Apellido Paterno',
            'ApellMatInfPer' => 'Apellido Materno',
            'NombInfPer' => 'Nombres',
            'FechNacimPer' => 'Fecha Nacimiento',
            'mailInst' => 'Email Institucional',
            'fotografia' => 'Fotografia',
            'idMatricula' => 'Cód. Matrícula',
            'idCarr' => 'Carrera',
            'idPer' => 'Período',
            'fechfinalperlec' => 'Fecha Validez',
            'filefolder' => 'Filefolder',
            'filename' => 'Filename',
            'filetype' => 'Filetype',
            'fec_registro' => 'Fec Registro',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(User::className(), ['username' => 'username']);
    }

    public function getDatosCompletos()
    {
        return $this->cedula_pasaporte.": ".$this->ApellInfPer." ".$this->ApellMatInfPer . " " . $this->NombInfPer;
    }
}
