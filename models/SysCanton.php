<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sys_canton".
 *
 * @property int $id ID
 * @property int $sys_provincia_id
 * @property string $canton CANTON
 * @property int $status ESTADO
 *
 * @property SysProvincia $sysProvincia
 */
class SysCanton extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sys_canton';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sys_provincia_id', 'canton'], 'required'],
            [['sys_provincia_id', 'status'], 'integer'],
            [['canton'], 'string', 'max' => 255],
            [['sys_provincia_id'], 'exist', 'skipOnError' => true, 'targetClass' => SysProvincia::className(), 'targetAttribute' => ['sys_provincia_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sys_provincia_id' => 'Sys Provincia ID',
            'canton' => 'Canton',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysProvincia()
    {
        return $this->hasOne(SysProvincia::className(), ['id' => 'sys_provincia_id']);
    }
}
