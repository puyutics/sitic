<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_ZonaEquipo".
 *
 * @property string $AREA_ZM_ID
 * @property string $ZM_ID
 * @property string $PRT_COD
 * @property string $PRI_DES
 * @property string $PRT_SEL
 */
class TblZonaequipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_ZonaEquipo';
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
            [['ZM_ID', 'PRT_COD'], 'required'],
            [['ZM_ID', 'PRT_SEL'], 'number'],
            [['PRT_COD'], 'string', 'max' => 4],
            [['PRI_DES'], 'string', 'max' => 50],
            [['PRT_COD', 'ZM_ID'], 'unique', 'targetAttribute' => ['PRT_COD', 'ZM_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AREA_ZM_ID' => 'Area Zm ID',
            'ZM_ID' => 'Zm ID',
            'PRT_COD' => 'Prt Cod',
            'PRI_DES' => 'Pri Des',
            'PRT_SEL' => 'Prt Sel',
        ];
    }
}
