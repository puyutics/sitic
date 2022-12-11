<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_PERFIL_FRM".
 *
 * @property int $FRM_ID
 * @property string $FRM_NOM
 * @property string $FRM_TITULO
 * @property int $FRM_ESTADO
 */
class TblPerfilFrm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_PERFIL_FRM';
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
            [['FRM_ESTADO'], 'integer'],
            [['FRM_NOM', 'FRM_TITULO'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FRM_ID' => 'Frm ID',
            'FRM_NOM' => 'Frm Nom',
            'FRM_TITULO' => 'Frm Titulo',
            'FRM_ESTADO' => 'Frm Estado',
        ];
    }
}
