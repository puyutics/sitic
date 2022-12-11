<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_EQUIPOS_TRANSF".
 *
 * @property string $EQUIPO
 *
 * @property TBLEQUIPOSTRANSF $eQUIPO
 * @property TBLEQUIPOSTRANSF $tBLEQUIPOSTRANSF
 */
class TblEquiposTransf extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_EQUIPOS_TRANSF';
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
            [['EQUIPO'], 'required'],
            [['EQUIPO'], 'string', 'max' => 10],
            [['EQUIPO'], 'unique'],
            [['EQUIPO'], 'exist', 'skipOnError' => true, 'targetClass' => TBLEQUIPOSTRANSF::className(), 'targetAttribute' => ['EQUIPO' => 'EQUIPO']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'EQUIPO' => 'Equipo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEQUIPO()
    {
        return $this->hasOne(TBLEQUIPOSTRANSF::className(), ['EQUIPO' => 'EQUIPO']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTBLEQUIPOSTRANSF()
    {
        return $this->hasOne(TBLEQUIPOSTRANSF::className(), ['EQUIPO' => 'EQUIPO']);
    }
}
