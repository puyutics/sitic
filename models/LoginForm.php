<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $authtype;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */

    public function rules()
    {
        /*if (Yii::$app->params['login'] == 'mail'){  //Login with Mail
            return [
                // username and password are both required
                [['username', 'password','logintype'], 'required'],
                // rememberMe must be a boolean value
                ['rememberMe', 'boolean'],
                // password is validated by validatePassword()
                ['password', 'validatePassword'],
                // Inicio de sesión con Email
                [['username'], 'email'],
            ];
        } else {*/
            return [
                // username and password are both required
                [['username', 'password','authtype'], 'required'],
                // rememberMe must be a boolean value
                ['rememberMe', 'boolean'],
                // password is validated by validatePassword()
                ['password', 'validatePassword'],
            ];
        //}
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username'   => 'Usuario / Correo',
            'password'   => 'Contraseña',
            'authtype'   => 'Autenticación',
            'rememberMe' => 'Recordarme',
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user) {
                $this->addError($attribute, 'Usuario incorrecto.');
            }
            elseif (!$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Contraseña incorrecta.');
            }

        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {

        if ($this->validate()) {
            //Agregar variable de sesión authtype
            Yii::$app->session->set('authtype',$this->authtype);

            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */

    public function getUser()
    {
        if ($this->authtype == 'local' and $this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        if ($this->authtype == 'adldap' and $this->_user === false) {
            if (Yii::$app->params['login'] == 'username'){ //With Username
                $this->_user = \Edvlerblog\Adldap2\model\UserDbLdap::findByUsername($this->username);
            } elseif (Yii::$app->params['login'] == 'userPrincipalName'){ //With Principal Name
                $this->_user = \Edvlerblog\Adldap2\model\UserDbLdap::findByAttribute('userPrincipalName',$this->username);
            } elseif (Yii::$app->params['login'] == 'mail'){  //With Mail
                $this->_user =\Edvlerblog\Adldap2\model\UserDbLdap::findByAttribute('mail',$this->username);
            }
        }

        return $this->_user;
    }
}
