<?php

namespace app\models\parkingcontrol;

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
 * @property string $PRI_TTRAN
 * @property string $PRI_UTRAN
 * @property int $PRI_OPEN
 * @property string $PRI_OPENTIME
 * @property string $PRI_LASTUSER
 * @property string $PRI_LASTMARCA
 * @property int $PRI_TIEMPO
 * @property int $PRI_VERIFICA
 * @property string $PRI_LAST_ID
 * @property string $PRI_NOW
 * @property int $PRI_VALIDA
 * @property string $PRI_EVENTO
 * @property int $PRI_ENVIA_ALERTA
 * @property int $PRI_EMPRESA
 * @property string $PRI_EMPRESA_NOM
 * @property int $PRI_SEL
 * @property int $PRI_CAM
 * @property string $PRI_CAM_IP
 * @property string $PRI_CAM_PASS
 * @property string $PRI_CAM_USER
 * @property string $PRI_PARQUEO
 * @property int $PRI_ENTRY
 * @property string $PRI_IDSTATION
 * @property string $PRI_LASTRFID
 * @property string $PRI_ULTIMALECTURA
 *
 * @property NOMPUERTA[] $nOMPUERTAs
 * @property NOMINA[] $nOMs
 * @property AREA $pRIAREA
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
        return Yii::$app->get('db_parkingcontrol');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['PRT_COD', 'PRI_AREA'], 'required'],
            [['PRI_P', 'PRI_VALCLAVE', 'PRI_OPEN', 'PRI_TIEMPO', 'PRI_VERIFICA', 'PRI_VALIDA', 'PRI_ENVIA_ALERTA', 'PRI_EMPRESA', 'PRI_SEL', 'PRI_CAM', 'PRI_ENTRY'], 'integer'],
            [['PRI_AREA', 'PRI_TTRAN'], 'number'],
            [['PRI_FEC', 'PRI_UTRAN', 'PRI_OPENTIME', 'PRI_LASTMARCA', 'PRI_NOW', 'PRI_ULTIMALECTURA'], 'safe'],
            [['PRT_COD', 'PRI_PTO'], 'string', 'max' => 4],
            [['PRI_DES', 'PRI_VIRDI'], 'string', 'max' => 30],
            [['PRI_LOC', 'PRI_ST'], 'string', 'max' => 50],
            [['PRI_AREA1', 'PRI_PRINTER'], 'string', 'max' => 100],
            [['PRI_IP', 'PRI_CAM_IP', 'PRI_PARQUEO'], 'string', 'max' => 16],
            [['PRI_STA', 'PRI_TIPO', 'PRI_LAST_ID'], 'string', 'max' => 10],
            [['PRI_TI', 'PRI_CAM_PASS', 'PRI_CAM_USER'], 'string', 'max' => 20],
            [['PRI_TE', 'PRI_IDSTATION'], 'string', 'max' => 5],
            [['PRI_LASTUSER'], 'string', 'max' => 6],
            [['PRI_EVENTO'], 'string', 'max' => 300],
            [['PRI_EMPRESA_NOM'], 'string', 'max' => 200],
            [['PRI_LASTRFID'], 'string', 'max' => 24],
            [['PRT_COD'], 'unique'],
            [['PRI_AREA'], 'exist', 'skipOnError' => true, 'targetClass' => AREA::className(), 'targetAttribute' => ['PRI_AREA' => 'AREA_ID']],
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
            'PRI_TTRAN' => 'Pri Ttran',
            'PRI_UTRAN' => 'Pri Utran',
            'PRI_OPEN' => 'Pri Open',
            'PRI_OPENTIME' => 'Pri Opentime',
            'PRI_LASTUSER' => 'Pri Lastuser',
            'PRI_LASTMARCA' => 'Pri Lastmarca',
            'PRI_TIEMPO' => 'Pri Tiempo',
            'PRI_VERIFICA' => 'Pri Verifica',
            'PRI_LAST_ID' => 'Pri Last ID',
            'PRI_NOW' => 'Pri Now',
            'PRI_VALIDA' => 'Pri Valida',
            'PRI_EVENTO' => 'Pri Evento',
            'PRI_ENVIA_ALERTA' => 'Pri Envia Alerta',
            'PRI_EMPRESA' => 'Pri Empresa',
            'PRI_EMPRESA_NOM' => 'Pri Empresa Nom',
            'PRI_SEL' => 'Pri Sel',
            'PRI_CAM' => 'Pri Cam',
            'PRI_CAM_IP' => 'Pri Cam Ip',
            'PRI_CAM_PASS' => 'Pri Cam Pass',
            'PRI_CAM_USER' => 'Pri Cam User',
            'PRI_PARQUEO' => 'Pri Parqueo',
            'PRI_ENTRY' => 'Pri Entry',
            'PRI_IDSTATION' => 'Pri Idstation',
            'PRI_LASTRFID' => 'Pri Lastrfid',
            'PRI_ULTIMALECTURA' => 'Pri Ultimalectura',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOMPUERTAs()
    {
        return $this->hasMany(NOMPUERTA::className(), ['PUER_ID' => 'PRT_COD']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOMs()
    {
        return $this->hasMany(NOMINA::className(), ['NOMINA_ID' => 'NOM_ID'])->viaTable('NOM_PUERTA', ['PUER_ID' => 'PRT_COD']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPRIAREA()
    {
        return $this->hasOne(AREA::className(), ['AREA_ID' => 'PRI_AREA']);
    }
}
