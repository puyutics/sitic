<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_LIST_MAIL".
 *
 * @property int $MAIL_ID
 * @property string $MAIL_APE_NOM
 * @property string $MAIL_CORREO
 */
class TblListMail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_LIST_MAIL';
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
            [['MAIL_CORREO'], 'required'],
            [['MAIL_APE_NOM'], 'string', 'max' => 100],
            [['MAIL_CORREO'], 'string', 'max' => 60],
            [['MAIL_CORREO'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MAIL_ID' => 'Mail ID',
            'MAIL_APE_NOM' => 'Mail Ape Nom',
            'MAIL_CORREO' => 'Mail Correo',
        ];
    }
}
