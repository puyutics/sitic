<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "PUERTA".
 *
 * @property string $PRT_COD
 * @property string $PRI_DES
 * @property string $PRI_LOC
 * @property int $PRI_P
 * @property string $PRI_AREA
 * @property string $PRI_AREA1
 * @property string $PRI_IP
 * @property string $PRI_FEC
 * @property string $PRI_STA
 * @property string $PRI_ST
 * @property string $PRI_PTO
 * @property string $PRI_TIPO
 * @property string $PRI_VIRDI
 * @property string $PRI_TI
 * @property string $PRI_TE
 * @property string $PRI_PRINTER
 * @property int $PRI_VALCLAVE
 * @property int $PRI_SEL
 * @property string $PRI_LASTUSER
 * @property string $PRI_LASTMARCA
 * @property int $PRI_OPEN
 * @property int $PRI_TIEMPO
 * @property int $PRI_VERIFICA
 * @property string $PRI_LAST_ID
 * @property string $PRI_NOW
 * @property int $PRI_VALIDA
 * @property string $PRI_EVENTO
 * @property int $PRI_ENVIA_ALERTA
 * @property int $PRI_EMPRESA
 * @property string $PRI_EMPRESA_NOM
 * @property string $PRI_SERVER
 * @property int $PRI_CAM
 * @property string $PRI_CAM_IP
 * @property string $PRI_CAM_PASS
 * @property string $PRI_CAM_USER
 * @property string $PRI_CAM_URL
 * @property int $PRI_CONTROL_MARCA
 * @property string $PRI_MAC
 * @property string $PRI_MAC_KEY
 * @property string $PRI_ESTADO_LICENCIA
 * @property int $PRI_RA
 * @property double $PRI_LAT
 * @property double $PRI_LON
 * @property double $PRI_PER
 * @property int $PRI_SERV
 * @property int $PRI_ACTIVAGPS
 * @property string $PRI_ALTITUD
 * @property string $PRI_LONGITUD
 * @property string $PRI_DISTANCIA
 * @property string $PRI_KEYEQUIPO
 * @property int $PRI_DPTO
 * @property int $PRI_ENROLA
 *
 * @property NomPuerta[] $nomPuertas
 * @property Nomina[] $nOMs
 * @property Area $pRIAREA
 * @property TblDispositivosMarcacion[] $tblDispositivosMarcacions
 */
class Puerta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'PUERTA';
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
            [['PRT_COD', 'PRI_AREA'], 'required'],
            [['PRI_P', 'PRI_VALCLAVE', 'PRI_SEL', 'PRI_OPEN', 'PRI_TIEMPO', 'PRI_VERIFICA', 'PRI_VALIDA', 'PRI_ENVIA_ALERTA', 'PRI_EMPRESA', 'PRI_CAM', 'PRI_CONTROL_MARCA', 'PRI_RA', 'PRI_SERV', 'PRI_ACTIVAGPS', 'PRI_DPTO', 'PRI_ENROLA'], 'integer'],
            [['PRI_AREA', 'PRI_SERVER', 'PRI_LAT', 'PRI_LON', 'PRI_PER'], 'number'],
            [['PRI_FEC', 'PRI_LASTMARCA', 'PRI_NOW'], 'safe'],
            [['PRT_COD', 'PRI_PTO'], 'string', 'max' => 4],
            [['PRI_DES', 'PRI_VIRDI'], 'string', 'max' => 30],
            [['PRI_LOC', 'PRI_ST', 'PRI_CAM_URL', 'PRI_ESTADO_LICENCIA'], 'string', 'max' => 50],
            [['PRI_AREA1', 'PRI_PRINTER', 'PRI_MAC', 'PRI_MAC_KEY', 'PRI_ALTITUD', 'PRI_LONGITUD', 'PRI_DISTANCIA', 'PRI_KEYEQUIPO'], 'string', 'max' => 100],
            [['PRI_IP', 'PRI_CAM_IP'], 'string', 'max' => 16],
            [['PRI_STA', 'PRI_TIPO', 'PRI_LAST_ID'], 'string', 'max' => 10],
            [['PRI_TI', 'PRI_CAM_PASS', 'PRI_CAM_USER'], 'string', 'max' => 20],
            [['PRI_TE'], 'string', 'max' => 5],
            [['PRI_LASTUSER'], 'string', 'max' => 6],
            [['PRI_EVENTO'], 'string', 'max' => 300],
            [['PRI_EMPRESA_NOM'], 'string', 'max' => 200],
            [['PRT_COD'], 'unique'],
            [['PRI_AREA'], 'exist', 'skipOnError' => true, 'targetClass' => Area::className(), 'targetAttribute' => ['PRI_AREA' => 'AREA_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PRT_COD' => 'Prt Cod',
            'PRI_DES' => 'Pri Des',
            'PRI_LOC' => 'Pri Loc',
            'PRI_P' => 'Pri P',
            'PRI_AREA' => 'Pri Area',
            'PRI_AREA1' => 'Pri Area1',
            'PRI_IP' => 'Pri Ip',
            'PRI_FEC' => 'Pri Fec',
            'PRI_STA' => 'Pri Sta',
            'PRI_ST' => 'Pri St',
            'PRI_PTO' => 'Pri Pto',
            'PRI_TIPO' => 'Pri Tipo',
            'PRI_VIRDI' => 'Pri Virdi',
            'PRI_TI' => 'Pri Ti',
            'PRI_TE' => 'Pri Te',
            'PRI_PRINTER' => 'Pri Printer',
            'PRI_VALCLAVE' => 'Pri Valclave',
            'PRI_SEL' => 'Pri Sel',
            'PRI_LASTUSER' => 'Pri Lastuser',
            'PRI_LASTMARCA' => 'Pri Lastmarca',
            'PRI_OPEN' => 'Pri Open',
            'PRI_TIEMPO' => 'Pri Tiempo',
            'PRI_VERIFICA' => 'Pri Verifica',
            'PRI_LAST_ID' => 'Pri Last ID',
            'PRI_NOW' => 'Pri Now',
            'PRI_VALIDA' => 'Pri Valida',
            'PRI_EVENTO' => 'Pri Evento',
            'PRI_ENVIA_ALERTA' => 'Pri Envia Alerta',
            'PRI_EMPRESA' => 'Pri Empresa',
            'PRI_EMPRESA_NOM' => 'Pri Empresa Nom',
            'PRI_SERVER' => 'Pri Server',
            'PRI_CAM' => 'Pri Cam',
            'PRI_CAM_IP' => 'Pri Cam Ip',
            'PRI_CAM_PASS' => 'Pri Cam Pass',
            'PRI_CAM_USER' => 'Pri Cam User',
            'PRI_CAM_URL' => 'Pri Cam Url',
            'PRI_CONTROL_MARCA' => 'Pri Control Marca',
            'PRI_MAC' => 'Pri Mac',
            'PRI_MAC_KEY' => 'Pri Mac Key',
            'PRI_ESTADO_LICENCIA' => 'Pri Estado Licencia',
            'PRI_RA' => 'Pri Ra',
            'PRI_LAT' => 'Pri Lat',
            'PRI_LON' => 'Pri Lon',
            'PRI_PER' => 'Pri Per',
            'PRI_SERV' => 'Pri Serv',
            'PRI_ACTIVAGPS' => 'Pri Activagps',
            'PRI_ALTITUD' => 'Pri Altitud',
            'PRI_LONGITUD' => 'Pri Longitud',
            'PRI_DISTANCIA' => 'Pri Distancia',
            'PRI_KEYEQUIPO' => 'Pri Keyequipo',
            'PRI_DPTO' => 'Pri Dpto',
            'PRI_ENROLA' => 'Pri Enrola',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNomPuertas()
    {
        return $this->hasMany(NomPuerta::className(), ['PUER_ID' => 'PRT_COD']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOMs()
    {
        return $this->hasMany(Nomina::className(), ['NOMINA_ID' => 'NOM_ID'])->viaTable('NOM_PUERTA', ['PUER_ID' => 'PRT_COD']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRIAREA()
    {
        return $this->hasOne(Area::className(), ['AREA_ID' => 'PRI_AREA']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblDispositivosMarcacions()
    {
        return $this->hasMany(TblDispositivosMarcacion::className(), ['DM_PUERTA' => 'PRT_COD']);
    }

    public function getDatosCompletos()
    {
        //$puerta = \app\models\onlycontrol\Puerta::findOne($this->PUER_ID);
        //return $this->PRT_COD.": ".$this->PRI_DES .$puerta->PRI_EMPRESA_NOM .' ('. $puerta->PRI_AREA1 .') '. $this->PRI_STA;
        return $this->PRT_COD.': '.$this->PRI_DES.' ('.$this->PRI_STA.') >> '.$this->PRI_IP;
    }
}
