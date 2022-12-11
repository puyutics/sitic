<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_NOMINA".
 *
 * @property string $NOMINA_ID
 * @property string $NOMINA_APE
 * @property string $NOMINA_NOM
 * @property string $NOMINA_CED
 * @property string $NOMINA_EMP
 * @property string $NOMINA_CARGO
 * @property string $NOMINA_CARGOC
 * @property string $NOMINA_OBS
 * @property resource $NOMINA_FOTO
 * @property resource $NOMINA_FIRMA
 * @property resource $NOMINA_CRE
 * @property resource $NOMINA_HF1
 * @property resource $NOMINA_HI1
 * @property string $NOMINA_HD1
 * @property resource $NOMINA_HF2
 * @property resource $NOMINA_HI2
 * @property string $NOMINA_HD2
 * @property string $NOMINA_FCREA
 * @property string $NOMINA_UCREA
 * @property string $NOMINA_FLAG 0 Activa 1 Bloqueado
 *
 * @property Externoe $nOMINAEMP
 * @property Califica $nOMINACARGO
 */
class AcNomina extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_NOMINA';
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
            [['NOMINA_ID', 'NOMINA_APE'], 'required'],
            [['NOMINA_EMP', 'NOMINA_CARGO'], 'number'],
            [['NOMINA_FOTO', 'NOMINA_FIRMA', 'NOMINA_CRE', 'NOMINA_HF1', 'NOMINA_HI1', 'NOMINA_HF2', 'NOMINA_HI2'], 'string'],
            [['NOMINA_FCREA'], 'safe'],
            [['NOMINA_ID'], 'string', 'max' => 6],
            [['NOMINA_APE', 'NOMINA_NOM', 'NOMINA_CARGOC', 'NOMINA_OBS'], 'string', 'max' => 100],
            [['NOMINA_CED'], 'string', 'max' => 12],
            [['NOMINA_HD1', 'NOMINA_HD2', 'NOMINA_UCREA'], 'string', 'max' => 10],
            [['NOMINA_FLAG'], 'string', 'max' => 1],
            [['NOMINA_ID'], 'unique'],
            [['NOMINA_EMP'], 'exist', 'skipOnError' => true, 'targetClass' => Externoe::className(), 'targetAttribute' => ['NOMINA_EMP' => 'EMPE_ID']],
            [['NOMINA_CARGO', 'NOMINA_CARGOC'], 'exist', 'skipOnError' => true, 'targetClass' => Califica::className(), 'targetAttribute' => ['NOMINA_CARGO' => 'CALI_ID', 'NOMINA_CARGOC' => 'CALI_NOM']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NOMINA_ID' => 'Nomina ID',
            'NOMINA_APE' => 'Nomina Ape',
            'NOMINA_NOM' => 'Nomina Nom',
            'NOMINA_CED' => 'Nomina Ced',
            'NOMINA_EMP' => 'Nomina Emp',
            'NOMINA_CARGO' => 'Nomina Cargo',
            'NOMINA_CARGOC' => 'Nomina Cargoc',
            'NOMINA_OBS' => 'Nomina Obs',
            'NOMINA_FOTO' => 'Nomina Foto',
            'NOMINA_FIRMA' => 'Nomina Firma',
            'NOMINA_CRE' => 'Nomina Cre',
            'NOMINA_HF1' => 'Nomina Hf1',
            'NOMINA_HI1' => 'Nomina Hi1',
            'NOMINA_HD1' => 'Nomina Hd1',
            'NOMINA_HF2' => 'Nomina Hf2',
            'NOMINA_HI2' => 'Nomina Hi2',
            'NOMINA_HD2' => 'Nomina Hd2',
            'NOMINA_FCREA' => 'Nomina Fcrea',
            'NOMINA_UCREA' => 'Nomina Ucrea',
            'NOMINA_FLAG' => '0 Activa 1 Bloqueado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOMINAEMP()
    {
        return $this->hasOne(Externoe::className(), ['EMPE_ID' => 'NOMINA_EMP']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOMINACARGO()
    {
        return $this->hasOne(Califica::className(), ['CALI_ID' => 'NOMINA_CARGO', 'CALI_NOM' => 'NOMINA_CARGOC']);
    }
}
