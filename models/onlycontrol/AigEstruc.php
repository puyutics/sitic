<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "AIG_ESTRUC".
 *
 * @property string $TD_ID
 * @property string $TD_NOM
 * @property string $TD_DES
 * @property int $TD_NCAMPOS
 * @property string $TD_TIPO
 * @property string $TD_RUTA
 * @property string $TD_UCREA
 * @property string $TD_FCREA
 *
 * @property AigCategoria[] $aigCategorias
 * @property AigEstCampos[] $aigEstCampos
 */
class AigEstruc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'AIG_ESTRUC';
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
            [['TD_ID', 'TD_NOM'], 'required'],
            [['TD_NCAMPOS'], 'integer'],
            [['TD_FCREA'], 'safe'],
            [['TD_ID', 'TD_UCREA'], 'string', 'max' => 10],
            [['TD_NOM', 'TD_DES'], 'string', 'max' => 50],
            [['TD_TIPO'], 'string', 'max' => 15],
            [['TD_RUTA'], 'string', 'max' => 100],
            [['TD_NOM'], 'unique'],
            [['TD_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TD_ID' => 'Td ID',
            'TD_NOM' => 'Td Nom',
            'TD_DES' => 'Td Des',
            'TD_NCAMPOS' => 'Td Ncampos',
            'TD_TIPO' => 'Td Tipo',
            'TD_RUTA' => 'Td Ruta',
            'TD_UCREA' => 'Td Ucrea',
            'TD_FCREA' => 'Td Fcrea',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAigCategorias()
    {
        return $this->hasMany(AigCategoria::className(), ['C_ESTRUCTURA' => 'TD_ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAigEstCampos()
    {
        return $this->hasMany(AigEstCampos::className(), ['TC_EST' => 'TD_ID']);
    }
}
