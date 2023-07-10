<?php

namespace app\models\eva_pregrado;

use Yii;

/**
 * This is the model class for table "mdl_attendance_sessions".
 *
 * @property int $id
 * @property int $attendanceid
 * @property int $groupid
 * @property int $sessdate
 * @property int $duration
 * @property int $lasttaken
 * @property int $lasttakenby
 * @property int $timemodified
 * @property string $description
 * @property int $descriptionformat
 * @property int $studentscanmark
 * @property int $allowupdatestatus
 * @property int $studentsearlyopentime
 * @property int $autoassignstatus
 * @property string $studentpassword
 * @property string $subnet
 * @property int $automark
 * @property int $automarkcompleted
 * @property int $statusset
 * @property int $absenteereport
 * @property int $preventsharedip
 * @property int $preventsharediptime
 * @property int $caleventid
 * @property int $calendarevent
 * @property int $includeqrcode
 * @property int $rotateqrcode
 * @property string $rotateqrcodesecret
 * @property int $automarkcmid
 */
class MdlAttendanceSessions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mdl_attendance_sessions';
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
            [['attendanceid', 'groupid', 'sessdate', 'duration', 'lasttaken', 'lasttakenby', 'timemodified', 'descriptionformat', 'studentscanmark', 'allowupdatestatus', 'studentsearlyopentime', 'autoassignstatus', 'automark', 'automarkcompleted', 'statusset', 'absenteereport', 'preventsharedip', 'preventsharediptime', 'caleventid', 'calendarevent', 'includeqrcode', 'rotateqrcode', 'automarkcmid'], 'integer'],
            [['description'], 'required'],
            [['description'], 'string'],
            [['studentpassword'], 'string', 'max' => 50],
            [['subnet'], 'string', 'max' => 255],
            [['rotateqrcodesecret'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'attendanceid' => 'Attendanceid',
            'groupid' => 'Groupid',
            'sessdate' => 'Sessdate',
            'duration' => 'Duration',
            'lasttaken' => 'Lasttaken',
            'lasttakenby' => 'Lasttakenby',
            'timemodified' => 'Timemodified',
            'description' => 'Description',
            'descriptionformat' => 'Descriptionformat',
            'studentscanmark' => 'Studentscanmark',
            'allowupdatestatus' => 'Allowupdatestatus',
            'studentsearlyopentime' => 'Studentsearlyopentime',
            'autoassignstatus' => 'Autoassignstatus',
            'studentpassword' => 'Studentpassword',
            'subnet' => 'Subnet',
            'automark' => 'Automark',
            'automarkcompleted' => 'Automarkcompleted',
            'statusset' => 'Statusset',
            'absenteereport' => 'Absenteereport',
            'preventsharedip' => 'Preventsharedip',
            'preventsharediptime' => 'Preventsharediptime',
            'caleventid' => 'Caleventid',
            'calendarevent' => 'Calendarevent',
            'includeqrcode' => 'Includeqrcode',
            'rotateqrcode' => 'Rotateqrcode',
            'rotateqrcodesecret' => 'Rotateqrcodesecret',
            'automarkcmid' => 'Automarkcmid',
        ];
    }
}
