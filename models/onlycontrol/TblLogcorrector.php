<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "TBL_LOGCORRECTOR".
 *
 * @property string $LC_IDEMP
 * @property string $LC_MARCA
 * @property string $LC_TIPOUDT
 * @property string $LC_TIPOORI
 * @property string $LC_HORARIO
 * @property string $LC_MODALIDAD
 * @property string $LC_TIPOPROCESO
 * @property string $LC_FECHAPROCESA
 * @property string $LC_HFRANJA
 */
class TblLogcorrector extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'TBL_LOGCORRECTOR';
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
            [['LC_IDEMP', 'LC_MARCA'], 'required'],
            [['LC_MARCA', 'LC_FECHAPROCESA'], 'safe'],
            [['LC_HORARIO', 'LC_MODALIDAD', 'LC_HFRANJA'], 'number'],
            [['LC_IDEMP'], 'string', 'max' => 6],
            [['LC_TIPOUDT', 'LC_TIPOORI'], 'string', 'max' => 10],
            [['LC_TIPOPROCESO'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'LC_IDEMP' => 'Lc Idemp',
            'LC_MARCA' => 'Lc Marca',
            'LC_TIPOUDT' => 'Lc Tipoudt',
            'LC_TIPOORI' => 'Lc Tipoori',
            'LC_HORARIO' => 'Lc Horario',
            'LC_MODALIDAD' => 'Lc Modalidad',
            'LC_TIPOPROCESO' => 'Lc Tipoproceso',
            'LC_FECHAPROCESA' => 'Lc Fechaprocesa',
            'LC_HFRANJA' => 'Lc Hfranja',
        ];
    }
}
