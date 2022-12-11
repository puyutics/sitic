<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "T_AFI_BIOMETRIC".
 *
 * @property string $NO_PERSONA
 * @property string $BIO_PERSONA
 * @property int $BIO_ESTADO
 * @property resource $BIO_Finger1
 * @property resource $BIO_Finger1I
 * @property resource $BIO_Finger2
 * @property resource $BIO_Finger2I
 * @property resource $BIO_Finger3
 * @property resource $BIO_Finger3I
 * @property resource $BIO_Finger4
 * @property resource $BIO_Finger4I
 * @property resource $BIO_Finger5
 * @property resource $BIO_Finger5I
 * @property resource $BIO_Finger6
 * @property resource $BIO_Finger6I
 * @property resource $BIO_Finger7
 * @property resource $BIO_Finger7I
 * @property resource $BIO_Finger8
 * @property resource $BIO_Finger8I
 * @property resource $BIO_Finger9
 * @property resource $BIO_Finger9I
 * @property resource $BIO_Finger10
 * @property resource $BIO_Finger10I
 * @property int $BIO_Smart
 * @property resource $BIO_FOTO
 * @property resource $BIO_FINGERWSQ1
 * @property resource $BIO_FINGERWSQ2
 * @property resource $BIO_FINGERWSQ3
 * @property resource $BIO_FINGERWSQ4
 * @property resource $BIO_FINGERWSQ5
 * @property resource $BIO_FINGERWSQ6
 * @property resource $BIO_FINGERWSQ7
 * @property resource $BIO_FINGERWSQ8
 * @property resource $BIO_FINGERWSQ9
 * @property resource $BIO_FINGERWSQ10
 */
class TAfiBiometric extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'T_AFI_BIOMETRIC';
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
            [['NO_PERSONA'], 'required'],
            [['BIO_ESTADO', 'BIO_Smart'], 'integer'],
            [['BIO_Finger1', 'BIO_Finger1I', 'BIO_Finger2', 'BIO_Finger2I', 'BIO_Finger3', 'BIO_Finger3I', 'BIO_Finger4', 'BIO_Finger4I', 'BIO_Finger5', 'BIO_Finger5I', 'BIO_Finger6', 'BIO_Finger6I', 'BIO_Finger7', 'BIO_Finger7I', 'BIO_Finger8', 'BIO_Finger8I', 'BIO_Finger9', 'BIO_Finger9I', 'BIO_Finger10', 'BIO_Finger10I', 'BIO_FOTO', 'BIO_FINGERWSQ1', 'BIO_FINGERWSQ2', 'BIO_FINGERWSQ3', 'BIO_FINGERWSQ4', 'BIO_FINGERWSQ5', 'BIO_FINGERWSQ6', 'BIO_FINGERWSQ7', 'BIO_FINGERWSQ8', 'BIO_FINGERWSQ9', 'BIO_FINGERWSQ10'], 'string'],
            [['NO_PERSONA'], 'string', 'max' => 25],
            [['BIO_PERSONA'], 'string', 'max' => 100],
            [['NO_PERSONA'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NO_PERSONA' => 'No Persona',
            'BIO_PERSONA' => 'Bio Persona',
            'BIO_ESTADO' => 'Bio Estado',
            'BIO_Finger1' => 'Bio Finger1',
            'BIO_Finger1I' => 'Bio Finger1i',
            'BIO_Finger2' => 'Bio Finger2',
            'BIO_Finger2I' => 'Bio Finger2i',
            'BIO_Finger3' => 'Bio Finger3',
            'BIO_Finger3I' => 'Bio Finger3i',
            'BIO_Finger4' => 'Bio Finger4',
            'BIO_Finger4I' => 'Bio Finger4i',
            'BIO_Finger5' => 'Bio Finger5',
            'BIO_Finger5I' => 'Bio Finger5i',
            'BIO_Finger6' => 'Bio Finger6',
            'BIO_Finger6I' => 'Bio Finger6i',
            'BIO_Finger7' => 'Bio Finger7',
            'BIO_Finger7I' => 'Bio Finger7i',
            'BIO_Finger8' => 'Bio Finger8',
            'BIO_Finger8I' => 'Bio Finger8i',
            'BIO_Finger9' => 'Bio Finger9',
            'BIO_Finger9I' => 'Bio Finger9i',
            'BIO_Finger10' => 'Bio Finger10',
            'BIO_Finger10I' => 'Bio Finger10i',
            'BIO_Smart' => 'Bio Smart',
            'BIO_FOTO' => 'Bio Foto',
            'BIO_FINGERWSQ1' => 'Bio Fingerwsq1',
            'BIO_FINGERWSQ2' => 'Bio Fingerwsq2',
            'BIO_FINGERWSQ3' => 'Bio Fingerwsq3',
            'BIO_FINGERWSQ4' => 'Bio Fingerwsq4',
            'BIO_FINGERWSQ5' => 'Bio Fingerwsq5',
            'BIO_FINGERWSQ6' => 'Bio Fingerwsq6',
            'BIO_FINGERWSQ7' => 'Bio Fingerwsq7',
            'BIO_FINGERWSQ8' => 'Bio Fingerwsq8',
            'BIO_FINGERWSQ9' => 'Bio Fingerwsq9',
            'BIO_FINGERWSQ10' => 'Bio Fingerwsq10',
        ];
    }
}
