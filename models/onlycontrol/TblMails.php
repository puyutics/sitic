<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_MAILS".
 *
 * @property int $ID_MSG
 * @property string $ID_SUBJECT
 * @property string $ID_DESC
 * @property int $ID_STATUS
 * @property string $OBSERVACION
 * @property string $FECHA_CREA
 * @property string $FECHA_ENVIO
 */
class TblMails extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_MAILS';
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
            [['ID_DESC'], 'string'],
            [['ID_STATUS'], 'integer'],
            [['FECHA_CREA', 'FECHA_ENVIO'], 'safe'],
            [['ID_SUBJECT'], 'string', 'max' => 250],
            [['OBSERVACION'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_MSG' => 'Id Msg',
            'ID_SUBJECT' => 'Id Subject',
            'ID_DESC' => 'Id Desc',
            'ID_STATUS' => 'Id Status',
            'OBSERVACION' => 'Observacion',
            'FECHA_CREA' => 'Fecha Crea',
            'FECHA_ENVIO' => 'Fecha Envio',
        ];
    }
}
