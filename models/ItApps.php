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
 * @property int $status ESTADO
 * @property int $it_apps_category_id CATEGORIA
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
            [['title', 'description', 'status', 'it_apps_category_id'], 'required'],
            [['description', 'password'], 'string'],
            [['status', 'it_apps_category_id'], 'integer'],
            [['title', 'username', 'email', 'url'], 'string', 'max' => 255],
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
            'status' => Yii::t('app', 'ESTADO'),
            'it_apps_category_id' => Yii::t('app', 'CATEGORIA'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItAppsCategory()
    {
        return $this->hasOne(ItAppsCategory::className(), ['id' => 'it_apps_category_id']);
    }


    //Desencriptar password
    public function getPassword($password)
    {
        return Yii::$app->security->decryptByKey(utf8_decode($password), Yii::$app->params['saltKey']);
    }

    //Encriptar password
    public function setPassword($password)
    {
        return utf8_encode(Yii::$app->security->encryptByKey($password, Yii::$app->params['saltKey']));
    }
}
