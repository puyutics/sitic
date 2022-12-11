<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "NEW_NOVEDAD".
 *
 * @property string $I_FECHA
 * @property string $I_COD
 * @property string $I_TIPO
 * @property string $I_TEXTO
 * @property string $I_TEXTO1
 * @property string $I_ACCION
 * @property string $I_USERCREA
 * @property string $I_FECHACREA
 * @property string $I_REPORTA
 *
 * @property Nomina $iCOD
 */
class NewNovedad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NEW_NOVEDAD';
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
            [['I_FECHA', 'I_COD'], 'required'],
            [['I_FECHA', 'I_FECHACREA'], 'safe'],
            [['I_COD'], 'string', 'max' => 6],
            [['I_TIPO'], 'string', 'max' => 15],
            [['I_TEXTO', 'I_TEXTO1', 'I_REPORTA'], 'string', 'max' => 100],
            [['I_ACCION', 'I_USERCREA'], 'string', 'max' => 10],
            [['I_COD', 'I_FECHA'], 'unique', 'targetAttribute' => ['I_COD', 'I_FECHA']],
            [['I_COD'], 'exist', 'skipOnError' => true, 'targetClass' => Nomina::className(), 'targetAttribute' => ['I_COD' => 'NOMINA_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'I_FECHA' => 'I Fecha',
            'I_COD' => 'I Cod',
            'I_TIPO' => 'I Tipo',
            'I_TEXTO' => 'I Texto',
            'I_TEXTO1' => 'I Texto1',
            'I_ACCION' => 'I Accion',
            'I_USERCREA' => 'I Usercrea',
            'I_FECHACREA' => 'I Fechacrea',
            'I_REPORTA' => 'I Reporta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getICOD()
    {
        return $this->hasOne(Nomina::className(), ['NOMINA_ID' => 'I_COD']);
    }
}
