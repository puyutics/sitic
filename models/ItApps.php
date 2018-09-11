<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "it_apps".
 *
 * @property int $id ID
 * @property string $title ETIQUETA
 * @property string $description DETALLE
 * @property string $username USUARIO
 * @property string $password CONTRASEÑA
 * @property string $email EMAIL
 * @property string $url URL
 * @property int $it_apps_category_id
 *
 * @property ItAppsCategory $itAppsCategory
 */
class ItApps extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'it_apps';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'it_apps_category_id'], 'required'],
            [['description'], 'string'],
            [['it_apps_category_id'], 'integer'],
            [['title', 'username', 'password', 'email', 'url'], 'string', 'max' => 255],
            [['it_apps_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItAppsCategory::className(), 'targetAttribute' => ['it_apps_category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'ETIQUETA'),
            'description' => Yii::t('app', 'DETALLE'),
            'username' => Yii::t('app', 'USUARIO'),
            'password' => Yii::t('app', 'CONTRASEÑA'),
            'email' => Yii::t('app', 'EMAIL'),
            'url' => Yii::t('app', 'URL'),
            'it_apps_category_id' => Yii::t('app', 'It Apps Category ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItAppsCategory()
    {
        return $this->hasOne(ItAppsCategory::className(), ['id' => 'it_apps_category_id']);
    }
}
