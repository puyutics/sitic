<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_MAESTRO_CVP".
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
 * @property string $PP_PLACA
 * @property string $PP_TIPOV
 * @property string $PP_COLOR
 * @property string $PP_MARCA
 * @property string $PP_MODELO
 * @property string $PP_FINICIO
 * @property string $PP_FFINAL
 * @property string $PP_FCREA
 * @property string $PP_UCREA
 * @property string $PP_OBS1
 * @property string $PP_OBS2
 * @property int $PP_FLAGN
 * @property string $PP_BLOQUEO
 * @property string $PP_UAUTO
 * @property string $PP_TARJETA
 */
class AcMaestroCvp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_MAESTRO_CVP';
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
            [['PP_FLAGN'], 'integer'],
            [['PP_ID_SOL'], 'string', 'max' => 6],
            [['PP_CED_SOL', 'PP_NOM_SOL', 'PP_EMP_NOM', 'PP_AREA_NOM', 'PP_ACT_NOM', 'PP_OBS1', 'PP_OBS2'], 'string', 'max' => 100],
            [['PP_PLACA', 'PP_UCREA', 'PP_UAUTO'], 'string', 'max' => 10],
            [['PP_TIPOV', 'PP_COLOR', 'PP_MARCA', 'PP_MODELO', 'PP_TARJETA'], 'string', 'max' => 25],
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
            'PP_PLACA' => 'Pp Placa',
            'PP_TIPOV' => 'Pp Tipov',
            'PP_COLOR' => 'Pp Color',
            'PP_MARCA' => 'Pp Marca',
            'PP_MODELO' => 'Pp Modelo',
            'PP_FINICIO' => 'Pp Finicio',
            'PP_FFINAL' => 'Pp Ffinal',
            'PP_FCREA' => 'Pp Fcrea',
            'PP_UCREA' => 'Pp Ucrea',
            'PP_OBS1' => 'Pp Obs1',
            'PP_OBS2' => 'Pp Obs2',
            'PP_FLAGN' => 'Pp Flagn',
            'PP_BLOQUEO' => 'Pp Bloqueo',
            'PP_UAUTO' => 'Pp Uauto',
            'PP_TARJETA' => 'Pp Tarjeta',
        ];
    }
}
