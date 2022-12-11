<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AIG_MEDIA".
 *
 * @property string $IM_CEDULA
 * @property string $IM_CATEG1
 * @property string $IM_CATEG2
 * @property string $IM_CATEG3
 * @property string $IM_KEY
 * @property string $IM_IDX1
 * @property string $IM_IDX2
 * @property string $IM_IDX3
 * @property string $IM_IDX4
 * @property string $IM_IDX5
 * @property string $IM_LEN
 * @property string $IM_TIPO
 * @property string $IM_UCREA
 * @property string $IM_FCREA
 * @property string $IM_UMOD
 * @property string $IM_FMOD
 * @property resource $IM_MEDIA
 */
class AigMedia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AIG_MEDIA';
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
            [['IM_CATEG1', 'IM_CATEG2', 'IM_CATEG3'], 'required'],
            [['IM_LEN'], 'number'],
            [['IM_FCREA', 'IM_FMOD'], 'safe'],
            [['IM_MEDIA'], 'string'],
            [['IM_CEDULA'], 'string', 'max' => 20],
            [['IM_CATEG1', 'IM_CATEG2', 'IM_CATEG3'], 'string', 'max' => 35],
            [['IM_IDX1', 'IM_IDX2', 'IM_IDX3', 'IM_IDX4', 'IM_IDX5'], 'string', 'max' => 100],
            [['IM_TIPO'], 'string', 'max' => 4],
            [['IM_UCREA', 'IM_UMOD'], 'string', 'max' => 10],
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
            'IM_KEY' => 'Im Key',
            'IM_IDX1' => 'Im Idx1',
            'IM_IDX2' => 'Im Idx2',
            'IM_IDX3' => 'Im Idx3',
            'IM_IDX4' => 'Im Idx4',
            'IM_IDX5' => 'Im Idx5',
            'IM_LEN' => 'Im Len',
            'IM_TIPO' => 'Im Tipo',
            'IM_UCREA' => 'Im Ucrea',
            'IM_FCREA' => 'Im Fcrea',
            'IM_UMOD' => 'Im Umod',
            'IM_FMOD' => 'Im Fmod',
            'IM_MEDIA' => 'Im Media',
        ];
    }
}
