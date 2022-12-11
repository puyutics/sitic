<?php

namespace app\models\eva_pregrado;

use Yii;

/**
 * This is the model class for table "mdl_role_assignments".
 *
 * @property int $id
 * @property int $roleid
 * @property int $contextid
 * @property int $userid
 * @property int $timemodified
 * @property int $modifierid
 * @property string $component
 * @property int $itemid
 * @property int $sortorder
 */
class MdlRoleAssignments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mdl_role_assignments';
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
            [['roleid', 'contextid', 'userid', 'timemodified', 'modifierid', 'itemid', 'sortorder'], 'integer'],
            [['component'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'roleid' => 'Roleid',
            'contextid' => 'Contextid',
            'userid' => 'Userid',
            'timemodified' => 'Timemodified',
            'modifierid' => 'Modifierid',
            'component' => 'Component',
            'itemid' => 'Itemid',
            'sortorder' => 'Sortorder',
        ];
    }
}
