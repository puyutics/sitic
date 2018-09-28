<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Logs;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays management.
     *
     * @return string
     */
    public function actionManagement()
    {
        return $this->render('management');
    }

    /**
     * Displays identify.
     *
     * @return string
     */
    public function actionIdentity()
    {
        return $this->render('identity');
    }

    /**
     * Displays inventory.
     *
     * @return string
     */
    public function actionInventory()
    {
        return $this->render('inventory');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $username = Yii::$app->user->identity->username;
            $description =
                'Inicio de sesión exitoso, usuario: ' . $username
            ;
            $this->saveLog('login', $username, $description, 'adldap');

            //Cached adldap data on local database
            if(
                isset($model->username)
                and isset($model->password)
                and ($model->authtype == 'adldap')
            ) {
                $post_username = explode("@", $model->username);
                $post_username = $post_username[0];
                $password_hash = hash(Yii::$app->params['algorithm'],$model->password);

                //Cached adldap password on local database
                \Yii::$app->db->createCommand(
                    'UPDATE `user` SET `password`=\''. $password_hash .'\' 
                          WHERE `username` = \'' . $post_username . '\'')
                    ->execute();

                $user = Yii::$app->ad->getProvider('default')->search()
                    ->findBy('sAMAccountname', $post_username);
                $dni = $user->getAttribute(Yii::$app->params['dni'],0);
                $firstname = $user->getFirstName();
                $lastname = $user->getLastName();
                $commonname = $user->getCommonName();
                $displayname = $user->getDisplayName();
                $mail = $user->getEmail();
                $personalmail = $user->getAttribute(Yii::$app->params['personalmail'], 0);
                $mobile = $user->getAttribute(Yii::$app->params['mobile'], 0);

                $userprofile = \app\models\UserProfile::findByUsername($post_username);
                if (isset($userprofile)) {
                    \Yii::$app->db->createCommand(
                        'UPDATE `user_profile` SET 
                          `dni`            = \''. $dni .'\',
                          `firstname`      = \''. $firstname .'\',
                          `lastname`       = \''. $lastname .'\',
                          `commonname`     = \''. $commonname .'\',
                          `displayname`    = \''. $displayname .'\',
                          `mail`           = \''. $mail .'\',
                          `personalmail`   = \''. $personalmail .'\',
                          `mobile`         = \''. $mobile .'\'
                          WHERE `username` = \''. $post_username . '\'
                        ')
                        ->execute();
                } elseif (!isset($userprofile)) {
                    \Yii::$app->db->createCommand(
                        'INSERT INTO `user_profile` (
                          `dni`,
                          `username`,
                          `firstname`,
                          `lastname`,
                          `commonname`,
                          `displayname`,
                          `mail`,
                          `personalmail`,
                          `mobile`
                          ) VALUES (
                          \'' . $dni . '\',
                          \'' . $post_username . '\',
                          \'' . $firstname . '\',
                          \'' . $lastname . '\',
                          \'' . $commonname . '\',
                          \'' . $displayname . '\',
                          \'' . $mail . '\',
                          \'' . $personalmail . '\',
                          \'' . $mobile . '\'
                          )
                        ')
                        ->execute();
                }
            }

            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }



    public function saveLog($type, $username, $description, $external_type)
    {
        //Registro (Log) Evento sendToken
        $modelLogs              = new Logs();
        $modelLogs->type        = $type;
        $modelLogs->username    = $username;
        $modelLogs->datetime    = date('Y-m-d H:i:s');
        $modelLogs->description = $description;
        ;
        $modelLogs->ipaddress       = Yii::$app->request->userIP;
        $modelLogs->external_id     = $username;
        $modelLogs->external_type   = $external_type;
        $modelLogs->save(false);
    }
}
