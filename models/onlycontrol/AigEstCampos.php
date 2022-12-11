<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AIG_EST_CAMPOS".
 *
 * @property string $TC_EST
 * @property int $TC_NUM
 * @property string $TC_TIPO
 * @property string $TC_NOM
 * @property int $TC_LEN
 * @property string $TC_UCREA
 * @property string $TC_FCREA
 *
 * @property AigEstruc $tCEST
 */
class AigEstCampos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AIG_EST_CAMPOS';
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
            [['TC_EST', 'TC_NOM'], 'required'],
            [['TC_NUM', 'TC_LEN'], 'integer'],
            [['TC_FCREA'], 'safe'],
            [['TC_EST', 'TC_TIPO', 'TC_UCREA'], 'string', 'max' => 10],
            [['TC_NOM'], 'string', 'max' => 50],
            [['TC_EST', 'TC_NUM'], 'unique', 'targetAttribute' => ['TC_EST', 'TC_NUM']],
            [['TC_EST'], 'exist', 'skipOnError' => true, 'targetClass' => AigEstruc::className(), 'targetAttribute' => ['TC_EST' => 'TD_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TC_EST' => 'Tc Est',
            'TC_NUM' => 'Tc Num',
            'TC_TIPO' => 'Tc Tipo',
            'TC_NOM' => 'Tc Nom',
            'TC_LEN' => 'Tc Len',
            'TC_UCREA' => 'Tc Ucrea',
            'TC_FCREA' => 'Tc Fcrea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTCEST()
    {
        return $this->hasOne(AigEstruc::className(), ['TD_ID' => 'TC_EST']);
    }
}
