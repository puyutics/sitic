<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "DEPARTMENTS".
 *
 * @property int $DEPTID
 * @property string $DEPTNAME
 * @property int $SUPDEPTID
 * @property int $InheritParentSch
 * @property int $InheritDeptSch
 * @property int $InheritDeptSchClass
 * @property int $AutoSchPlan
 * @property int $InLate
 * @property int $OutEarly
 * @property int $InheritDeptRule
 * @property int $MinAutoSchInterval
 * @property int $RegisterOT
 * @property int $DefaultSchId
 * @property int $ATT
 * @property int $Holiday
 * @property int $OverTime
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'DEPARTMENTS';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_biometrico');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DEPTID', 'SUPDEPTID', 'DefaultSchId'], 'required'],
            [['DEPTID', 'SUPDEPTID', 'InheritParentSch', 'InheritDeptSch', 'InheritDeptSchClass', 'AutoSchPlan', 'InLate', 'OutEarly', 'InheritDeptRule', 'MinAutoSchInterval', 'RegisterOT', 'DefaultSchId', 'ATT', 'Holiday', 'OverTime'], 'integer'],
            [['DEPTNAME'], 'string', 'max' => 30],
            [['DEPTID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'DEPTID' => 'Deptid',
            'DEPTNAME' => 'Deptname',
            'SUPDEPTID' => 'Supdeptid',
            'InheritParentSch' => 'Inherit Parent Sch',
            'InheritDeptSch' => 'Inherit Dept Sch',
            'InheritDeptSchClass' => 'Inherit Dept Sch Class',
            'AutoSchPlan' => 'Auto Sch Plan',
            'InLate' => 'In Late',
            'OutEarly' => 'Out Early',
            'InheritDeptRule' => 'Inherit Dept Rule',
            'MinAutoSchInterval' => 'Min Auto Sch Interval',
            'RegisterOT' => 'Register Ot',
            'DefaultSchId' => 'Default Sch ID',
            'ATT' => 'Att',
            'Holiday' => 'Holiday',
            'OverTime' => 'Over Time',
        ];
    }
}
