<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tab_int_senescyt".
 *
 * @property int $id
 * @property string $fec_inicio
 * @property string $fec_fin
 * @property string $email
 * @property string $nombres
 * @property string $cedula_pasaporte
 * @property string $provincia
 * @property string $canton
 * @property string $parroquia
 * @property string $direccion
 * @property string $nivel
 * @property string $carrera
 * @property string $semestre
 * @property string $equipos
 * @property string $computador
 * @property string $portatil
 * @property string $tablet
 * @property string $radio
 * @property string $television
 * @property string $smartphone
 * @property string $mic_computador
 * @property string $cam_computador
 * @property string $par_computador
 * @property string $mic_portatil
 * @property string $cam_portatil
 * @property string $par_portatil
 * @property string $internet
 * @property string $tipo
 * @property string $proveedor
 * @property string $velocidad
 * @property string $teletrabajo
 * @property string $estudios
 * @property string $cant_usuarios
 * @property string $horas
 * @property string $accion
 */
class TabIntSenescyt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tab_int_senescyt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fec_inicio', 'fec_fin'], 'safe'],
            [['email', 'nombres', 'cedula_pasaporte', 'provincia', 'canton', 'parroquia', 'direccion', 'nivel', 'carrera', 'semestre', 'equipos', 'computador', 'portatil', 'tablet', 'radio', 'television', 'smartphone', 'mic_computador', 'cam_computador', 'par_computador', 'mic_portatil', 'cam_portatil', 'par_portatil', 'internet', 'tipo', 'proveedor', 'velocidad', 'teletrabajo', 'estudios', 'cant_usuarios', 'horas', 'accion'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fec_inicio' => 'Fec Inicio',
            'fec_fin' => 'Fec Fin',
            'email' => 'Email',
            'nombres' => 'Nombres',
            'cedula_pasaporte' => 'Cedula Pasaporte',
            'provincia' => 'Provincia',
            'canton' => 'Canton',
            'parroquia' => 'Parroquia',
            'direccion' => 'Direccion',
            'nivel' => 'Nivel',
            'carrera' => 'Carrera',
            'semestre' => 'Semestre',
            'equipos' => 'Equipos',
            'computador' => 'Computador',
            'portatil' => 'Portatil',
            'tablet' => 'Tablet',
            'radio' => 'Radio',
            'television' => 'Television',
            'smartphone' => 'Smartphone',
            'mic_computador' => 'Mic Computador',
            'cam_computador' => 'Cam Computador',
            'par_computador' => 'Par Computador',
            'mic_portatil' => 'Mic Portatil',
            'cam_portatil' => 'Cam Portatil',
            'par_portatil' => 'Par Portatil',
            'internet' => 'Internet',
            'tipo' => 'Tipo',
            'proveedor' => 'Proveedor',
            'velocidad' => 'Velocidad',
            'teletrabajo' => 'Teletrabajo',
            'estudios' => 'Estudios',
            'cant_usuarios' => 'Cant Usuarios',
            'horas' => 'Horas',
            'accion' => 'Accion',
        ];
    }
}
