<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AC_DETALLE_CPP".
 *
 * @property string $PPD_ID_M
 * @property string $PPD_CED
 * @property string $PPD_ID
 * @property string $PPD_NOM
 * @property string $PPD_OBS1
 * @property string $PPD_OBS2
 * @property string $PPD_FCREA
 * @property string $PPD_UCREA
 * @property int $PPD_FLAGN
 * @property string $PPD_BLOQUEO
 * @property string $PPD_FINGER
 *
 * @property AcMaestroCpp $pPDIDM
 */
class AcDetalleCpp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AC_DETALLE_CPP';
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
            [['PPD_ID_M', 'PPD_CED'], 'required'],
            [['PPD_ID_M'], 'number'],
            [['PPD_FCREA'], 'safe'],
            [['PPD_FLAGN'], 'integer'],
            [['PPD_CED'], 'string', 'max' => 12],
            [['PPD_ID'], 'string', 'max' => 6],
            [['PPD_NOM', 'PPD_OBS1', 'PPD_OBS2'], 'string', 'max' => 100],
            [['PPD_UCREA'], 'string', 'max' => 10],
            [['PPD_BLOQUEO'], 'string', 'max' => 1],
            [['PPD_FINGER'], 'string', 'max' => 3],
            [['PPD_CED', 'PPD_ID_M'], 'unique', 'targetAttribute' => ['PPD_CED', 'PPD_ID_M']],
            [['PPD_ID_M'], 'exist', 'skipOnError' => true, 'targetClass' => AcMaestroCpp::className(), 'targetAttribute' => ['PPD_ID_M' => 'PP_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PPD_ID_M' => 'Ppd Id M',
            'PPD_CED' => 'Ppd Ced',
            'PPD_ID' => 'Ppd ID',
            'PPD_NOM' => 'Ppd Nom',
            'PPD_OBS1' => 'Ppd Obs1',
            'PPD_OBS2' => 'Ppd Obs2',
            'PPD_FCREA' => 'Ppd Fcrea',
            'PPD_UCREA' => 'Ppd Ucrea',
            'PPD_FLAGN' => 'Ppd Flagn',
            'PPD_BLOQUEO' => 'Ppd Bloqueo',
            'PPD_FINGER' => 'Ppd Finger',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPPDIDM()
    {
        return $this->hasOne(AcMaestroCpp::className(), ['PP_ID' => 'PPD_ID_M']);
    }
}
