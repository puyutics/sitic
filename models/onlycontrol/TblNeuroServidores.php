<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_NEURO_SERVIDORES".
 *
 * @property int $SERV_ID
 * @property string $SERV_IP
 * @property string $SERV_DESC
 * @property string $SERV_URL
 * @property string $SERV_USER
 * @property string $SERV_PASS
 * @property int $SERV_ESTADO
 */
class TblNeuroServidores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_NEURO_SERVIDORES';
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
            [['SERV_ESTADO'], 'integer'],
            [['SERV_IP'], 'string', 'max' => 15],
            [['SERV_DESC', 'SERV_URL', 'SERV_USER', 'SERV_PASS'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SERV_ID' => 'Serv ID',
            'SERV_IP' => 'Serv Ip',
            'SERV_DESC' => 'Serv Desc',
            'SERV_URL' => 'Serv Url',
            'SERV_USER' => 'Serv User',
            'SERV_PASS' => 'Serv Pass',
            'SERV_ESTADO' => 'Serv Estado',
        ];
    }
}
