<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_PERFIL".
 *
 * @property int $PF_ID
 * @property int $PF_TIPO
 * @property int $PF_FRM
 * @property int $PF_ESTADO
 */
class TblPerfil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_PERFIL';
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
            [['PF_TIPO', 'PF_FRM', 'PF_ESTADO'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PF_ID' => 'Pf ID',
            'PF_TIPO' => 'Pf Tipo',
            'PF_FRM' => 'Pf Frm',
            'PF_ESTADO' => 'Pf Estado',
        ];
    }
}
