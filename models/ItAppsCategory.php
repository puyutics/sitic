<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_apps_category".
 *
 * @property int $id ID
 * @property string $category
 *
 * @property ItApps[] $itApps
 */
class ItAppsCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'it_apps_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category'], 'required'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category' => Yii::t('app', 'Category'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItApps()
    {
        return $this->hasMany(ItApps::className(), ['it_apps_category_id' => 'id']);
    }
}
