<?php

namespace app\models\parkingcontrol;

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
 * @property int $DEP_SYNC
 * @property int $DEP_SYNCID
 * @property int $DEP_ORIGEN
 *
 * @property NOMINA[] $nOMINAs
 */
class DPTO extends \yii\db\ActiveRecord
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
        return Yii::$app->get('db_parkingcontrol');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DEP_ARE'], 'number'],
            [['DEP_NOM'], 'required'],
            [['DEP_SYNC', 'DEP_SYNCID', 'DEP_ORIGEN'], 'integer'],
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
            'DEP_SYNC' => 'Dep Sync',
            'DEP_SYNCID' => 'Dep Syncid',
            'DEP_ORIGEN' => 'Dep Origen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNOMINAs()
    {
        return $this->hasMany(NOMINA::className(), ['NOMINA_DEP' => 'DEP_ID', 'NOMINA_DEP1' => 'DEP_NOM']);
    }
}
