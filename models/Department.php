<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property int $id ID DEPARTAMENTO
 * @property string $department NOMBRE DEPARTAMENTO
 * @property int $parent_id DEPARTAMENTO PADRE
 * @property int $status ESTADO DEPARTAMENTO
 *
 * @property Department $parent
 * @property Department[] $departments
 * @property PhonesExtensions[] $phonesExtensions
 * @property Printers[] $printers
 * @property UserDepartment[] $userDepartments
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['department', 'status'], 'required'],
            [['parent_id', 'status'], 'integer'],
            [['department'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID DEPARTAMENTO'),
            'department' => Yii::t('app', 'NOMBRE DEPARTAMENTO'),
            'parent_id' => Yii::t('app', 'DEPARTAMENTO PADRE'),
            'status' => Yii::t('app', 'ESTADO DEPARTAMENTO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Department::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Department::className(), ['parent_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhonesExtensions()
    {
        return $this->hasMany(PhonesExtensions::className(), ['department_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrinters()
    {
        return $this->hasMany(Printers::className(), ['department_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDepartments()
    {
        return $this->hasMany(UserDepartment::className(), ['department_id' => 'id']);
    }
}
