<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_PERFIL_TIPO".
 *
 * @property int $PER_ID
 * @property string $PER_NOM
 * @property int $PER_ESTADO
 */
class TblPerfilTipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_PERFIL_TIPO';
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
            [['PER_ESTADO'], 'required'],
            [['PER_ESTADO'], 'integer'],
            [['PER_NOM'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PER_ID' => 'Per ID',
            'PER_NOM' => 'Per Nom',
            'PER_ESTADO' => 'Per Estado',
        ];
    }
}
