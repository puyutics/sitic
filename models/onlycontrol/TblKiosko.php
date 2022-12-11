<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_KIOSKO".
 *
 * @property string $KIOSKO_ID
 * @property string $KIOSKO_DESC
 * @property string $KIOSKO_IP
 * @property string $KIOSKO_DSN
 * @property string $KIOSKO_USER
 * @property string $KIOSKO_PASS
 * @property string $KIOSKO_TIPO
 * @property string $KIOSKO_ESTADO
 */
class TblKiosko extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_KIOSKO';
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
            [['KIOSKO_ID', 'KIOSKO_DESC', 'KIOSKO_DSN', 'KIOSKO_USER', 'KIOSKO_PASS', 'KIOSKO_TIPO'], 'required'],
            [['KIOSKO_ID', 'KIOSKO_IP'], 'string', 'max' => 20],
            [['KIOSKO_DESC'], 'string', 'max' => 50],
            [['KIOSKO_DSN', 'KIOSKO_USER', 'KIOSKO_PASS', 'KIOSKO_TIPO'], 'string', 'max' => 30],
            [['KIOSKO_ESTADO'], 'string', 'max' => 15],
            [['KIOSKO_ID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'KIOSKO_ID' => 'Kiosko ID',
            'KIOSKO_DESC' => 'Kiosko Desc',
            'KIOSKO_IP' => 'Kiosko Ip',
            'KIOSKO_DSN' => 'Kiosko Dsn',
            'KIOSKO_USER' => 'Kiosko User',
            'KIOSKO_PASS' => 'Kiosko Pass',
            'KIOSKO_TIPO' => 'Kiosko Tipo',
            'KIOSKO_ESTADO' => 'Kiosko Estado',
        ];
    }
}
