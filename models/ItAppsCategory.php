<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_apps_category".
 *
 * @property int $id ID
 * @property string $category CATEGORIA
 * @property int $parent_id PADRE
 * @property int $level NIVEL
 * @property int $status ESTADO
 *
 * @property ItApps[] $itApps
 * @property ItAppsCategory $parent
 * @property ItAppsCategory[] $itAppsCategories
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
            [['category', 'parent_id', 'level'], 'required'],
            [['parent_id', 'level', 'status'], 'integer'],
            [['category'], 'string', 'max' => 255],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItAppsCategory::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category' => Yii::t('app', 'CATEGORIA'),
            'parent_id' => Yii::t('app', 'PADRE'),
            'level' => Yii::t('app', 'NIVEL'),
            'status' => Yii::t('app', 'ESTADO'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItApps()
    {
        return $this->hasMany(ItApps::className(), ['it_apps_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(ItAppsCategory::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItAppsCategories()
    {
        return $this->hasMany(ItAppsCategory::className(), ['parent_id' => 'id']);
    }
}
