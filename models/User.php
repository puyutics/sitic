<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id ID
 * @property string $username USUARIO
 * @property string $auth_key CLAVE
 * @property int $status ESTADO
 * @property int $created_at CREADO
 * @property int $updated_at ACTUALIZADO
 */

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'auth_key'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['auth_key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'USUARIO'),
            'auth_key' => Yii::t('app', 'CLAVE'),
            'status' => Yii::t('app', 'ESTADO'),
            'created_at' => Yii::t('app', 'CREADO'),
            'updated_at' => Yii::t('app', 'ACTUALIZADO'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id) {
        $user = self::find()
            ->where([
                "id" => $id
            ])
            ->one();
        if (!count($user)) {
            return null;
        }
        return new static($user);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $userType = null) {

        $user = self::find()
            ->where(["accessToken" => $token])
            ->one();
        if (!count($user)) {
            return null;
        }
        return new static($user);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        $user = self::find()
            ->where([
                "username" => $username
            ])
            ->one();
        if (!count($user)) {
            return null;
        }
        return new static($user);
    }
    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        //return $this->auth_key  === $authKey;
        return $this->auth_key === hash('sha256',$authKey); //Algoritmo de encriptación sha256 para AuthKey
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //return $this->password === $password;
        return $this->auth_key === hash('sha256',$password); //Algoritmo de encriptación sha256 para AuthKey

    }
}
