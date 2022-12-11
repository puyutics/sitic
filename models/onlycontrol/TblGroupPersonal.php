<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_GROUP_PERSONAL".
 *
 * @property string $GP_ID
 * @property string $GP_DES
 * @property string $GP_SEL
 */
class TblGroupPersonal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_GROUP_PERSONAL';
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
            [['GP_DES'], 'required'],
            [['GP_SEL'], 'number'],
            [['GP_DES'], 'string', 'max' => 50],
            [['GP_DES'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'GP_ID' => 'Gp ID',
            'GP_DES' => 'Gp Des',
            'GP_SEL' => 'Gp Sel',
        ];
    }
}
