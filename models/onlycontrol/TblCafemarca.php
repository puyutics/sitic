<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_CAFEMARCA".
 *
 * @property string $C_NOMINA
 * @property string $C_TIEMPO
 * @property string $C_TIPOUSER
 * @property string $C_TIPO
 * @property string $C_MENU
 * @property int $C_NUM
 * @property string $C_COSTO
 * @property string $C_TOTAL
 * @property int $C_TRANS
 * @property string $C_STATUS
 * @property string $C_IP
 * @property string $C_AREA1
 * @property int $C_CONT
 * @property int $C_PLANIFICADO
 * @property string $C_REF1
 * @property string $C_REF2
 * @property string $C_TOTALR1
 * @property string $C_TOTALR2
 * @property string $NOMINA_APE
 * @property string $NOMINA_NOM
 * @property string $C_EMP1
 * @property string $C_DEP1
 * @property string $NOMINA_COD
 */
class TblCafemarca extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_CAFEMARCA';
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
            [['C_NOMINA', 'C_TIEMPO', 'C_TIPOUSER', 'C_TIPO', 'C_MENU', 'C_NUM', 'C_COSTO', 'C_TOTAL', 'C_TRANS', 'C_STATUS', 'C_IP', 'C_AREA1', 'C_CONT'], 'required'],
            [['C_TIEMPO'], 'safe'],
            [['C_NUM', 'C_TRANS', 'C_CONT', 'C_PLANIFICADO'], 'integer'],
            [['C_COSTO', 'C_TOTAL', 'C_REF1', 'C_REF2', 'C_TOTALR1', 'C_TOTALR2'], 'number'],
            [['C_NOMINA'], 'string', 'max' => 10],
            [['C_TIPOUSER', 'C_TIPO', 'C_MENU', 'C_STATUS'], 'string', 'max' => 20],
            [['C_IP'], 'string', 'max' => 30],
            [['C_AREA1', 'C_EMP1', 'C_DEP1', 'NOMINA_COD'], 'string', 'max' => 50],
            [['NOMINA_APE', 'NOMINA_NOM'], 'string', 'max' => 100],
            [['C_NOMINA', 'C_TIEMPO'], 'unique', 'targetAttribute' => ['C_NOMINA', 'C_TIEMPO']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'C_NOMINA' => 'C Nomina',
            'C_TIEMPO' => 'C Tiempo',
            'C_TIPOUSER' => 'C Tipouser',
            'C_TIPO' => 'C Tipo',
            'C_MENU' => 'C Menu',
            'C_NUM' => 'C Num',
            'C_COSTO' => 'C Costo',
            'C_TOTAL' => 'C Total',
            'C_TRANS' => 'C Trans',
            'C_STATUS' => 'C Status',
            'C_IP' => 'C Ip',
            'C_AREA1' => 'C Area1',
            'C_CONT' => 'C Cont',
            'C_PLANIFICADO' => 'C Planificado',
            'C_REF1' => 'C Ref1',
            'C_REF2' => 'C Ref2',
            'C_TOTALR1' => 'C Totalr1',
            'C_TOTALR2' => 'C Totalr2',
            'NOMINA_APE' => 'Nomina Ape',
            'NOMINA_NOM' => 'Nomina Nom',
            'C_EMP1' => 'C Emp1',
            'C_DEP1' => 'C Dep1',
            'NOMINA_COD' => 'Nomina Cod',
        ];
    }
}
