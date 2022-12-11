<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_TIPOCOMIDA".
 *
 * @property string $TC_TIPOC
 * @property string $TC_HORAI
 * @property string $TC_HORAF
 *
 * @property TblMenu[] $tblMenus
 */
class TblTipocomida extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_TIPOCOMIDA';
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
            [['TC_TIPOC', 'TC_HORAI', 'TC_HORAF'], 'required'],
            [['TC_HORAI', 'TC_HORAF'], 'safe'],
            [['TC_TIPOC'], 'string', 'max' => 20],
            [['TC_TIPOC'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TC_TIPOC' => 'Tc Tipoc',
            'TC_HORAI' => 'Tc Horai',
            'TC_HORAF' => 'Tc Horaf',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMenus()
    {
        return $this->hasMany(TblMenu::className(), ['M_TIPOC' => 'TC_TIPOC']);
    }
}
