<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "tbl_ZonaMarcaje".
 *
 * @property string $ZM_ID
 * @property string $ZM_DES
 * @property string $ZM_SEL
 * @property int $ZM_EMPE
 * @property string $ZM_EMPE_NOM
 */
class TblZonaMarcaje extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_ZonaMarcaje';
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
            [['ZM_DES'], 'required'],
            [['ZM_SEL'], 'number'],
            [['ZM_EMPE'], 'integer'],
            [['ZM_DES'], 'string', 'max' => 50],
            [['ZM_EMPE_NOM'], 'string', 'max' => 150],
            [['ZM_DES'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ZM_ID' => 'Zm ID',
            'ZM_DES' => 'Zm Des',
            'ZM_SEL' => 'Zm Sel',
            'ZM_EMPE' => 'Zm Empe',
            'ZM_EMPE_NOM' => 'Zm Empe Nom',
        ];
    }
}
