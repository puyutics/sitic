<?php

namespace app\models\eva_pregrado;

use Yii;

/**
 * This is the model class for table "mdl_attendance".
 *
 * @property int $id
 * @property int $course
 * @property string $name
 * @property int $grade
 * @property int $timemodified
 * @property string $intro
 * @property int $introformat
 * @property string $subnet
 * @property string $sessiondetailspos
 * @property int $showsessiondetails
 * @property int $showextrauserdetails
 */
class MdlAttendance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mdl_attendance';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eva_pregrado');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course', 'grade', 'timemodified', 'introformat', 'showsessiondetails', 'showextrauserdetails'], 'integer'],
            [['intro'], 'string'],
            [['name', 'subnet'], 'string', 'max' => 255],
            [['sessiondetailspos'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course' => 'Course',
            'name' => 'Name',
            'grade' => 'Grade',
            'timemodified' => 'Timemodified',
            'intro' => 'Intro',
            'introformat' => 'Introformat',
            'subnet' => 'Subnet',
            'sessiondetailspos' => 'Sessiondetailspos',
            'showsessiondetails' => 'Showsessiondetails',
            'showextrauserdetails' => 'Showextrauserdetails',
        ];
    }
}
