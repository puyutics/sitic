<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "R_VISITAS".
 *
 * @property int $V_ID
 * @property string $V_COD_AUTO
 * @property string $V_VISITANTE
 * @property string $V_VISITADO
 * @property string $V_FECHAING
 * @property string $V_FECHASAL
 * @property int $V_NUMPER
 * @property string $V_PUERTA
 * @property string $V_AREA
 * @property string $V_PLACA
 * @property string $V_TARJETA
 * @property string $V_HVERIFICADA
 * @property string $V_FTOMADA
 * @property string $V_NOVING
 * @property string $V_NOVSAL
 * @property int $V_FINALIZADO
 * @property string $V_UCREA
 * @property string $V_HVERIFICADASAL
 * @property int $V_TIEMPOEST
 * @property int $V_TIEMPOREAL
 * @property string $NOM_VISITANTE
 * @property string $APE_VISITANTE
 * @property string $NOM_VISITADO
 * @property string $APE_VISITADO
 * @property string $APE_UCREA
 * @property string $P_EMPRESA
 * @property string $P_TIPO
 * @property string $V_TIPOVE
 * @property string $V_MARCAVE
 * @property string $V_MODEVE
 * @property int $V_CASCO
 * @property int $V_CHALECO
 * @property string $V_PUERTASAL
 * @property string $V_ART
 * @property string $V_FART
 * @property int $VI_LAPTOP
 * @property string $VI_LAPTOPMM
 * @property string $VI_LAPTOPSE
 * @property int $VI_CELULAR
 * @property string $VI_CELULARMM
 * @property string $VI_CELULARSE
 * @property string $V_CEDPLANIFICA
 * @property string $V_HORAPLANIFICA
 */
class RVisitas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'R_VISITAS';
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
            [['V_VISITANTE', 'V_VISITADO', 'V_FECHAING'], 'required'],
            [['V_FECHAING', 'V_FECHASAL', 'V_FART', 'V_HORAPLANIFICA'], 'safe'],
            [['V_NUMPER', 'V_FINALIZADO', 'V_TIEMPOEST', 'V_TIEMPOREAL', 'V_CASCO', 'V_CHALECO', 'VI_LAPTOP', 'VI_CELULAR'], 'integer'],
            [['V_COD_AUTO', 'V_VISITANTE', 'V_VISITADO', 'V_UCREA'], 'string', 'max' => 20],
            [['V_PUERTA', 'V_TARJETA', 'V_PUERTASAL'], 'string', 'max' => 30],
            [['V_AREA', 'NOM_VISITANTE', 'APE_VISITANTE', 'NOM_VISITADO', 'APE_VISITADO', 'APE_UCREA'], 'string', 'max' => 100],
            [['V_PLACA'], 'string', 'max' => 10],
            [['V_HVERIFICADA', 'V_FTOMADA', 'V_HVERIFICADASAL'], 'string', 'max' => 2],
            [['V_NOVING', 'V_NOVSAL'], 'string', 'max' => 500],
            [['P_EMPRESA', 'V_TIPOVE', 'V_MARCAVE', 'V_MODEVE', 'V_ART', 'VI_LAPTOPMM', 'VI_LAPTOPSE', 'VI_CELULARMM', 'VI_CELULARSE'], 'string', 'max' => 50],
            [['P_TIPO'], 'string', 'max' => 25],
            [['V_CEDPLANIFICA'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'V_ID' => 'V ID',
            'V_COD_AUTO' => 'V Cod Auto',
            'V_VISITANTE' => 'V Visitante',
            'V_VISITADO' => 'V Visitado',
            'V_FECHAING' => 'V Fechaing',
            'V_FECHASAL' => 'V Fechasal',
            'V_NUMPER' => 'V Numper',
            'V_PUERTA' => 'V Puerta',
            'V_AREA' => 'V Area',
            'V_PLACA' => 'V Placa',
            'V_TARJETA' => 'V Tarjeta',
            'V_HVERIFICADA' => 'V Hverificada',
            'V_FTOMADA' => 'V Ftomada',
            'V_NOVING' => 'V Noving',
            'V_NOVSAL' => 'V Novsal',
            'V_FINALIZADO' => 'V Finalizado',
            'V_UCREA' => 'V Ucrea',
            'V_HVERIFICADASAL' => 'V Hverificadasal',
            'V_TIEMPOEST' => 'V Tiempoest',
            'V_TIEMPOREAL' => 'V Tiemporeal',
            'NOM_VISITANTE' => 'Nom Visitante',
            'APE_VISITANTE' => 'Ape Visitante',
            'NOM_VISITADO' => 'Nom Visitado',
            'APE_VISITADO' => 'Ape Visitado',
            'APE_UCREA' => 'Ape Ucrea',
            'P_EMPRESA' => 'P Empresa',
            'P_TIPO' => 'P Tipo',
            'V_TIPOVE' => 'V Tipove',
            'V_MARCAVE' => 'V Marcave',
            'V_MODEVE' => 'V Modeve',
            'V_CASCO' => 'V Casco',
            'V_CHALECO' => 'V Chaleco',
            'V_PUERTASAL' => 'V Puertasal',
            'V_ART' => 'V Art',
            'V_FART' => 'V Fart',
            'VI_LAPTOP' => 'Vi Laptop',
            'VI_LAPTOPMM' => 'Vi Laptopmm',
            'VI_LAPTOPSE' => 'Vi Laptopse',
            'VI_CELULAR' => 'Vi Celular',
            'VI_CELULARMM' => 'Vi Celularmm',
            'VI_CELULARSE' => 'Vi Celularse',
            'V_CEDPLANIFICA' => 'V Cedplanifica',
            'V_HORAPLANIFICA' => 'V Horaplanifica',
        ];
    }
}
