<?php

namespace app\models\eva_posgrado;

use Yii;

/**
 * This is the model class for table "mdl_context".
 *
 * @property int $id
 * @property int $contextlevel
 * @property int $instanceid
 * @property string $path
 * @property int $depth
 * @property int $locked
 */
class MdlContextPosgrado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mdl_context';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_eva_posgrado');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contextlevel', 'instanceid', 'depth', 'locked'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['contextlevel', 'instanceid'], 'unique', 'targetAttribute' => ['contextlevel', 'instanceid']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contextlevel' => 'Contextlevel',
            'instanceid' => 'Instanceid',
            'path' => 'Path',
            'depth' => 'Depth',
            'locked' => 'Locked',
        ];
    }
}
