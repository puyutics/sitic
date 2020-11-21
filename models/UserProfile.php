<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property string $dni DNI/CEDULA/PASAPORTE
 * @property string $username USUARIO
 * @property string $firstname NOMBRES
 * @property string $lastname APELLIDOS
 * @property string $commonname NOM. COMPLETO
 * @property string $displayname NOM. MOSTRAR
 * @property string $mail EMAIL
 * @property string $personalmail EMAIL PERSONAL
 * @property string $mobile CELULAR
 *
 * @property User $username0
 */
class UserProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'mail'], 'required'],
            [['dni', 'mobile'], 'string', 'max' => 50],
            [['username', 'firstname', 'lastname', 'commonname', 'displayname', 'mail', 'personalmail'], 'string', 'max' => 255],
            [['username'], 'unique'],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['username' => 'username']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'dni' => Yii::t('app', 'DNI/CEDULA/PASAPORTE'),
            'username' => Yii::t('app', 'USUARIO'),
            'firstname' => Yii::t('app', 'NOMBRES'),
            'lastname' => Yii::t('app', 'APELLIDOS'),
            'commonname' => Yii::t('app', 'NOM. COMPLETO'),
            'displayname' => Yii::t('app', 'NOM. MOSTRAR'),
            'mail' => Yii::t('app', 'EMAIL'),
            'personalmail' => Yii::t('app', 'EMAIL PERSONAL'),
            'mobile' => Yii::t('app', 'CELULAR'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(User::className(), ['username' => 'username']);
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
        if (!isset($user)) {
            return null;
        }
        return new static($user);
    }
}