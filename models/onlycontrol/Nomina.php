<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "NOMINA".
 *
 * @property string $NOMINA_ID
 * @property string $NOMINA_APE
 * @property string $NOMINA_NOM
 * @property string $NOMINA_CLAVE
 * @property string $NOMINA_COD
 * @property string $NOMINA_TIPO
 * @property string $NOMINA_CAL
 * @property string $NOMINA_AREA
 * @property string $NOMINA_DEP
 * @property string $NOMINA_CAL1
 * @property string $NOMINA_AREA1
 * @property string $NOMINA_DEP1
 * @property string $NOMINA_FING
 * @property string $NOMINA_FSAL
 * @property string $NOMINA_SUEL
 * @property string $NOMINA_COM
 * @property int $NOMINA_AUTI
 * @property int $NOMINA_ES
 * @property string $NOMINA_OBS
 * @property string $NOMINA_EMP
 * @property string $NOMINA_FINGER
 * @property resource $NOMINA_F1
 * @property resource $NOMINA_CED
 * @property resource $NOMINA_FIR
 * @property string $NOMINA_HD1
 * @property resource $NOMINA_HF1
 * @property resource $NOMINA_HI1
 * @property string $NOMINA_HD2
 * @property resource $NOMINA_HF2
 * @property resource $NOMINA_HI2
 * @property int $NOMINA_SEL
 * @property string $NOMINA_EMPC
 * @property string $NOMINA_EMPE
 * @property int $NOMINA_P1
 * @property int $NOMINA_P2
 * @property int $NOMINA_P3
 * @property int $NOMINA_P4
 * @property int $NOMINA_P5
 * @property int $NOMINA_P6
 * @property int $NOMINA_P7
 * @property int $NOMINA_P8
 * @property int $NOMINA_P9
 * @property int $NOMINA_P10
 * @property int $NOMINA_P11
 * @property int $NOMINA_P12
 * @property int $NOMINA_P13
 * @property int $NOMINA_P14
 * @property int $NOMINA_P15
 * @property int $NOMINA_P16
 * @property int $NOMINA_P17
 * @property int $NOMINA_P18
 * @property int $NOMINA_P19
 * @property int $NOMINA_P20
 * @property resource $NOMINA_DOC
 * @property resource $NOMINA_PLA
 * @property int $NOMINA_F
 * @property string $NOMINA_CARD
 * @property string $NOMINA_FCARD
 * @property string $NOMINA_OBS1
 * @property string $NOMINA_NOW
 * @property int $NOMINA_CAFE
 * @property string $NOMINA_AUTO
 * @property int $NOMINA_P21
 * @property int $NOMINA_P22
 * @property int $NOMINA_P23
 * @property int $NOMINA_P24
 * @property int $NOMINA_P25
 * @property int $NOMINA_CONTROLAPB 0 -> SIN CONTROL / 1 CONTROL
 * @property int $NOMINA_STATUSAPB 0 -> RESET / 1-> INGRESO / 2->
 * @property int $NOMINA_CAFEMENU
 * @property int $NOMINA_LEVEL
 * @property string $NOMINA_TIPOID
 * @property string $NOMINA_TIPONOM
 * @property string $NOMINA_HS1
 * @property string $NOMINA_HS2
 * @property string $NOMINA_CAFECONTROL
 * @property double $NOMINA_SERV1
 * @property double $NOMINA_SERV2
 * @property double $NOMINA_SERV3
 * @property double $NOMINA_SERV4
 * @property double $NOMINA_SERV5
 * @property double $NOMINA_SERV6
 * @property double $NOMINA_SERV7
 * @property double $NOMINA_SERV8
 * @property double $NOMINA_SERV9
 * @property string $NOMINA_CARDKEY
 * @property int $NOMINA_TIPO_REGISTRO
 * @property resource $NOMINA_HWSQ1
 * @property resource $NOMINA_HWSQ2
 * @property string $NOMINA_FACE
 * @property int $NOMINA_FACE_LEN
 * @property string $B_MATCHER_FLAG
 * @property int $NOMINA_P26
 * @property string $NOMINA_KEY_CONSULT
 * @property int $NOMINA_P27
 * @property int $NOMINA_ADMIN_BIO
 *
 * @property AcNomPuerta[] $acNomPuertas
 * @property AcPuerta[] $pUERs
 * @property AcUser $acUser
 * @property NewNovedad[] $newNovedads
 * @property NomPuerta[] $nomPuertas
 * @property Puerta[] $pUERs0
 * @property Califica $nOMINACAL
 * @property Area $nOMINAAREA
 * @property Dpto $nOMINADEP
 * @property Externoe $nOMINAEMP
 * @property TblMenupersona[] $tblMenupersonas
 * @property TblMenu[] $hTIPOCs
 */
class Nomina extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NOMINA';
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
            [['NOMINA_ID', 'NOMINA_APE', 'NOMINA_NOM', 'NOMINA_CAL', 'NOMINA_AREA', 'NOMINA_DEP', 'NOMINA_EMP'], 'required'],
            [['NOMINA_CAL', 'NOMINA_AREA', 'NOMINA_DEP', 'NOMINA_SUEL', 'NOMINA_COM', 'NOMINA_EMP', 'NOMINA_CAFECONTROL', 'NOMINA_SERV1', 'NOMINA_SERV2', 'NOMINA_SERV3', 'NOMINA_SERV4', 'NOMINA_SERV5', 'NOMINA_SERV6', 'NOMINA_SERV7', 'NOMINA_SERV8', 'NOMINA_SERV9'], 'number'],
            [['NOMINA_FING', 'NOMINA_FSAL', 'NOMINA_FCARD', 'NOMINA_NOW'], 'safe'],
            [['NOMINA_AUTI', 'NOMINA_ES', 'NOMINA_SEL', 'NOMINA_P1', 'NOMINA_P2', 'NOMINA_P3', 'NOMINA_P4', 'NOMINA_P5', 'NOMINA_P6', 'NOMINA_P7', 'NOMINA_P8', 'NOMINA_P9', 'NOMINA_P10', 'NOMINA_P11', 'NOMINA_P12', 'NOMINA_P13', 'NOMINA_P14', 'NOMINA_P15', 'NOMINA_P16', 'NOMINA_P17', 'NOMINA_P18', 'NOMINA_P19', 'NOMINA_P20', 'NOMINA_F', 'NOMINA_CAFE', 'NOMINA_P21', 'NOMINA_P22', 'NOMINA_P23', 'NOMINA_P24', 'NOMINA_P25', 'NOMINA_CONTROLAPB', 'NOMINA_STATUSAPB', 'NOMINA_CAFEMENU', 'NOMINA_LEVEL', 'NOMINA_TIPO_REGISTRO', 'NOMINA_FACE_LEN', 'NOMINA_P26', 'NOMINA_P27', 'NOMINA_ADMIN_BIO'], 'integer'],
            [['NOMINA_F1', 'NOMINA_CED', 'NOMINA_FIR', 'NOMINA_HF1', 'NOMINA_HI1', 'NOMINA_HF2', 'NOMINA_HI2', 'NOMINA_DOC', 'NOMINA_PLA', 'NOMINA_HWSQ1', 'NOMINA_HWSQ2', 'NOMINA_FACE'], 'string'],
            [['NOMINA_ID', 'NOMINA_CARDKEY'], 'string', 'max' => 6],
            [['NOMINA_APE', 'NOMINA_CAL1', 'NOMINA_AREA1', 'NOMINA_DEP1', 'NOMINA_OBS', 'NOMINA_OBS1'], 'string', 'max' => 100],
            [['NOMINA_NOM', 'NOMINA_CARD', 'NOMINA_AUTO'], 'string', 'max' => 50],
            [['NOMINA_CLAVE'], 'string', 'max' => 8],
            [['NOMINA_COD'], 'string', 'max' => 15],
            [['NOMINA_TIPO'], 'string', 'max' => 30],
            [['NOMINA_FINGER'], 'string', 'max' => 3],
            [['NOMINA_HD1', 'NOMINA_HD2', 'NOMINA_EMPC', 'NOMINA_KEY_CONSULT'], 'string', 'max' => 10],
            [['NOMINA_EMPE'], 'string', 'max' => 20],
            [['NOMINA_TIPOID'], 'string', 'max' => 5],
            [['NOMINA_TIPONOM'], 'string', 'max' => 35],
            [['NOMINA_HS1', 'NOMINA_HS2'], 'string', 'max' => 3000],
            [['B_MATCHER_FLAG'], 'string', 'max' => 1],
            [['NOMINA_ID'], 'unique'],
            [['NOMINA_CAL', 'NOMINA_CAL1'], 'exist', 'skipOnError' => true, 'targetClass' => Califica::className(), 'targetAttribute' => ['NOMINA_CAL' => 'CALI_ID', 'NOMINA_CAL1' => 'CALI_NOM']],
            [['NOMINA_AREA', 'NOMINA_AREA1'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['NOMINA_AREA' => 'AREA_ID', 'NOMINA_AREA1' => 'AREA_NOM']],
            [['NOMINA_DEP', 'NOMINA_DEP1'], 'exist', 'skipOnError' => true, 'targetClass' => Dpto::className(), 'targetAttribute' => ['NOMINA_DEP' => 'DEP_ID', 'NOMINA_DEP1' => 'DEP_NOM']],
            [['NOMINA_EMP'], 'exist', 'skipOnError' => true, 'targetClass' => Externoe::className(), 'targetAttribute' => ['NOMINA_EMP' => 'EMPE_ID']],
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
            'NOMINA_CLAVE' => 'Nomina Clave',
            'NOMINA_COD' => 'Nomina Cod',
            'NOMINA_TIPO' => 'Nomina Tipo',
            'NOMINA_CAL' => 'Nomina Cal',
            'NOMINA_AREA' => 'Nomina Area',
            'NOMINA_DEP' => 'Nomina Dep',
            'NOMINA_CAL1' => 'Nomina Cal1',
            'NOMINA_AREA1' => 'Nomina Area1',
            'NOMINA_DEP1' => 'Nomina Dep1',
            'NOMINA_FING' => 'Nomina Fing',
            'NOMINA_FSAL' => 'Nomina Fsal',
            'NOMINA_SUEL' => 'Nomina Suel',
            'NOMINA_COM' => 'Nomina Com',
            'NOMINA_AUTI' => 'Nomina Auti',
            'NOMINA_ES' => 'Nomina Es',
            'NOMINA_OBS' => 'Nomina Obs',
            'NOMINA_EMP' => 'Nomina Emp',
            'NOMINA_FINGER' => 'Nomina Finger',
            'NOMINA_F1' => 'Nomina F1',
            'NOMINA_CED' => 'Nomina Ced',
            'NOMINA_FIR' => 'Nomina Fir',
            'NOMINA_HD1' => 'Nomina Hd1',
            'NOMINA_HF1' => 'Nomina Hf1',
            'NOMINA_HI1' => 'Nomina Hi1',
            'NOMINA_HD2' => 'Nomina Hd2',
            'NOMINA_HF2' => 'Nomina Hf2',
            'NOMINA_HI2' => 'Nomina Hi2',
            'NOMINA_SEL' => 'Nomina Sel',
            'NOMINA_EMPC' => 'Nomina Empc',
            'NOMINA_EMPE' => 'Nomina Empe',
            'NOMINA_P1' => 'Nomina P1',
            'NOMINA_P2' => 'Nomina P2',
            'NOMINA_P3' => 'Nomina P3',
            'NOMINA_P4' => 'Nomina P4',
            'NOMINA_P5' => 'Nomina P5',
            'NOMINA_P6' => 'Nomina P6',
            'NOMINA_P7' => 'Nomina P7',
            'NOMINA_P8' => 'Nomina P8',
            'NOMINA_P9' => 'Nomina P9',
            'NOMINA_P10' => 'Nomina P10',
            'NOMINA_P11' => 'Nomina P11',
            'NOMINA_P12' => 'Nomina P12',
            'NOMINA_P13' => 'Nomina P13',
            'NOMINA_P14' => 'Nomina P14',
            'NOMINA_P15' => 'Nomina P15',
            'NOMINA_P16' => 'Nomina P16',
            'NOMINA_P17' => 'Nomina P17',
            'NOMINA_P18' => 'Nomina P18',
            'NOMINA_P19' => 'Nomina P19',
            'NOMINA_P20' => 'Nomina P20',
            'NOMINA_DOC' => 'Nomina Doc',
            'NOMINA_PLA' => 'Nomina Pla',
            'NOMINA_F' => 'Nomina F',
            'NOMINA_CARD' => 'Nomina Card',
            'NOMINA_FCARD' => 'Nomina Fcard',
            'NOMINA_OBS1' => 'Nomina Obs1',
            'NOMINA_NOW' => 'Nomina Now',
            'NOMINA_CAFE' => 'Nomina Cafe',
            'NOMINA_AUTO' => 'Nomina Auto',
            'NOMINA_P21' => 'Nomina P21',
            'NOMINA_P22' => 'Nomina P22',
            'NOMINA_P23' => 'Nomina P23',
            'NOMINA_P24' => 'Nomina P24',
            'NOMINA_P25' => 'Nomina P25',
            'NOMINA_CONTROLAPB' => '0 -> SIN CONTROL / 1 CONTROL',
            'NOMINA_STATUSAPB' => '0 -> RESET / 1-> INGRESO / 2->',
            'NOMINA_CAFEMENU' => 'Nomina Cafemenu',
            'NOMINA_LEVEL' => 'Nomina Level',
            'NOMINA_TIPOID' => 'Nomina Tipoid',
            'NOMINA_TIPONOM' => 'Nomina Tiponom',
            'NOMINA_HS1' => 'Nomina Hs1',
            'NOMINA_HS2' => 'Nomina Hs2',
            'NOMINA_CAFECONTROL' => 'Nomina Cafecontrol',
            'NOMINA_SERV1' => 'Nomina Serv1',
            'NOMINA_SERV2' => 'Nomina Serv2',
            'NOMINA_SERV3' => 'Nomina Serv3',
            'NOMINA_SERV4' => 'Nomina Serv4',
            'NOMINA_SERV5' => 'Nomina Serv5',
            'NOMINA_SERV6' => 'Nomina Serv6',
            'NOMINA_SERV7' => 'Nomina Serv7',
            'NOMINA_SERV8' => 'Nomina Serv8',
            'NOMINA_SERV9' => 'Nomina Serv9',
            'NOMINA_CARDKEY' => 'Nomina Cardkey',
            'NOMINA_TIPO_REGISTRO' => 'Nomina Tipo Registro',
            'NOMINA_HWSQ1' => 'Nomina Hwsq1',
            'NOMINA_HWSQ2' => 'Nomina Hwsq2',
            'NOMINA_FACE' => 'Nomina Face',
            'NOMINA_FACE_LEN' => 'Nomina Face Len',
            'B_MATCHER_FLAG' => 'B Matcher Flag',
            'NOMINA_P26' => 'Nomina P26',
            'NOMINA_KEY_CONSULT' => 'Nomina Key Consult',
            'NOMINA_P27' => 'Nomina P27',
            'NOMINA_ADMIN_BIO' => 'Nomina Admin Bio',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcNomPuertas()
    {
        return $this->hasMany(AcNomPuerta::className(), ['NOM_ID' => 'NOMINA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPUERs()
    {
        return $this->hasMany(AcPuerta::className(), ['PRT_COD' => 'PUER_ID'])->viaTable('AC_NOM_PUERTA', ['NOM_ID' => 'NOMINA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcUser()
    {
        return $this->hasOne(AcUser::className(), ['AC_USER' => 'NOMINA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewNovedads()
    {
        return $this->hasMany(NewNovedad::className(), ['I_COD' => 'NOMINA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNomPuertas()
    {
        return $this->hasMany(NomPuerta::className(), ['NOM_ID' => 'NOMINA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPUERs0()
    {
        return $this->hasMany(Puerta::className(), ['PRT_COD' => 'PUER_ID'])->viaTable('NOM_PUERTA', ['NOM_ID' => 'NOMINA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOMINACAL()
    {
        return $this->hasOne(Califica::className(), ['CALI_ID' => 'NOMINA_CAL', 'CALI_NOM' => 'NOMINA_CAL1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOMINAAREA()
    {
        return $this->hasOne(Area::className(), ['AREA_ID' => 'NOMINA_AREA', 'AREA_NOM' => 'NOMINA_AREA1']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOMINADEP()
    {
        return $this->hasOne(Dpto::className(), ['DEP_ID' => 'NOMINA_DEP', 'DEP_NOM' => 'NOMINA_DEP1']);
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
    public function getTblMenupersonas()
    {
        return $this->hasMany(TblMenupersona::className(), ['H_NOMINAID' => 'NOMINA_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHTIPOCs()
    {
        return $this->hasMany(TblMenu::className(), ['M_TIPOC' => 'H_TIPOC', 'M_MENU' => 'H_MENU'])->viaTable('TBL_MENUPERSONA', ['H_NOMINAID' => 'NOMINA_ID']);
    }

    public function getDatosCompletos()
    {
        return $this->NOMINA_COD." : ".$this->NOMINA_APE." ".$this->NOMINA_NOM;
    }
}
