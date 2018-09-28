<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "printers".
 *
 * @property int $id ID IMPRESORA
 * @property string $printer NOMBRE IMPRESORA
 * @property string $ipv4_address IP IMPRESORA
 * @property string $serial_number NUMERO SERIE
 * @property int $department_id ID DEPARTAMENTO
 * @property int $inv_models_id ID MODELO
 * @property int $status ESTADO IMPRESORA
 *
 * @property Department $department
 * @property InvModels $invModels
 */
class Printers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'printers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['printer', 'ipv4_address', 'serial_number', 'department_id', 'inv_models_id', 'status'], 'required'],
            [['department_id', 'inv_models_id', 'status'], 'integer'],
            [['printer'], 'string', 'max' => 255],
            [['ipv4_address'], 'string', 'max' => 15],
            [['serial_number'], 'string', 'max' => 45],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['inv_models_id'], 'exist', 'skipOnError' => true, 'targetClass' => InvModels::className(), 'targetAttribute' => ['inv_models_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID IMPRESORA'),
            'printer' => Yii::t('app', 'NOMBRE IMPRESORA'),
            'ipv4_address' => Yii::t('app', 'IP IMPRESORA'),
            'serial_number' => Yii::t('app', 'NUMERO SERIE'),
            'department_id' => Yii::t('app', 'ID DEPARTAMENTO'),
            'inv_models_id' => Yii::t('app', 'ID MODELO'),
            'status' => Yii::t('app', 'ESTADO IMPRESORA'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvModels()
    {
        return $this->hasOne(InvModels::className(), ['id' => 'inv_models_id']);
    }
}
