<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tab_int_encuestas".
 *
 * @property int $ID
 * @property int $ObjectID
 * @property string $GlobalID
 * @property string $CreationDate
 * @property string $Creator
 * @property string $EditDate
 * @property string $Editor
 * @property string $CedulaPasaporte
 * @property string $Nombres
 * @property string $Apellidos
 * @property string $Email
 * @property string $Campus
 * @property string $Carrera
 * @property string $Telefono
 * @property string $Operadora
 * @property string $Internet
 * @property string $TipoInternet
 * @property string $Computador
 * @property string $TipoComputador
 * @property string $PropiedadComputador
 * @property string $x
 * @property string $y
 * @property string $Beneficio
 */
class TabIntEncuestas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tab_int_encuestas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ObjectID'], 'integer'],
            [['CreationDate', 'EditDate'], 'safe'],
            [['GlobalID', 'Creator', 'Editor', 'Nombres', 'Apellidos', 'Email', 'Campus', 'Carrera', 'Telefono', 'Operadora', 'Internet', 'TipoInternet', 'Computador', 'TipoComputador', 'PropiedadComputador', 'x', 'y', 'Beneficio'], 'string', 'max' => 255],
            [['CedulaPasaporte'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'ObjectID' => 'Object ID',
            'GlobalID' => 'Global ID',
            'CreationDate' => 'Creation Date',
            'Creator' => 'Creator',
            'EditDate' => 'Edit Date',
            'Editor' => 'Editor',
            'CedulaPasaporte' => 'Cedula Pasaporte',
            'Nombres' => 'Nombres',
            'Apellidos' => 'Apellidos',
            'Email' => 'Email',
            'Campus' => 'Campus',
            'Carrera' => 'Carrera',
            'Telefono' => 'Telefono',
            'Operadora' => 'Operadora',
            'Internet' => 'Internet',
            'TipoInternet' => 'Tipo Internet',
            'Computador' => 'Computador',
            'TipoComputador' => 'Tipo Computador',
            'PropiedadComputador' => 'Propiedad Computador',
            'x' => 'X',
            'y' => 'Y',
            'Beneficio' => 'Beneficio',
        ];
    }
}
