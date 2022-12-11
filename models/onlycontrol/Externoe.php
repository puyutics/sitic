<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "EXTERNOE".
 *
 * @property string $EMPE_ID
 * @property string $EMPE_NOM
 * @property string $EMPE_DIR
 * @property string $EMPE_RUC
 * @property string $EMPE_REP
 * @property string $EMPE_TELF
 * @property string $EMPE_FAX
 * @property string $EMPE_WEB
 * @property string $EMPE_CONT
 * @property string $EMPE_OBS
 * @property string $EMPE_CODE
 *
 * @property AcNomina[] $acNominas
 * @property AcVehiculos[] $acVehiculos
 * @property Nomina[] $nominas
 */
class Externoe extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'EXTERNOE';
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
            [['EMPE_NOM'], 'required'],
            [['EMPE_NOM', 'EMPE_REP', 'EMPE_WEB', 'EMPE_OBS'], 'string', 'max' => 50],
            [['EMPE_DIR'], 'string', 'max' => 70],
            [['EMPE_RUC'], 'string', 'max' => 15],
            [['EMPE_TELF', 'EMPE_FAX'], 'string', 'max' => 20],
            [['EMPE_CONT'], 'string', 'max' => 30],
            [['EMPE_CODE'], 'string', 'max' => 10],
            [['EMPE_NOM'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'EMPE_ID' => 'Empe ID',
            'EMPE_NOM' => 'Empe Nom',
            'EMPE_DIR' => 'Empe Dir',
            'EMPE_RUC' => 'Empe Ruc',
            'EMPE_REP' => 'Empe Rep',
            'EMPE_TELF' => 'Empe Telf',
            'EMPE_FAX' => 'Empe Fax',
            'EMPE_WEB' => 'Empe Web',
            'EMPE_CONT' => 'Empe Cont',
            'EMPE_OBS' => 'Empe Obs',
            'EMPE_CODE' => 'Empe Code',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcNominas()
    {
        return $this->hasMany(AcNomina::className(), ['NOMINA_EMP' => 'EMPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcVehiculos()
    {
        return $this->hasMany(AcVehiculos::className(), ['VE_EMPRESA' => 'EMPE_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNominas()
    {
        return $this->hasMany(Nomina::className(), ['NOMINA_EMP' => 'EMPE_ID']);
    }
}
