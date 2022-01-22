<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mdl_role".
 *
 * @property int $id
 * @property string $name
 * @property string $shortname
 * @property string $description
 * @property int $sortorder
 * @property string $archetype
 */
class MdlRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mdl_role';
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
            [['description'], 'required'],
            [['description'], 'string'],
            [['sortorder'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['shortname'], 'string', 'max' => 100],
            [['archetype'], 'string', 'max' => 30],
            [['sortorder'], 'unique'],
            [['shortname'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'shortname' => 'Shortname',
            'description' => 'Description',
            'sortorder' => 'Sortorder',
            'archetype' => 'Archetype',
        ];
    }
}
