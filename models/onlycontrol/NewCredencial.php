<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "NEW_CREDENCIAL".
 *
 * @property string $CR_ID
 * @property string $CR_FIMPRESION
 * @property string $CR_RESULTADO 0 No Imprimio 1 Si Imprimio 2 
 * @property string $CR_CEDULA
 * @property string $CR_CIUDADANO
 * @property string $CR_FCADUDA
 * @property string $CR_UIMPRIME
 * @property string $CR_AAUTORIZA
 * @property string $CR_FAUTORIZA
 * @property string $CR_TARJETA
 */
class NewCredencial extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NEW_CREDENCIAL';
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
            [['CR_ID', 'CR_RESULTADO'], 'required'],
            [['CR_FIMPRESION', 'CR_FCADUDA', 'CR_FAUTORIZA'], 'safe'],
            [['CR_ID', 'CR_CEDULA', 'CR_UIMPRIME', 'CR_AAUTORIZA'], 'string', 'max' => 10],
            [['CR_RESULTADO'], 'string', 'max' => 1],
            [['CR_CIUDADANO'], 'string', 'max' => 100],
            [['CR_TARJETA'], 'string', 'max' => 20],
            [['CR_FIMPRESION', 'CR_ID', 'CR_RESULTADO'], 'unique', 'targetAttribute' => ['CR_FIMPRESION', 'CR_ID', 'CR_RESULTADO']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'CR_ID' => 'Cr ID',
            'CR_FIMPRESION' => 'Cr Fimpresion',
            'CR_RESULTADO' => '0 No Imprimio 1 Si Imprimio 2 ',
            'CR_CEDULA' => 'Cr Cedula',
            'CR_CIUDADANO' => 'Cr Ciudadano',
            'CR_FCADUDA' => 'Cr Fcaduda',
            'CR_UIMPRIME' => 'Cr Uimprime',
            'CR_AAUTORIZA' => 'Cr Aautoriza',
            'CR_FAUTORIZA' => 'Cr Fautoriza',
            'CR_TARJETA' => 'Cr Tarjeta',
        ];
    }
}
