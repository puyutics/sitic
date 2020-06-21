<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tab_int_formulario".
 *
 * @property int $id ID
 * @property string $cedula CEDULA
 * @property string $username USUARIO
 * @property string $email EMAIL
 * @property string $nombres NOMBRES
 * @property string $apellidos APELLIDOS
 * @property string $codigo_postal CODIGO POSTAL
 * @property string $provincia PROVINCIA
 * @property string $canton CANTON
 * @property string $parroquia PARROQUIA
 * @property string $calle_principal CALLE PRINCIPAL
 * @property string $calle_secundaria CALLE SECUNDARIA
 * @property string $referencia_texto REFERENCIA TEXTO
 * @property string $referencia_foto REFERENCIA FOTO
 * @property string $cel_contacto CELULAR CONTACTO
 * @property string $tel_contacto TELEFONO CONTACTO
 * @property string $siad_matriculado SIAD MATRICULADO
 * @property string $siad_semestre SIAD SEMESTRE
 * @property string $siad_carrera SIAD CARRERA
 * @property string $ficha_escasos_recursos FICHA ESCASOS RECURSOS
 * @property string $encuesta_beneficiario ENCUESTA BENEFICIARIO
 * @property string $cobertura COBERTURA
 * @property string $smartphone TELÉFONO INTELIGENTE
 * @property string $responsabilidad_uso RESPONSABILIDAD USO
 * @property string $condiciones CONDICIONES
 * @property string $doc_cedula_pasaporte DOC CEDULA / PASAPORTE
 * @property string $doc_servicio_basico DOC SERVICIO BASICO
 * @property string $doc_responsabilidad_uso DOC RESPONSABILIDAD USO
 * @property string $doc_contrato DOC CONTRATO
 * @property string $qrcode CODIGO QR
 * @property string $fec_registro FECHA REGISTRO
 * @property int $status ESTADO
 *
 * @property TabIntFormularioInvItemUser[] $tabIntFormularioInvItemUsers
 * @property TabIntFormularioInvServiceUser[] $tabIntFormularioInvServiceUsers
 */
class TabIntFormulario extends \yii\db\ActiveRecord
{
    public $upload_referencia_foto;
    public $upload_cedula_pasaporte;
    public $upload_servicio_basico;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tab_int_formulario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fec_registro'], 'safe'],
            [['status'], 'integer'],
            [['cedula', 'username', 'email', 'nombres', 'apellidos', 'codigo_postal', 'provincia', 'canton', 'parroquia', 'calle_principal', 'calle_secundaria', 'referencia_texto', 'referencia_foto', 'cel_contacto', 'tel_contacto', 'siad_matriculado', 'siad_semestre', 'siad_carrera', 'ficha_escasos_recursos', 'encuesta_beneficiario', 'cobertura', 'smartphone', 'responsabilidad_uso', 'condiciones', 'doc_cedula_pasaporte', 'doc_servicio_basico', 'doc_responsabilidad_uso', 'doc_contrato', 'qrcode'], 'string', 'max' => 255],
            [['cedula', 'username', 'email', 'nombres', 'apellidos', 'codigo_postal', 'provincia', 'canton', 'parroquia', 'calle_principal', 'calle_secundaria', 'referencia_texto', 'cel_contacto', 'tel_contacto', 'siad_matriculado', 'siad_semestre', 'siad_carrera', 'ficha_escasos_recursos', 'encuesta_beneficiario', 'doc_responsabilidad_uso', 'doc_contrato', 'qrcode'], 'required'],
            [['cedula'], 'unique'],
            [['codigo_postal','cel_contacto','tel_contacto'], 'match',
                'pattern' => '/^[0-9.]+$/u',
                'message'=>'INGRESE SOLO NÚMEROS. {attribute} no puede contener caracteres especiales, ni letras'],
            [['upload_referencia_foto'], 'file', 'extensions' => 'png, jpg, jpeg'],
            [['upload_cedula_pasaporte','upload_servicio_basico'], 'file', 'extensions' => 'png, jpg, jpeg,pdf'],
            [['upload_referencia_foto','upload_cedula_pasaporte','upload_servicio_basico'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cedula' => 'Cédula/Pasaporte',
            'username' => 'Usuario',
            'email' => 'Correo institucional',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'codigo_postal' => 'Codigo Postal',
            'provincia' => 'Provincia',
            'canton' => 'Cantón',
            'parroquia' => 'Parroquia',
            'calle_principal' => 'Calle Principal',
            'calle_secundaria' => 'Calle Secundaria',
            'referencia_texto' => 'Referencia Vivienda',
            'referencia_foto' => 'Foto Vivienda',
            'cel_contacto' => 'Celular Contacto',
            'tel_contacto' => 'Teléfono Contacto',
            'siad_matriculado' => 'Matriculado',
            'siad_semestre' => 'Semestre',
            'siad_carrera' => 'Carrera',
            'ficha_escasos_recursos' => 'Estratificación',
            'encuesta_beneficiario' => 'Beneficio',
            'cobertura' => 'Cobertura',
            'smartphone' => 'Teléfono Inteligente',
            'responsabilidad_uso' => 'Responsabilidad Uso',
            'condiciones' => 'Condiciones',
            'doc_cedula_pasaporte' => 'Cédula / Pasaporte',
            'doc_servicio_basico' => 'Servicio Básico del Domicilio',
            'doc_responsabilidad_uso' => 'Responsabilidad Uso',
            'doc_contrato' => 'Contrato',
            'qrcode' => 'Qrcode',
            'fec_registro' => 'Fecha Registro',
            'status' => 'Estado',
            'upload_referencia_foto' => 'Foto Vivienda',
            'upload_cedula_pasaporte' => 'Cédula / Pasaporte',
            'upload_servicio_basico' => 'Servicio Básico',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabIntFormularioInvItemUsers()
    {
        return $this->hasMany(TabIntFormularioInvItemUser::className(), ['tab_int_formulario_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabIntFormularioInvServiceUsers()
    {
        return $this->hasMany(TabIntFormularioInvServiceUser::className(), ['tab_int_formulario_id' => 'id']);
    }

    //Función Subir Archivos
    //https://www.yiiframework.com/doc/guide/2.0/en/input-file-upload

    public function uploadDocumentos($model)
    {
        if ($this->validate()) {
            $this->upload_cedula_pasaporte->saveAs('uploads/tabintformulario/cedula_pasaporte/' . $model->doc_cedula_pasaporte,false);
            $this->upload_servicio_basico->saveAs('uploads/tabintformulario/servicio_basico/' . $model->doc_servicio_basico,false);
            $this->upload_referencia_foto->saveAs('uploads/tabintformulario/referencia_foto/' . $model->referencia_foto,false);
            return true;
        } else {
            return false;
        }
    }
}
