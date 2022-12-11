<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_GRUPO_IDUSER".
 *
 * @property string $ID_RELACION
 * @property string $GP_ID
 * @property string $NOMINA_ID
 * @property string $NOMINA_APE
 * @property string $NOMINA_NOM
 * @property string $ID_SEL
 */
class TblGrupoIduser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_GRUPO_IDUSER';
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
            [['GP_ID', 'NOMINA_ID'], 'required'],
            [['GP_ID', 'ID_SEL'], 'number'],
            [['NOMINA_ID'], 'string', 'max' => 8],
            [['NOMINA_APE', 'NOMINA_NOM'], 'string', 'max' => 100],
            [['GP_ID', 'NOMINA_ID'], 'unique', 'targetAttribute' => ['GP_ID', 'NOMINA_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_RELACION' => 'Id Relacion',
            'GP_ID' => 'Gp ID',
            'NOMINA_ID' => 'Nomina ID',
            'NOMINA_APE' => 'Nomina Ape',
            'NOMINA_NOM' => 'Nomina Nom',
            'ID_SEL' => 'Id Sel',
        ];
    }
}
