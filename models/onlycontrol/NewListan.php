<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "NEW_LISTAN".
 *
 * @property string $NOMINA_CED
 * @property string $NOMINA_FINI
 * @property string $NOMINA_FFIN
 * @property string $NOMINA_APE
 * @property string $NOMINA_NOM
 * @property string $NOMINA_DES
 * @property string $NOMINA_REP
 * @property string $NOMINA_FING
 * @property string $NOMINA_UING
 */
class NewListan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'NEW_LISTAN';
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
            [['NOMINA_CED', 'NOMINA_FINI', 'NOMINA_FFIN'], 'required'],
            [['NOMINA_FINI', 'NOMINA_FFIN', 'NOMINA_FING'], 'safe'],
            [['NOMINA_CED'], 'string', 'max' => 12],
            [['NOMINA_APE', 'NOMINA_NOM', 'NOMINA_DES', 'NOMINA_REP'], 'string', 'max' => 100],
            [['NOMINA_UING'], 'string', 'max' => 10],
            [['NOMINA_CED', 'NOMINA_FFIN', 'NOMINA_FINI'], 'unique', 'targetAttribute' => ['NOMINA_CED', 'NOMINA_FFIN', 'NOMINA_FINI']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NOMINA_CED' => 'Nomina Ced',
            'NOMINA_FINI' => 'Nomina Fini',
            'NOMINA_FFIN' => 'Nomina Ffin',
            'NOMINA_APE' => 'Nomina Ape',
            'NOMINA_NOM' => 'Nomina Nom',
            'NOMINA_DES' => 'Nomina Des',
            'NOMINA_REP' => 'Nomina Rep',
            'NOMINA_FING' => 'Nomina Fing',
            'NOMINA_UING' => 'Nomina Uing',
        ];
    }
}
