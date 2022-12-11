<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_CREDENCIAL".
 *
 * @property string $ATRIBUTO
 * @property int $X
 * @property int $Y
 * @property int $COLORLETRA
 * @property string $TIPOLETRA
 * @property string $VISIBLE
 * @property string $N
 * @property string $K
 * @property string $S
 * @property string $EMPRESA
 * @property string $TAMANO
 */
class TblCredencial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_CREDENCIAL';
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
            [['ATRIBUTO', 'EMPRESA'], 'required'],
            [['X', 'Y', 'COLORLETRA'], 'integer'],
            [['ATRIBUTO', 'TIPOLETRA', 'EMPRESA'], 'string', 'max' => 50],
            [['VISIBLE', 'N', 'K', 'S'], 'string', 'max' => 1],
            [['TAMANO'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ATRIBUTO' => 'Atributo',
            'X' => 'X',
            'Y' => 'Y',
            'COLORLETRA' => 'Colorletra',
            'TIPOLETRA' => 'Tipoletra',
            'VISIBLE' => 'Visible',
            'N' => 'N',
            'K' => 'K',
            'S' => 'S',
            'EMPRESA' => 'Empresa',
            'TAMANO' => 'Tamano',
        ];
    }
}
