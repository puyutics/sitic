<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_department".
 *
 * @property int $id ID RELACION
 * @property string $username NOMBRE USUARIO
 * @property int $department_id ID DEPARTAMENTO
 * @property int $status ESTADO
 *
 * @property User $username0
 * @property Department $department
 */
class UserDepartment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'department_id', 'status'], 'required'],
            [['department_id', 'status'], 'integer'],
            [['username'], 'string', 'max' => 255],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'username']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => Department::className(), 'targetAttribute' => ['department_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID RELACION'),
            'username' => Yii::t('app', 'NOMBRE USUARIO'),
            'department_id' => Yii::t('app', 'ID DEPARTAMENTO'),
            'status' => Yii::t('app', 'ESTADO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(User::className(), ['username' => 'username']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(Department::className(), ['id' => 'department_id']);
    }
}
