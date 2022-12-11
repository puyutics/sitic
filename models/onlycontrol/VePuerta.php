<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "VE_PUERTA".
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
 */
class VePuerta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'VE_PUERTA';
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
            [['PRI_P'], 'integer'],
            [['PRI_AREA'], 'number'],
            [['PRI_FEC'], 'safe'],
            [['PRT_COD', 'PRI_PTO'], 'string', 'max' => 4],
            [['PRI_DES', 'PRI_VIRDI'], 'string', 'max' => 30],
            [['PRI_LOC', 'PRI_ST'], 'string', 'max' => 50],
            [['PRI_AREA1'], 'string', 'max' => 100],
            [['PRI_IP'], 'string', 'max' => 16],
            [['PRI_STA', 'PRI_TIPO'], 'string', 'max' => 10],
            [['PRI_TI'], 'string', 'max' => 20],
            [['PRI_TE'], 'string', 'max' => 5],
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
        ];
    }
}
