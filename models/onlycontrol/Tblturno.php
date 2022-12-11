<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBLTURNO".
 *
 * @property int $TUR_ID
 * @property string $TUR_D
 * @property string $TUR_F
 * @property string $TUR_HING1
 * @property string $TUR_HSAL1
 * @property string $TUR_HING2
 * @property string $TUR_HSAL2
 * @property string $TUR_HING3
 * @property string $TUR_HSAL3
 * @property string $TUR_HING4
 * @property string $TUR_HSAL4
 *
 * @property TblmodTurno[] $tblmodTurnos
 * @property TblmodTurno[] $tblmodTurnos0
 * @property TblmodTurno[] $tblmodTurnos1
 * @property TblmodTurno[] $tblmodTurnos2
 * @property TblmodTurno[] $tblmodTurnos3
 * @property TblmodTurno[] $tblmodTurnos4
 * @property TblmodTurno[] $tblmodTurnos5
 */
class Tblturno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBLTURNO';
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
            [['TUR_ID'], 'required'],
            [['TUR_ID'], 'integer'],
            [['TUR_HING1', 'TUR_HSAL1', 'TUR_HING2', 'TUR_HSAL2', 'TUR_HING3', 'TUR_HSAL3', 'TUR_HING4', 'TUR_HSAL4'], 'safe'],
            [['TUR_D'], 'string', 'max' => 30],
            [['TUR_F'], 'string', 'max' => 50],
            [['TUR_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TUR_ID' => 'Tur ID',
            'TUR_D' => 'Tur D',
            'TUR_F' => 'Tur F',
            'TUR_HING1' => 'Tur Hing1',
            'TUR_HSAL1' => 'Tur Hsal1',
            'TUR_HING2' => 'Tur Hing2',
            'TUR_HSAL2' => 'Tur Hsal2',
            'TUR_HING3' => 'Tur Hing3',
            'TUR_HSAL3' => 'Tur Hsal3',
            'TUR_HING4' => 'Tur Hing4',
            'TUR_HSAL4' => 'Tur Hsal4',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblmodTurnos()
    {
        return $this->hasMany(TblmodTurno::className(), ['MOD_LUNES' => 'TUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblmodTurnos0()
    {
        return $this->hasMany(TblmodTurno::className(), ['MOD_MARTES' => 'TUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblmodTurnos1()
    {
        return $this->hasMany(TblmodTurno::className(), ['MOD_MIERCOLES' => 'TUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblmodTurnos2()
    {
        return $this->hasMany(TblmodTurno::className(), ['MOD_JUEVES' => 'TUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblmodTurnos3()
    {
        return $this->hasMany(TblmodTurno::className(), ['MOD_VIERNES' => 'TUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblmodTurnos4()
    {
        return $this->hasMany(TblmodTurno::className(), ['MOD_SABADO' => 'TUR_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblmodTurnos5()
    {
        return $this->hasMany(TblmodTurno::className(), ['MOD_DOMINGO' => 'TUR_ID']);
    }
}
