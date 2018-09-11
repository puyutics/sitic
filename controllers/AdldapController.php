<?php

namespace app\controllers;

use Yii;
use Yii\base\Security;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Logs;
use app\models\AdldapForgetpassForm;
use app\models\AdldapForgetuserForm;
use app\models\AdldapPasswordForm;
use app\models\AdldapResetForm;
use app\models\AdldapEditForm;

class AdldapController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','edit','forgetpass','forgetuser','password','reset',
                            'saveLog','sendToken'],
                'rules' => [
                    [
                        'actions' => ['index','edit','forgetpass','forgetuser','password','reset',
                                        'saveLog','sendToken'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index','forgetpass','forgetuser','password','reset',
                                        'saveLog','sendToken'],
                        'allow' => true,
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
     * @inheritdoc
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


    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionEdit()
    {
        if (isset(Yii::$app->user->identity->username)
            and (Yii::$app->session->get('authtype') == 'adldap')) {

            $model = new AdldapEditForm();
            $sAMAccountname = Yii::$app->user->identity->username;
            $user = Yii::$app->ad->getProvider('default')->search()
                ->findBy('sAMAccountname', $sAMAccountname);
            $model->dni = $user->getAttribute(Yii::$app->params['dni'],0);
            $model->firstname = $user->getFirstName();
            $model->lastname = $user->getLastName();
            $model->commonname = $user->getCommonName();
            $model->displayname = $user->getDisplayName();
            $model->mail = $user->getEmail();
            $model->personalmail = $user->getAttribute(Yii::$app->params['personalmail'], 0);
            $model->mobile = $user->getAttribute(Yii::$app->params['mobile'], 0);

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $post_form = Yii::$app->request->post('AdldapEditForm');
                $post_personalmail = $post_form['personalmail'];
                $post_mobile = $post_form['mobile'];

                if (isset($post_personalmail)) {
                    $user->setAttribute(Yii::$app->params['personalmail'],$post_personalmail);
                    $user->setAttribute(Yii::$app->params['mobile'],$post_mobile);
                    $user->save();

                    Yii::$app->session->setFlash('success', "Actualizado Correctamente");

                    //Crear Registro de Log en la base de datos
                    $description =
                        'Información actualizada del usuario: ' . $sAMAccountname
                    ;
                    $this->saveLog('adldapEdit', $sAMAccountname, $description, 'adldap');

                    return $this->render('edit',
                        ['model'=>$model]);
                }
            } else {
                return $this->render('edit',
                    ['model'=>$model]);
            }
        } else {
            return $this->redirect('index.php?r=site/index');
        }
    }


    public function actionForgetpass()
    {
        $model = new AdldapForgetpassForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $post_form = Yii::$app->request->post('AdldapForgetpassForm');
            $post_mail = $post_form['mail'];
            $post_dni = $post_form['dni'];
            $post_sAMAccountname = explode("@", $post_mail);
            $sAMAccountname = $post_sAMAccountname[0];

            $user = Yii::$app->ad->getProvider('default')->search()
                ->findBy('sAMAccountname', $sAMAccountname);

            if (isset($user)) {

                $mail = $user->getAttribute('mail',0);
                $dni = $user->getAttribute(Yii::$app->params['dni'],0);
                $personalmail = $user->getAttribute(Yii::$app->params['personalmail'],0);
                $fullname = $user->getAttribute('cn',0);

                if (($post_mail == $mail) and ($post_dni == $dni)) {

                    //Crear un Reset TOKEN
                    $resetToken = hash(Yii::$app->params['algorithm'],
                        Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $mail);

                    //Enviar Reset TOKEN por email
                    $this->sendToken($dni,$fullname,$mail,$personalmail,$resetToken);

                    //Crear Registro de Log en la base de datos
                    $description =
                        'Envío de Token para el usuario: ' . $sAMAccountname
                        . ', al correo electrónico personal: ' . $personalmail
                    ;
                    $this->saveLog('sendToken', $sAMAccountname, $description, 'adldap');

                    //Mensaje de email enviado
                    Yii::$app->session->setFlash('successMail', $personalmail);

                    return $this->render('forgetpass', [
                        'model'=>$model]); //Success
                }
                Yii::$app->session->setFlash('error','DNI, Cédula o Pasaporte incorrecto');

                return $this->render('forgetpass',
                    ['model'=>$model]); //DNI incorrecto
            } else {
                Yii::$app->session->setFlash('error','Usuario o Correo institucional incorrecto');

                return $this->render('forgetpass',
                    ['model'=>$model]); //Mail incorrecto
            }

        } else {
            return $this->render('forgetpass', [
                'model' => $model,
            ]);
        }

    }


    public function actionForgetuser()
    {
        $model = new AdldapForgetuserForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {


            $post_form = Yii::$app->request->post('AdldapForgetuserForm');
            $post_dni = $post_form['dni'];

            $user = Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $post_dni);


            if (isset($user)) {

                $mail = $user->getAttribute('mail',0);
                $sAMAccountname = $user->getAttribute('samaccountname',0);

                //Crear Registro de Log en la base de datos
                $description =
                    'Consulta de nombre de usuario: ' . $sAMAccountname
                ;
                $this->saveLog('forgetUser', $sAMAccountname, $description, 'adldap');

                //Mensaje de email enviado
                Yii::$app->session->setFlash('successMail', $mail);

                return $this->render('forgetuser', [
                    'model'=>$model]); //Success

            } else {

                Yii::$app->session->setFlash('error','DNI, Cédula o Pasaporte incorrecto');
                return $this->render('forgetuser',
                    ['model'=>$model]); //DNI incorrecta
            }

        } else {
            return $this->render('forgetuser', [
                'model' => $model,
            ]);
        }

    }


    public function actionReset()
    {
        $model = new AdldapResetForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                $post_form = Yii::$app->request->post('AdldapResetForm');
                $post_mail = $post_form['mail'];
                $post_newPassword = $post_form['newPassword'];
                $post_verifyNewPassword = $post_form['verifyNewPassword'];
                $post_resetToken = $post_form['resetToken'];
                $post_sAMAccountname = explode("@", $post_mail);
                $sAMAccountname = $post_sAMAccountname[0];

                $user = Yii::$app->ad->getProvider('default')->search()
                    ->findBy('sAMAccountname', $sAMAccountname);

                if (isset($user)) {
                    $mail = $user->getAttribute('mail', 0);
                    $dni = $user->getAttribute(Yii::$app->params['dni'],0);

                    $saltKey =   Yii::$app->params['saltKey'];
                    $resetToken = hash(Yii::$app->params['algorithm'], Yii::$app->params['saltKey'] .
                        Yii::$app->params['tokenDateFormat'] . $mail);
                    if (($post_mail == $mail) and ($post_resetToken == $resetToken)) {
                        if ($post_newPassword == $post_verifyNewPassword) {

                            $user->setPassword($post_newPassword);
                            $user->save();


                            //Crear Registro de Log en la base de datos
                            $description =
                                'Cambio correcto de contraseña del usuario: ' . $sAMAccountname
                            ;
                            $this->saveLog('resetPasswordToken', $sAMAccountname, $description, 'adldap');


                            Yii::$app->session->setFlash('successReset');
                            return $this->render('reset', ['model' => $model]); //Success

                        } else {
                            Yii::$app->session->setFlash('error',
                                'La verificación de la nueva contraseña es incorrecta');

                            return $this->render('reset',
                                ['model' => $model]); //resetToken incorrecto
                        }
                    }
                    Yii::$app->session->setFlash('error',
                        'Reset Token incorrecto');
                    return $this->render('reset',
                        ['model' => $model]); //resetToken incorrecto
                } else {
                    Yii::$app->session->setFlash('error',
                        'Usuario o Correo institucional incorrecto');
                    return $this->render('reset',
                        ['model'=>$model]); //Email incorrecto
                }
        } else {
            Yii::$app->session->setFlash('error',
                'Su nueva contraseña debe contener al menos 8 dígitos
                        entre mayúsculas, minúsculas y números. 
                        NO UTILICE SUS NOMBRES y/o APELLIDOS');
            return $this->render('reset', [
                'model' => $model,
            ]);
        }
    }


    public function actionPassword()
    {
        $model = new AdldapPasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                $post_form = Yii::$app->request->post('AdldapPasswordForm');
                $post_mail = $post_form['mail'];
                $post_oldPassword = $post_form['oldPassword'];
                $post_newPassword = $post_form['newPassword'];
                $post_verifyNewPassword = $post_form['verifyNewPassword'];
                $post_sAMAccountname = explode("@", $post_mail);
                $sAMAccountname = $post_sAMAccountname[0];

                $user = Yii::$app->ad->getProvider('default')->search()
                    ->findBy('sAMAccountname', $sAMAccountname);

                if (isset($user)) {
                    $mail = $user->getAttribute('mail',0);
                    $dni = $user->getAttribute(Yii::$app->params['dni'],0);
                    if (Yii::$app->ad->getProvider('default')->auth()->attempt($sAMAccountname, $post_oldPassword)) {
                        if ($post_newPassword == $post_verifyNewPassword) {

                            $user->setPassword($post_newPassword);
                            $user->save();


                            //Crear Registro de Log en la base de datos
                            $description =
                                'Cambio correcto de contraseña del usuario: ' . $sAMAccountname
                            ;
                            $this->saveLog('resetPassword', $sAMAccountname, $description, 'adldap');

                            Yii::$app->session->setFlash('successPassword');
                            return $this->render('password', ['model' => $model]); //Contraseña cambiada con éxito

                        } else {
                            Yii::$app->session->setFlash('error','La verificación de la nueva contraseña es incorrecta');

                            return $this->render('password',
                                ['model' => $model]); //Nueva Contraseña incorrecta
                        }
                    } else {
                        Yii::$app->session->setFlash('error','Contraseña actual incorrecta');
                        return $this->render('password',
                            ['model' => $model]); //Contraseña Actual incorrecta
                    }

                } else {
                    Yii::$app->session->setFlash('error','Correo institucional incorrecto');
                    return $this->render('password',
                        ['model'=>$model]); //Email incorrecto
                }
        } else {
            Yii::$app->session->setFlash('error',
                'Su nueva contraseña debe contener al menos 8 dígitos
                        entre mayúsculas, minúsculas y números. 
                        NO UTILICE SUS NOMBRES y/o APELLIDOS');
            return $this->render('password', [
                'model' => $model,
            ]);
        }
    }


    public function saveLog($type, $sAMAccountname, $description, $external_type)
    {
        //Registro (Log) Evento sendToken
        $modelLogs              = new Logs();
        $modelLogs->type        = $type;
        $modelLogs->username    = $sAMAccountname;
        $modelLogs->datetime    = date('Y-m-d H:i:s');
        $modelLogs->description = $description;
        ;
        $modelLogs->ipaddress       = Yii::$app->request->userIP;
        $modelLogs->external_id     = $sAMAccountname;
        $modelLogs->external_type   = $external_type;
        $modelLogs->save(false);
    }


    public function sendToken($dni,$fullname,$mail,$personalmail,$resetToken)
    {
            $body =
                "Estimado usuario," . "\n" .
                "Se ha solicitado reiniciar la contraseña de la cuenta institucional de " . Yii::$app->params['company'] . "\n\n" .
                "DNI/Céd/Pasaporte:   " . $dni . "\n" .
                "Nombres/Apellidos:    " . $fullname . "\n" .
                "Cuenta institucional:   " . $mail . "\n\n" .
                "--------------------------------------------------------------------------------------" . "\n" .
                "Haga clic en el siguiente enlace para restaurar su contraseña:" . "\n\n" .
                Yii::$app->params['appURL'] . "index.php?r=adldap/reset&mail=" . $mail . "&resetToken=" . $resetToken . "\n\n" .
                "--------------------------------------------------------------------------------------" . "\n" .
                "NOTA: TOKEN válido SOLO el ". date('d-m-Y') . " (dd-mm-AA) desde las 00:00 hasta las 23:59" . "\n\n" .
                "---> Correo enviado por el sistema automático de Gestión de identidad. NO RESPONDA ESTE CORREO <---"
            ;

            Yii::$app->mailer->compose()
                ->setTo($personalmail)
                ->setFrom(Yii::$app->params['from'], Yii::$app->params['fromName'])
                ->setCc(Yii::$app->params['cc'])
                ->setSubject(Yii::$app->params['subject'])
                ->setTextBody($body)
                ->send();
            return true;
    }

}
