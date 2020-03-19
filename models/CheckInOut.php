<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "CHECKINOUT".
 *
 * @property int $USERID
 * @property string $CHECKTIME
 * @property string $CHECKTYPE
 * @property int $VERIFYCODE
 * @property string $SENSORID
 * @property string $Memoinfo
 * @property int $WorkCode
 * @property string $sn
 * @property int $UserExtFmt
 */
class CheckInOut extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'CHECKINOUT';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_biometrico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['USERID', 'CHECKTIME'], 'required'],
            [['USERID', 'VERIFYCODE', 'WorkCode', 'UserExtFmt'], 'integer'],
            [['CHECKTIME'], 'safe'],
            [['CHECKTYPE'], 'string', 'max' => 1],
            [['SENSORID'], 'string', 'max' => 5],
            [['Memoinfo'], 'string', 'max' => 30],
            [['sn'], 'string', 'max' => 20],
            [['USERID', 'CHECKTIME'], 'unique', 'targetAttribute' => ['USERID', 'CHECKTIME']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'USERID' => 'Userid',
            'CHECKTIME' => 'Marcaciones',
            'CHECKTYPE' => 'Tipo',
            'VERIFYCODE' => 'Verificación',
            'SENSORID' => 'Dispositivo',
            'Memoinfo' => 'Memoinfo',
            'WorkCode' => 'Work Code',
            'sn' => 'Sn',
            'UserExtFmt' => 'User Ext Fmt',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMachines()
    {
        return $this->hasOne(Machines::className(), ['SENSORID' => 'SENSORID']);
    }
}
