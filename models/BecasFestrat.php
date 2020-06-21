<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "becas_festrat".
 *
 * @property int $idficha_sa
 * @property string $cedula
 * @property string $nombres_comp
 * @property int $periodo
 * @property string $p11
 * @property int $p12
 * @property int $p13
 * @property int $p14
 * @property string $p15
 * @property int $p21
 * @property int $p22
 * @property int $p23
 * @property int $p24
 * @property int $p31
 * @property int $p32
 * @property int $p33
 * @property int $p34
 * @property int $p35
 * @property int $p36
 * @property int $p37
 * @property int $p41
 * @property int $p42
 * @property int $p43
 * @property int $p44
 * @property int $p45
 * @property int $p51
 * @property int $p61
 * @property int $p62
 * @property string $p63
 * @property int $total
 * @property int $valoracion
 * @property string $Grupo
 * @property string $fecha_reg
 * @property int $status
 */
class BecasFestrat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'becas_festrat';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_bservicios');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cedula'], 'required'],
            [['periodo', 'p12', 'p13', 'p14', 'p21', 'p22', 'p23', 'p24', 'p31', 'p32', 'p33', 'p34', 'p35', 'p36', 'p37', 'p41', 'p42', 'p43', 'p44', 'p45', 'p51', 'p61', 'p62', 'total', 'valoracion', 'status'], 'integer'],
            [['fecha_reg'], 'safe'],
            [['cedula'], 'string', 'max' => 10],
            [['nombres_comp'], 'string', 'max' => 100],
            [['p11', 'p15', 'p63'], 'string', 'max' => 3],
            [['Grupo'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idficha_sa' => 'Idficha Sa',
            'cedula' => 'Cedula',
            'nombres_comp' => 'Nombres Comp',
            'periodo' => 'Periodo',
            'p11' => 'P11',
            'p12' => 'P12',
            'p13' => 'P13',
            'p14' => 'P14',
            'p15' => 'P15',
            'p21' => 'P21',
            'p22' => 'P22',
            'p23' => 'P23',
            'p24' => 'P24',
            'p31' => 'P31',
            'p32' => 'P32',
            'p33' => 'P33',
            'p34' => 'P34',
            'p35' => 'P35',
            'p36' => 'P36',
            'p37' => 'P37',
            'p41' => 'P41',
            'p42' => 'P42',
            'p43' => 'P43',
            'p44' => 'P44',
            'p45' => 'P45',
            'p51' => 'P51',
            'p61' => 'P61',
            'p62' => 'P62',
            'p63' => 'P63',
            'total' => 'Total',
            'valoracion' => 'Valoracion',
            'Grupo' => 'Grupo',
            'fecha_reg' => 'Fecha Reg',
            'status' => 'Status',
        ];
    }
}
