<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "T_BIOFRAME_FACE".
 *
 * @property string $FACE_ID
 * @property string $FACE_NAME
 * @property resource $FACE_FOTO
 * @property resource $FACE_MIN
 * @property string $FACE_FCREA
 * @property string $FACE_UCREA
 * @property string $FACE_SMC
 * @property string $FACE_FLAG1
 * @property string $FACE_FLAG2
 */
class TBioframeFace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'T_BIOFRAME_FACE';
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
            [['FACE_ID'], 'required'],
            [['FACE_FOTO', 'FACE_MIN'], 'string'],
            [['FACE_FCREA'], 'safe'],
            [['FACE_ID'], 'string', 'max' => 25],
            [['FACE_NAME'], 'string', 'max' => 100],
            [['FACE_UCREA'], 'string', 'max' => 10],
            [['FACE_SMC'], 'string', 'max' => 2],
            [['FACE_FLAG1', 'FACE_FLAG2'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FACE_ID' => 'Face ID',
            'FACE_NAME' => 'Face Name',
            'FACE_FOTO' => 'Face Foto',
            'FACE_MIN' => 'Face Min',
            'FACE_FCREA' => 'Face Fcrea',
            'FACE_UCREA' => 'Face Ucrea',
            'FACE_SMC' => 'Face Smc',
            'FACE_FLAG1' => 'Face Flag1',
            'FACE_FLAG2' => 'Face Flag2',
        ];
    }
}
