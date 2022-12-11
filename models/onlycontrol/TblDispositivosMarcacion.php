<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_DISPOSITIVOS_MARCACION".
 *
 * @property string $DM_ID
 * @property string $DM_NOMBRE
 * @property string $DM_PUERTA
 * @property string $DM_USER
 * @property string $DM_NOW
 *
 * @property Puerta $dMPUERTA
 */
class TblDispositivosMarcacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_DISPOSITIVOS_MARCACION';
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
            [['DM_ID'], 'string'],
            [['DM_NOMBRE'], 'required'],
            [['DM_NOW'], 'safe'],
            [['DM_NOMBRE'], 'string', 'max' => 100],
            [['DM_PUERTA'], 'string', 'max' => 4],
            [['DM_USER'], 'string', 'max' => 6],
            [['DM_ID'], 'unique'],
            [['DM_PUERTA'], 'exist', 'skipOnError' => true, 'targetClass' => Puerta::className(), 'targetAttribute' => ['DM_PUERTA' => 'PRT_COD']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DM_ID' => 'Dm ID',
            'DM_NOMBRE' => 'Dm Nombre',
            'DM_PUERTA' => 'Dm Puerta',
            'DM_USER' => 'Dm User',
            'DM_NOW' => 'Dm Now',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDMPUERTA()
    {
        return $this->hasOne(Puerta::className(), ['PRT_COD' => 'DM_PUERTA']);
    }
}
