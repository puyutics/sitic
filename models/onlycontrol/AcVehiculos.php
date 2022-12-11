<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_VEHICULOS".
 *
 * @property string $VE_ID
 * @property string $VE_PLACA
 * @property string $VE_TIPO
 * @property string $VE_MARCA
 * @property string $VE_MODELO
 * @property string $VE_EMPRESA
 * @property string $VE_COLOR
 * @property resource $VE_MATRICULA
 * @property string $VE_PROPNOM
 * @property string $VE_PROPCED
 * @property string $VE_OBS
 * @property string $VE_FCREA
 * @property string $VE_UCREA
 *
 * @property AcVTipo $vETIPO
 * @property AcVModelo $vEMARCA
 * @property Externoe $vEEMPRESA
 */
class AcVehiculos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_VEHICULOS';
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
            [['VE_EMPRESA'], 'number'],
            [['VE_MATRICULA'], 'string'],
            [['VE_FCREA'], 'safe'],
            [['VE_PLACA', 'VE_UCREA'], 'string', 'max' => 10],
            [['VE_TIPO', 'VE_MARCA', 'VE_MODELO'], 'string', 'max' => 25],
            [['VE_COLOR'], 'string', 'max' => 20],
            [['VE_PROPNOM', 'VE_OBS'], 'string', 'max' => 100],
            [['VE_PROPCED'], 'string', 'max' => 12],
            [['VE_PLACA'], 'unique'],
            [['VE_TIPO'], 'exist', 'skipOnError' => true, 'targetClass' => AcVTipo::className(), 'targetAttribute' => ['VE_TIPO' => 'VT_NOM']],
            [['VE_MARCA', 'VE_MODELO'], 'exist', 'skipOnError' => true, 'targetClass' => AcVModelo::className(), 'targetAttribute' => ['VE_MARCA' => 'VMO_MARCA', 'VE_MODELO' => 'VMO_MODELO']],
            [['VE_EMPRESA'], 'exist', 'skipOnError' => true, 'targetClass' => Externoe::className(), 'targetAttribute' => ['VE_EMPRESA' => 'EMPE_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'VE_ID' => 'Ve ID',
            'VE_PLACA' => 'Ve Placa',
            'VE_TIPO' => 'Ve Tipo',
            'VE_MARCA' => 'Ve Marca',
            'VE_MODELO' => 'Ve Modelo',
            'VE_EMPRESA' => 'Ve Empresa',
            'VE_COLOR' => 'Ve Color',
            'VE_MATRICULA' => 'Ve Matricula',
            'VE_PROPNOM' => 'Ve Propnom',
            'VE_PROPCED' => 'Ve Propced',
            'VE_OBS' => 'Ve Obs',
            'VE_FCREA' => 'Ve Fcrea',
            'VE_UCREA' => 'Ve Ucrea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVETIPO()
    {
        return $this->hasOne(AcVTipo::className(), ['VT_NOM' => 'VE_TIPO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVEMARCA()
    {
        return $this->hasOne(AcVModelo::className(), ['VMO_MARCA' => 'VE_MARCA', 'VMO_MODELO' => 'VE_MODELO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVEEMPRESA()
    {
        return $this->hasOne(Externoe::className(), ['EMPE_ID' => 'VE_EMPRESA']);
    }
}
