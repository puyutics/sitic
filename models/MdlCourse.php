<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mdl_course".
 *
 * @property int $id
 * @property int $category
 * @property int $sortorder
 * @property string $fullname
 * @property string $shortname
 * @property string $idnumber
 * @property string $summary
 * @property int $summaryformat
 * @property string $format
 * @property int $showgrades
 * @property int $newsitems
 * @property int $startdate
 * @property int $enddate
 * @property int $relativedatesmode
 * @property int $marker
 * @property int $maxbytes
 * @property int $legacyfiles
 * @property int $showreports
 * @property int $visible
 * @property int $visibleold
 * @property int $downloadcontent
 * @property int $groupmode
 * @property int $groupmodeforce
 * @property int $defaultgroupingid
 * @property string $lang
 * @property string $calendartype
 * @property string $theme
 * @property int $timecreated
 * @property int $timemodified
 * @property int $requested
 * @property int $enablecompletion
 * @property int $completionnotify
 * @property int $cacherev
 * @property int $originalcourseid
 * @property int $showactivitydates
 * @property int $showcompletionconditions
 */
class MdlCourse extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mdl_course';
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
            [['category', 'sortorder', 'summaryformat', 'showgrades', 'newsitems', 'startdate', 'enddate', 'relativedatesmode', 'marker', 'maxbytes', 'legacyfiles', 'showreports', 'visible', 'visibleold', 'downloadcontent', 'groupmode', 'groupmodeforce', 'defaultgroupingid', 'timecreated', 'timemodified', 'requested', 'enablecompletion', 'completionnotify', 'cacherev', 'originalcourseid', 'showactivitydates', 'showcompletionconditions'], 'integer'],
            [['summary'], 'string'],
            [['fullname'], 'string', 'max' => 254],
            [['shortname'], 'string', 'max' => 255],
            [['idnumber'], 'string', 'max' => 100],
            [['format'], 'string', 'max' => 21],
            [['lang', 'calendartype'], 'string', 'max' => 30],
            [['theme'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'sortorder' => 'Sortorder',
            'fullname' => 'Fullname',
            'shortname' => 'Shortname',
            'idnumber' => 'Idnumber',
            'summary' => 'Summary',
            'summaryformat' => 'Summaryformat',
            'format' => 'Format',
            'showgrades' => 'Showgrades',
            'newsitems' => 'Newsitems',
            'startdate' => 'Startdate',
            'enddate' => 'Enddate',
            'relativedatesmode' => 'Relativedatesmode',
            'marker' => 'Marker',
            'maxbytes' => 'Maxbytes',
            'legacyfiles' => 'Legacyfiles',
            'showreports' => 'Showreports',
            'visible' => 'Visible',
            'visibleold' => 'Visibleold',
            'downloadcontent' => 'Downloadcontent',
            'groupmode' => 'Groupmode',
            'groupmodeforce' => 'Groupmodeforce',
            'defaultgroupingid' => 'Defaultgroupingid',
            'lang' => 'Lang',
            'calendartype' => 'Calendartype',
            'theme' => 'Theme',
            'timecreated' => 'Timecreated',
            'timemodified' => 'Timemodified',
            'requested' => 'Requested',
            'enablecompletion' => 'Enablecompletion',
            'completionnotify' => 'Completionnotify',
            'cacherev' => 'Cacherev',
            'originalcourseid' => 'Originalcourseid',
            'showactivitydates' => 'Showactivitydates',
            'showcompletionconditions' => 'Showcompletionconditions',
        ];
    }
}
