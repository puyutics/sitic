<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "adldap_new_users".
 *
 * @property int $id ID
 * @property string $dni CEDULA/PASAPORTE
 * @property string $nombres NOMBRES
 * @property string $apellidos APELLIDOS
 * @property string $fec_nacimiento FECHA NACIMIENTO
 * @property string $campus CAMPUS
 * @property string $carrera CARRERA
 * @property string $email_personal EMAIL PERSONAL
 * @property string $celular CELULAR
 * @property int $status ESTADO
 */
class AdldapNewUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'adldap_new_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fec_nacimiento'], 'safe'],
            [['status'], 'integer'],
            [['dni', 'nombres', 'apellidos', 'campus', 'carrera', 'email_personal', 'celular'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dni' => 'Dni',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'fec_nacimiento' => 'Fec Nacimiento',
            'campus' => 'Campus',
            'carrera' => 'Carrera',
            'email_personal' => 'Email Personal',
            'celular' => 'Celular',
            'status' => 'Status',
        ];
    }
}
