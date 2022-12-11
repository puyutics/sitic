<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_USER".
 *
 * @property string $AC_USER
 * @property int $AC_P1
 * @property int $AC_P2
 * @property int $AC_P3
 * @property int $AC_P4
 * @property int $AC_P5
 * @property int $AC_P6
 * @property int $AC_P7
 * @property int $AC_P8
 * @property int $AC_P9
 * @property int $AC_P10
 * @property int $AC_P11
 * @property int $AC_P12
 * @property int $AC_P13
 * @property int $AC_P14
 * @property int $AC_P15
 * @property int $AC_P16
 * @property int $AC_P17
 * @property int $AC_P18
 * @property int $AC_P19
 * @property int $AC_P20
 * @property string $AC_UCREA
 * @property string $AC_FCREA
 *
 * @property Nomina $aCUSER
 */
class AcUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_USER';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_onlycontrol');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AC_USER'], 'required'],
            [['AC_P1', 'AC_P2', 'AC_P3', 'AC_P4', 'AC_P5', 'AC_P6', 'AC_P7', 'AC_P8', 'AC_P9', 'AC_P10', 'AC_P11', 'AC_P12', 'AC_P13', 'AC_P14', 'AC_P15', 'AC_P16', 'AC_P17', 'AC_P18', 'AC_P19', 'AC_P20'], 'integer'],
            [['AC_FCREA'], 'safe'],
            [['AC_USER'], 'string', 'max' => 6],
            [['AC_UCREA'], 'string', 'max' => 10],
            [['AC_USER'], 'unique'],
            [['AC_USER'], 'exist', 'skipOnError' => true, 'targetClass' => Nomina::className(), 'targetAttribute' => ['AC_USER' => 'NOMINA_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AC_USER' => 'Ac User',
            'AC_P1' => 'Ac P1',
            'AC_P2' => 'Ac P2',
            'AC_P3' => 'Ac P3',
            'AC_P4' => 'Ac P4',
            'AC_P5' => 'Ac P5',
            'AC_P6' => 'Ac P6',
            'AC_P7' => 'Ac P7',
            'AC_P8' => 'Ac P8',
            'AC_P9' => 'Ac P9',
            'AC_P10' => 'Ac P10',
            'AC_P11' => 'Ac P11',
            'AC_P12' => 'Ac P12',
            'AC_P13' => 'Ac P13',
            'AC_P14' => 'Ac P14',
            'AC_P15' => 'Ac P15',
            'AC_P16' => 'Ac P16',
            'AC_P17' => 'Ac P17',
            'AC_P18' => 'Ac P18',
            'AC_P19' => 'Ac P19',
            'AC_P20' => 'Ac P20',
            'AC_UCREA' => 'Ac Ucrea',
            'AC_FCREA' => 'Ac Fcrea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getACUSER()
    {
        return $this->hasOne(Nomina::className(), ['NOMINA_ID' => 'AC_USER']);
    }
}
