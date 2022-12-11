<?php

namespace app\models\eva_pregrado;

use Yii;

/**
 * This is the model class for table "mdl_user".
 *
 * @property int $id
 * @property string $auth
 * @property int $confirmed
 * @property int $policyagreed
 * @property int $deleted
 * @property int $suspended
 * @property int $mnethostid
 * @property string $username
 * @property string $password
 * @property string $idnumber
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property int $emailstop
 * @property string $phone1
 * @property string $phone2
 * @property string $institution
 * @property string $department
 * @property string $address
 * @property string $city
 * @property string $country
 * @property string $lang
 * @property string $calendartype
 * @property string $theme
 * @property string $timezone
 * @property int $firstaccess
 * @property int $lastaccess
 * @property int $lastlogin
 * @property int $currentlogin
 * @property string $lastip
 * @property string $secret
 * @property int $picture
 * @property string $description
 * @property int $descriptionformat
 * @property int $mailformat
 * @property int $maildigest
 * @property int $maildisplay
 * @property int $autosubscribe
 * @property int $trackforums
 * @property int $timecreated
 * @property int $timemodified
 * @property int $trustbitmask
 * @property string $imagealt
 * @property string $lastnamephonetic
 * @property string $firstnamephonetic
 * @property string $middlename
 * @property string $alternatename
 * @property string $moodlenetprofile
 */
class MdlUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mdl_user';
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
            [['confirmed', 'policyagreed', 'deleted', 'suspended', 'mnethostid', 'emailstop', 'firstaccess', 'lastaccess', 'lastlogin', 'currentlogin', 'picture', 'descriptionformat', 'mailformat', 'maildigest', 'maildisplay', 'autosubscribe', 'trackforums', 'timecreated', 'timemodified', 'trustbitmask'], 'integer'],
            [['description'], 'string'],
            [['auth', 'phone1', 'phone2'], 'string', 'max' => 20],
            [['username', 'firstname', 'lastname', 'email', 'timezone'], 'string', 'max' => 100],
            [['password', 'idnumber', 'institution', 'department', 'address', 'imagealt', 'lastnamephonetic', 'firstnamephonetic', 'middlename', 'alternatename', 'moodlenetprofile'], 'string', 'max' => 255],
            [['city'], 'string', 'max' => 120],
            [['country'], 'string', 'max' => 2],
            [['lang', 'calendartype'], 'string', 'max' => 30],
            [['theme'], 'string', 'max' => 50],
            [['lastip'], 'string', 'max' => 45],
            [['secret'], 'string', 'max' => 15],
            [['mnethostid', 'username'], 'unique', 'targetAttribute' => ['mnethostid', 'username']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'auth' => 'Auth',
            'confirmed' => 'Confirmed',
            'policyagreed' => 'Policyagreed',
            'deleted' => 'Deleted',
            'suspended' => 'Suspended',
            'mnethostid' => 'Mnethostid',
            'username' => 'Username',
            'password' => 'Password',
            'idnumber' => 'Idnumber',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'email' => 'Email',
            'emailstop' => 'Emailstop',
            'phone1' => 'Phone1',
            'phone2' => 'Phone2',
            'institution' => 'Institution',
            'department' => 'Department',
            'address' => 'Address',
            'city' => 'City',
            'country' => 'Country',
            'lang' => 'Lang',
            'calendartype' => 'Calendartype',
            'theme' => 'Theme',
            'timezone' => 'Timezone',
            'firstaccess' => 'Firstaccess',
            'lastaccess' => 'Lastaccess',
            'lastlogin' => 'Lastlogin',
            'currentlogin' => 'Currentlogin',
            'lastip' => 'Lastip',
            'secret' => 'Secret',
            'picture' => 'Picture',
            'description' => 'Description',
            'descriptionformat' => 'Descriptionformat',
            'mailformat' => 'Mailformat',
            'maildigest' => 'Maildigest',
            'maildisplay' => 'Maildisplay',
            'autosubscribe' => 'Autosubscribe',
            'trackforums' => 'Trackforums',
            'timecreated' => 'Timecreated',
            'timemodified' => 'Timemodified',
            'trustbitmask' => 'Trustbitmask',
            'imagealt' => 'Imagealt',
            'lastnamephonetic' => 'Lastnamephonetic',
            'firstnamephonetic' => 'Firstnamephonetic',
            'middlename' => 'Middlename',
            'alternatename' => 'Alternatename',
            'moodlenetprofile' => 'Moodlenetprofile',
        ];
    }
}
