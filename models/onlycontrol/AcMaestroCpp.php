<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_MAESTRO_CPP".
 *
 * @property string $PP_ID
 * @property string $PP_ID_SOL
 * @property string $PP_CED_SOL
 * @property string $PP_NOM_SOL
 * @property string $PP_EMP_ID
 * @property string $PP_EMP_NOM
 * @property string $PP_AREA_ID
 * @property string $PP_AREA_NOM
 * @property string $PP_ACT_ID
 * @property string $PP_ACT_NOM
 * @property string $PP_FINICIO
 * @property string $PP_FFINAL
 * @property string $PP_FCREA
 * @property string $PP_UCREA
 * @property string $PP_BLOQUEO
 * @property string $PP_UAUTO
 *
 * @property AcDetalleCpp[] $acDetalleCpps
 */
class AcMaestroCpp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_MAESTRO_CPP';
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
            [['PP_EMP_ID', 'PP_AREA_ID', 'PP_ACT_ID'], 'number'],
            [['PP_FINICIO', 'PP_FFINAL', 'PP_FCREA'], 'safe'],
            [['PP_ID_SOL'], 'string', 'max' => 6],
            [['PP_CED_SOL'], 'string', 'max' => 12],
            [['PP_NOM_SOL', 'PP_EMP_NOM', 'PP_AREA_NOM', 'PP_ACT_NOM'], 'string', 'max' => 100],
            [['PP_UCREA', 'PP_UAUTO'], 'string', 'max' => 10],
            [['PP_BLOQUEO'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PP_ID' => 'Pp ID',
            'PP_ID_SOL' => 'Pp Id Sol',
            'PP_CED_SOL' => 'Pp Ced Sol',
            'PP_NOM_SOL' => 'Pp Nom Sol',
            'PP_EMP_ID' => 'Pp Emp ID',
            'PP_EMP_NOM' => 'Pp Emp Nom',
            'PP_AREA_ID' => 'Pp Area ID',
            'PP_AREA_NOM' => 'Pp Area Nom',
            'PP_ACT_ID' => 'Pp Act ID',
            'PP_ACT_NOM' => 'Pp Act Nom',
            'PP_FINICIO' => 'Pp Finicio',
            'PP_FFINAL' => 'Pp Ffinal',
            'PP_FCREA' => 'Pp Fcrea',
            'PP_UCREA' => 'Pp Ucrea',
            'PP_BLOQUEO' => 'Pp Bloqueo',
            'PP_UAUTO' => 'Pp Uauto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcDetalleCpps()
    {
        return $this->hasMany(AcDetalleCpp::className(), ['PPD_ID_M' => 'PP_ID']);
    }
}
