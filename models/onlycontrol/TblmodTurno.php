<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBLMOD_TURNO".
 *
 * @property int $MOD_ID
 * @property string $MOD_DES
 * @property int $MOD_LUNES
 * @property int $MOD_MARTES
 * @property int $MOD_MIERCOLES
 * @property int $MOD_JUEVES
 * @property int $MOD_VIERNES
 * @property int $MOD_SABADO
 * @property int $MOD_DOMINGO
 *
 * @property NomPuerta[] $nomPuertas
 * @property Tblturno $mODLUNES
 * @property Tblturno $mODMARTES
 * @property Tblturno $mODMIERCOLES
 * @property Tblturno $mODJUEVES
 * @property Tblturno $mODVIERNES
 * @property Tblturno $mODSABADO
 * @property Tblturno $mODDOMINGO
 */
class TblmodTurno extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBLMOD_TURNO';
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
            [['MOD_ID'], 'required'],
            [['MOD_ID', 'MOD_LUNES', 'MOD_MARTES', 'MOD_MIERCOLES', 'MOD_JUEVES', 'MOD_VIERNES', 'MOD_SABADO', 'MOD_DOMINGO'], 'integer'],
            [['MOD_DES'], 'string', 'max' => 100],
            [['MOD_ID'], 'unique'],
            [['MOD_LUNES'], 'exist', 'skipOnError' => true, 'targetClass' => Tblturno::className(), 'targetAttribute' => ['MOD_LUNES' => 'TUR_ID']],
            [['MOD_MARTES'], 'exist', 'skipOnError' => true, 'targetClass' => Tblturno::className(), 'targetAttribute' => ['MOD_MARTES' => 'TUR_ID']],
            [['MOD_MIERCOLES'], 'exist', 'skipOnError' => true, 'targetClass' => Tblturno::className(), 'targetAttribute' => ['MOD_MIERCOLES' => 'TUR_ID']],
            [['MOD_JUEVES'], 'exist', 'skipOnError' => true, 'targetClass' => Tblturno::className(), 'targetAttribute' => ['MOD_JUEVES' => 'TUR_ID']],
            [['MOD_VIERNES'], 'exist', 'skipOnError' => true, 'targetClass' => Tblturno::className(), 'targetAttribute' => ['MOD_VIERNES' => 'TUR_ID']],
            [['MOD_SABADO'], 'exist', 'skipOnError' => true, 'targetClass' => Tblturno::className(), 'targetAttribute' => ['MOD_SABADO' => 'TUR_ID']],
            [['MOD_DOMINGO'], 'exist', 'skipOnError' => true, 'targetClass' => Tblturno::className(), 'targetAttribute' => ['MOD_DOMINGO' => 'TUR_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MOD_ID' => 'Mod ID',
            'MOD_DES' => 'Mod Des',
            'MOD_LUNES' => 'Mod Lunes',
            'MOD_MARTES' => 'Mod Martes',
            'MOD_MIERCOLES' => 'Mod Miercoles',
            'MOD_JUEVES' => 'Mod Jueves',
            'MOD_VIERNES' => 'Mod Viernes',
            'MOD_SABADO' => 'Mod Sabado',
            'MOD_DOMINGO' => 'Mod Domingo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNomPuertas()
    {
        return $this->hasMany(NomPuerta::className(), ['TURN_ID' => 'MOD_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMODLUNES()
    {
        return $this->hasOne(Tblturno::className(), ['TUR_ID' => 'MOD_LUNES']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMODMARTES()
    {
        return $this->hasOne(Tblturno::className(), ['TUR_ID' => 'MOD_MARTES']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMODMIERCOLES()
    {
        return $this->hasOne(Tblturno::className(), ['TUR_ID' => 'MOD_MIERCOLES']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMODJUEVES()
    {
        return $this->hasOne(Tblturno::className(), ['TUR_ID' => 'MOD_JUEVES']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMODVIERNES()
    {
        return $this->hasOne(Tblturno::className(), ['TUR_ID' => 'MOD_VIERNES']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMODSABADO()
    {
        return $this->hasOne(Tblturno::className(), ['TUR_ID' => 'MOD_SABADO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMODDOMINGO()
    {
        return $this->hasOne(Tblturno::className(), ['TUR_ID' => 'MOD_DOMINGO']);
    }
}
