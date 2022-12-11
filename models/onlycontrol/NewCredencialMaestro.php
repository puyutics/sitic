<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "NEW_CREDENCIAL_MAESTRO".
 *
 * @property string $CR_ID
 * @property string $CR_DES
 * @property resource $CR_IMG
 * @property int $CR_FIRMA
 * @property int $CR_FOTO
 * @property int $CR_TIPO
 * @property int $CR_FOTOF
 * @property int $CR_CBARRA
 * @property string $CR_UCREA
 * @property string $CR_FCREA
 * @property string $CR_UserRI
 * @property string $CR_ClaveRI
 * @property resource $CR_IMGATRAS
 */
class NewCredencialMaestro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NEW_CREDENCIAL_MAESTRO';
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
            [['CR_ID', 'CR_DES'], 'required'],
            [['CR_IMG', 'CR_IMGATRAS'], 'string'],
            [['CR_FIRMA', 'CR_FOTO', 'CR_TIPO', 'CR_FOTOF', 'CR_CBARRA'], 'integer'],
            [['CR_FCREA'], 'safe'],
            [['CR_ID', 'CR_DES'], 'string', 'max' => 30],
            [['CR_UCREA', 'CR_UserRI', 'CR_ClaveRI'], 'string', 'max' => 10],
            [['CR_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CR_ID' => 'Cr ID',
            'CR_DES' => 'Cr Des',
            'CR_IMG' => 'Cr Img',
            'CR_FIRMA' => 'Cr Firma',
            'CR_FOTO' => 'Cr Foto',
            'CR_TIPO' => 'Cr Tipo',
            'CR_FOTOF' => 'Cr Fotof',
            'CR_CBARRA' => 'Cr Cbarra',
            'CR_UCREA' => 'Cr Ucrea',
            'CR_FCREA' => 'Cr Fcrea',
            'CR_UserRI' => 'Cr User Ri',
            'CR_ClaveRI' => 'Cr Clave Ri',
            'CR_IMGATRAS' => 'Cr Imgatras',
        ];
    }
}
