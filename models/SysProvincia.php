<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_provincia".
 *
 * @property int $id ID
 * @property string $provincia PROVINCIA
 * @property int $status ESTADO
 *
 * @property SysCanton[] $sysCantons
 */
class SysProvincia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_provincia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provincia'], 'required'],
            [['status'], 'integer'],
            [['provincia'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provincia' => 'Provincia',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysCantons()
    {
        return $this->hasMany(SysCanton::className(), ['sys_provincia_id' => 'id']);
    }
}
