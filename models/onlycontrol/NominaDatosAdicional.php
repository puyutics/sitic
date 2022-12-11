<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "NOMINA_DATOS_ADICIONAL".
 *
 * @property string $NOMINA_ID
 * @property string $NOMINA_DIRECCION
 * @property string $NOMINA_TELEFONO
 * @property string $NOMINA_CELULAR
 * @property int $NOMINA_DISCAPACIDAD
 * @property string $NOMINA_DISCAPACIDA_DESCR
 * @property string $NOMINA_ALERGIAS
 */
class NominaDatosAdicional extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NOMINA_DATOS_ADICIONAL';
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
            [['NOMINA_ID'], 'required'],
            [['NOMINA_DISCAPACIDAD'], 'integer'],
            [['NOMINA_ID'], 'string', 'max' => 6],
            [['NOMINA_DIRECCION', 'NOMINA_DISCAPACIDA_DESCR'], 'string', 'max' => 200],
            [['NOMINA_TELEFONO', 'NOMINA_CELULAR'], 'string', 'max' => 30],
            [['NOMINA_ALERGIAS'], 'string', 'max' => 300],
            [['NOMINA_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NOMINA_ID' => 'Nomina ID',
            'NOMINA_DIRECCION' => 'Nomina Direccion',
            'NOMINA_TELEFONO' => 'Nomina Telefono',
            'NOMINA_CELULAR' => 'Nomina Celular',
            'NOMINA_DISCAPACIDAD' => 'Nomina Discapacidad',
            'NOMINA_DISCAPACIDA_DESCR' => 'Nomina Discapacida Descr',
            'NOMINA_ALERGIAS' => 'Nomina Alergias',
        ];
    }
}
