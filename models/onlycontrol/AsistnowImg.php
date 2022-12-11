<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "ASISTNOW_IMG".
 *
 * @property string $ASIS_ID
 * @property string $ASIS_ING
 * @property string $ASIS_ZONA
 * @property resource $ASIS_IMAGEN
 * @property string $ASIS_TIPO
 * @property string $ASIS_RES
 */
class AsistnowImg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ASISTNOW_IMG';
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
            [['ASIS_ID', 'ASIS_ING', 'ASIS_ZONA'], 'required'],
            [['ASIS_ING'], 'safe'],
            [['ASIS_IMAGEN'], 'string'],
            [['ASIS_ID'], 'string', 'max' => 6],
            [['ASIS_ZONA', 'ASIS_RES'], 'string', 'max' => 20],
            [['ASIS_TIPO'], 'string', 'max' => 10],
            [['ASIS_ID', 'ASIS_ING', 'ASIS_ZONA'], 'unique', 'targetAttribute' => ['ASIS_ID', 'ASIS_ING', 'ASIS_ZONA']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ASIS_ID' => 'Asis ID',
            'ASIS_ING' => 'Asis Ing',
            'ASIS_ZONA' => 'Asis Zona',
            'ASIS_IMAGEN' => 'Asis Imagen',
            'ASIS_TIPO' => 'Asis Tipo',
            'ASIS_RES' => 'Asis Res',
        ];
    }
}
