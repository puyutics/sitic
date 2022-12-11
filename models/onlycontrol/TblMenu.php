<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_MENU".
 *
 * @property string $M_TIPOC
 * @property string $M_MENU
 * @property string $M_DESCRIP
 * @property double $M_COSTO
 * @property string $M_TIPO
 * @property string $M_FECHA
 * @property int $M_TIPOB
 * @property int $M_DIETA
 * @property double $M_REF1
 * @property double $M_REF2
 * @property int $M_TICKET
 *
 * @property TblTipocomida $mTIPOC
 * @property TblMenupersona[] $tblMenupersonas
 * @property Nomina[] $hNOMINAs
 */
class TblMenu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_MENU';
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
            [['M_TIPOC', 'M_MENU'], 'required'],
            [['M_COSTO', 'M_REF1', 'M_REF2'], 'number'],
            [['M_FECHA'], 'safe'],
            [['M_TIPOB', 'M_DIETA', 'M_TICKET'], 'integer'],
            [['M_TIPOC', 'M_MENU', 'M_TIPO'], 'string', 'max' => 20],
            [['M_DESCRIP'], 'string', 'max' => 100],
            [['M_MENU', 'M_TIPOC'], 'unique', 'targetAttribute' => ['M_MENU', 'M_TIPOC']],
            [['M_TIPOC'], 'exist', 'skipOnError' => true, 'targetClass' => TblTipocomida::className(), 'targetAttribute' => ['M_TIPOC' => 'TC_TIPOC']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'M_TIPOC' => 'M Tipoc',
            'M_MENU' => 'M Menu',
            'M_DESCRIP' => 'M Descrip',
            'M_COSTO' => 'M Costo',
            'M_TIPO' => 'M Tipo',
            'M_FECHA' => 'M Fecha',
            'M_TIPOB' => 'M Tipob',
            'M_DIETA' => 'M Dieta',
            'M_REF1' => 'M Ref1',
            'M_REF2' => 'M Ref2',
            'M_TICKET' => 'M Ticket',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMTIPOC()
    {
        return $this->hasOne(TblTipocomida::className(), ['TC_TIPOC' => 'M_TIPOC']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblMenupersonas()
    {
        return $this->hasMany(TblMenupersona::className(), ['H_TIPOC' => 'M_TIPOC', 'H_MENU' => 'M_MENU']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHNOMINAs()
    {
        return $this->hasMany(Nomina::className(), ['NOMINA_ID' => 'H_NOMINAID'])->viaTable('TBL_MENUPERSONA', ['H_TIPOC' => 'M_TIPOC', 'H_MENU' => 'M_MENU']);
    }
}
