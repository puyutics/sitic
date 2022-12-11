<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AIG_CATEGORIA".
 *
 * @property string $C_ID
 * @property string $C_DES
 * @property string $C_NIVEL
 * @property string $C_UCREA
 * @property string $C_FCREA
 * @property string $C_ESTRUCTURA
 * @property string $C_ESTADO
 *
 * @property AigEstruc $cESTRUCTURA
 */
class AigCategoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AIG_CATEGORIA';
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
            [['C_ID'], 'required'],
            [['C_FCREA'], 'safe'],
            [['C_ID'], 'string', 'max' => 35],
            [['C_DES'], 'string', 'max' => 50],
            [['C_NIVEL', 'C_ESTADO'], 'string', 'max' => 1],
            [['C_UCREA', 'C_ESTRUCTURA'], 'string', 'max' => 10],
            [['C_ID'], 'unique'],
            [['C_ESTRUCTURA'], 'exist', 'skipOnError' => true, 'targetClass' => AigEstruc::className(), 'targetAttribute' => ['C_ESTRUCTURA' => 'TD_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'C_ID' => 'C ID',
            'C_DES' => 'C Des',
            'C_NIVEL' => 'C Nivel',
            'C_UCREA' => 'C Ucrea',
            'C_FCREA' => 'C Fcrea',
            'C_ESTRUCTURA' => 'C Estructura',
            'C_ESTADO' => 'C Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCESTRUCTURA()
    {
        return $this->hasOne(AigEstruc::className(), ['TD_ID' => 'C_ESTRUCTURA']);
    }
}
