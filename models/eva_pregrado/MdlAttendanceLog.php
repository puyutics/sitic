<?php

namespace app\models\eva_pregrado;

use Yii;

/**
 * This is the model class for table "mdl_attendance_log".
 *
 * @property int $id
 * @property int $sessionid
 * @property int $studentid
 * @property int $statusid
 * @property string $statusset
 * @property int $timetaken
 * @property int $takenby
 * @property string $remarks
 * @property string $ipaddress
 */
class MdlAttendanceLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mdl_attendance_log';
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
            [['sessionid', 'studentid', 'statusid', 'timetaken', 'takenby'], 'integer'],
            [['statusset', 'remarks'], 'string', 'max' => 1333],
            [['ipaddress'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sessionid' => 'Sessionid',
            'studentid' => 'Studentid',
            'statusid' => 'Statusid',
            'statusset' => 'Statusset',
            'timetaken' => 'Timetaken',
            'takenby' => 'Takenby',
            'remarks' => 'Remarks',
            'ipaddress' => 'Ipaddress',
        ];
    }
}
