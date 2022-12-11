<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AIG_CAT_ARBOL".
 *
 * @property string $IM_CEDULA
 * @property string $IM_CATEG1
 * @property string $IM_CATEG2
 * @property string $IM_CATEG3
 * @property int $IM_POS
 * @property string $IM_UCREA
 * @property string $IM_FCREA
 * @property string $IM_ESTADO
 */
class AigCatArbol extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AIG_CAT_ARBOL';
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
            [['IM_CEDULA', 'IM_CATEG1', 'IM_CATEG2', 'IM_CATEG3'], 'required'],
            [['IM_POS'], 'integer'],
            [['IM_FCREA'], 'safe'],
            [['IM_CEDULA'], 'string', 'max' => 20],
            [['IM_CATEG1', 'IM_CATEG2', 'IM_CATEG3'], 'string', 'max' => 35],
            [['IM_UCREA'], 'string', 'max' => 10],
            [['IM_ESTADO'], 'string', 'max' => 1],
            [['IM_CATEG1', 'IM_CATEG2', 'IM_CATEG3', 'IM_CEDULA'], 'unique', 'targetAttribute' => ['IM_CATEG1', 'IM_CATEG2', 'IM_CATEG3', 'IM_CEDULA']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'IM_CEDULA' => 'Im Cedula',
            'IM_CATEG1' => 'Im Categ1',
            'IM_CATEG2' => 'Im Categ2',
            'IM_CATEG3' => 'Im Categ3',
            'IM_POS' => 'Im Pos',
            'IM_UCREA' => 'Im Ucrea',
            'IM_FCREA' => 'Im Fcrea',
            'IM_ESTADO' => 'Im Estado',
        ];
    }
}
