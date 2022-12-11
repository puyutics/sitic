<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_MENUPERSONA".
 *
 * @property string $H_NOMINAID
 * @property string $H_TIPOC
 * @property string $H_MENU
 * @property string $H_FECHAI
 * @property string $H_FECHAF
 *
 * @property Nomina $hNOMINA
 * @property TblMenu $hTIPOC
 */
class TblMenupersona extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_MENUPERSONA';
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
            [['H_NOMINAID', 'H_TIPOC', 'H_MENU'], 'required'],
            [['H_FECHAI', 'H_FECHAF'], 'safe'],
            [['H_NOMINAID'], 'string', 'max' => 6],
            [['H_TIPOC', 'H_MENU'], 'string', 'max' => 20],
            [['H_NOMINAID', 'H_TIPOC'], 'unique', 'targetAttribute' => ['H_NOMINAID', 'H_TIPOC']],
            [['H_MENU', 'H_NOMINAID', 'H_TIPOC'], 'unique', 'targetAttribute' => ['H_MENU', 'H_NOMINAID', 'H_TIPOC']],
            [['H_NOMINAID'], 'exist', 'skipOnError' => true, 'targetClass' => Nomina::className(), 'targetAttribute' => ['H_NOMINAID' => 'NOMINA_ID']],
            [['H_TIPOC', 'H_MENU'], 'exist', 'skipOnError' => true, 'targetClass' => TblMenu::className(), 'targetAttribute' => ['H_TIPOC' => 'M_TIPOC', 'H_MENU' => 'M_MENU']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'H_NOMINAID' => 'H Nominaid',
            'H_TIPOC' => 'H Tipoc',
            'H_MENU' => 'H Menu',
            'H_FECHAI' => 'H Fechai',
            'H_FECHAF' => 'H Fechaf',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHNOMINA()
    {
        return $this->hasOne(Nomina::className(), ['NOMINA_ID' => 'H_NOMINAID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHTIPOC()
    {
        return $this->hasOne(TblMenu::className(), ['M_TIPOC' => 'H_TIPOC', 'M_MENU' => 'H_MENU']);
    }
}
