<?php

namespace app\models\onlycontrol;

use Yii;

/**
 * This is the model class for table "DPTO".
 *
 * @property string $DEP_ID
 * @property string $DEP_ARE
 * @property string $DEP_NOM
 * @property string $DEP_DESC
 * @property string $DEP_OBS
 * @property string $DEP_EM
 *
 * @property Nomina[] $nominas
 */
class Dpto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'DPTO';
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
            [['DEP_ARE'], 'number'],
            [['DEP_NOM'], 'required'],
            [['DEP_NOM'], 'string', 'max' => 100],
            [['DEP_DESC'], 'string', 'max' => 30],
            [['DEP_OBS', 'DEP_EM'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DEP_ID' => 'Dep ID',
            'DEP_ARE' => 'Dep Are',
            'DEP_NOM' => 'Dep Nom',
            'DEP_DESC' => 'Dep Desc',
            'DEP_OBS' => 'Dep Obs',
            'DEP_EM' => 'Dep Em',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNominas()
    {
        return $this->hasMany(Nomina::className(), ['NOMINA_DEP' => 'DEP_ID', 'NOMINA_DEP1' => 'DEP_NOM']);
    }
}
