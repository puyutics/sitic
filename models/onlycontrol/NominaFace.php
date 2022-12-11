<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "NOMINA_FACE".
 *
 * @property string $NOMINA_ID
 * @property int $FACE_QUICK
 * @property resource $FACE_MINUTA1
 * @property resource $FACE_MINUTA2
 * @property resource $FACE_MINUTA3
 * @property resource $FACE_MINUTA4
 * @property resource $FACE_MINUTA5
 * @property resource $FACE_CAPTURE Imagen de la importación desde
 * @property resource $FACE_PICTURE Imagen de Enrolamiento para un
 * @property resource $FACE_TEMPLATE Minuta Face Neuro 12
 * @property resource $FACE_XFACE Minuta Face Virdi XFACE
 */
class NominaFace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NOMINA_FACE';
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
            [['FACE_QUICK'], 'integer'],
            [['FACE_MINUTA1', 'FACE_MINUTA2', 'FACE_MINUTA3', 'FACE_MINUTA4', 'FACE_MINUTA5', 'FACE_CAPTURE', 'FACE_PICTURE', 'FACE_TEMPLATE', 'FACE_XFACE'], 'string'],
            [['NOMINA_ID'], 'string', 'max' => 8],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NOMINA_ID' => 'Nomina ID',
            'FACE_QUICK' => 'Face Quick',
            'FACE_MINUTA1' => 'Face Minuta1',
            'FACE_MINUTA2' => 'Face Minuta2',
            'FACE_MINUTA3' => 'Face Minuta3',
            'FACE_MINUTA4' => 'Face Minuta4',
            'FACE_MINUTA5' => 'Face Minuta5',
            'FACE_CAPTURE' => 'Imagen de la importación desde',
            'FACE_PICTURE' => 'Imagen de Enrolamiento para un',
            'FACE_TEMPLATE' => 'Minuta Face Neuro 12',
            'FACE_XFACE' => 'Minuta Face Virdi XFACE',
        ];
    }
}
