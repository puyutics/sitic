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
use app\models\AdldapEditemailForm;
use app\models\AdldapForgetuserForm;
use app\models\AdldapPasswordForm;
use app\models\AdldapResetForm;
use app\models\AdldapCreateForm;
use app\models\AdldapCreateStudentForm;
use app\models\AdldapEditForm;
use app\models\AdldapGroupForm;

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
                'only' => ['create','index','profile','edituser','viewuser','forgetpass',
                    'forgetuser','password','reset','saveLog','sendToken','sendNewUser',
                    'viewgroups','createstudent','editemail'],
                'rules' => [
                    [
                        'actions' => ['index','profile','edituser',
                            'forgetpass','forgetuser','password','reset','saveLog',
                            'sendToken','sendNewUser','viewgroups','create','createstudent'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['saveLog','sendToken'],
                        'allow' => true,
                        'roles' => ['rolDirector'],
                    ],
                    [
                        'actions' => ['profile','viewuser','sendToken'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['index','forgetpass','forgetuser','password','reset',
                                        'saveLog','createstudent','editemail'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => false,
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


    public function actionCreate()
    {

        $model = new AdldapCreateForm();

        if (Yii::$app->session->get('authtype') == 'adldap') {

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);

                if (!isset($checkuser)) {
                    // https://github.com/Adldap2/Adldap2/blob/master/docs/models/model.md#saving
                    // create user
                    $user = \Yii::$app->ad->make()->user([
                        'cn' => $model->commonname,
                    ]);

                    $log = '';

                    // set attributes with set... function
                    $user->setAccountName($model->samaccountname);
                    $log = $log . 'Usuario: ' . $model->samaccountname . '. ';

                    $user->setDisplayName($model->displayname);
                    $log = $log . 'Nombre completo: ' . $model->displayname . '. ';

                    $user->setFirstName($model->firstname);
                    $log = $log . 'Nombres: ' . $model->firstname . '. ';

                    $user->setLastName($model->lastname);
                    $log = $log . 'Apellidos: ' . $model->lastname . '. ';

                    $user->setUserPrincipalName($model->mail);
                    $log = $log . 'Correo: ' . $model->mail . '. ';

                    // create dn
                    //$dn = $user->getDnBuilder();
                    //$dn->addCn($user->getCommonName());
                    //$dn->addOu($model->dn);
                    $dnBuilder = 'CN=' . $model->commonname . ',' . $model->dn;
                    $user->setDn($dnBuilder);
                    //
                    $security = new Security();
                    $user->setPassword($security->generateRandomString(8));
                    $user->setAttribute(Yii::$app->params['dni'],$model->dni);
                    $user->setAttribute(Yii::$app->params['personalmail'],$model->personalmail);
                    $user->setEmail($model->mail);

                    // save an check return value
                    if ($user->save()) {

                        //Comprobar que el usuario ha sido creado
                        do {
                            $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                        } while (!isset($checkuser));

                        if (isset($checkuser) == 1) {
                            $user = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                            $user->setAttribute(Yii::$app->params['mobile'],$model->mobile);
                            $user->setUserAccountControl($model->uac);
                            $user->setDepartment($model->department);
                            $user->setTitle($model->title);
                            $log = $log . 'Cédula: ' . $model->dni . '. ';
                            $log = $log . 'Correo personal: ' . $model->personalmail . '. ';
                            $log = $log . 'Celular: ' . $model->mobile . '. ';
                            $log = $log . 'Departamento: ' . $model->department . '. ';
                            $log = $log . 'Titulo: ' . $model->title . '.';

                            if ($user->save()) {
                                Yii::$app->session->setFlash('success', "Usuario creado correctamente");
                                $username = Yii::$app->user->identity->username;

                                //Enviar usuario creado por email
                                $dni = $model->dni;
                                $fullname = $model->commonname;
                                $mail = $model->mail;
                                $personalmail = $model->personalmail;

                                $this->sendNewUser($dni,$fullname,$mail,$personalmail);

                                //Crear Registro de Log en la base de datos
                                $description =
                                    'Usuario creado. ' . $log
                                ;
                                $this->saveLog('adldapCreateUser', $username, $description, $model->samaccountname,'adldap');
                                return $this->redirect(['edituser', 'search' => $model->samaccountname]);
                                //return $this->render('edituser',['model'=>$model]);

                            } else {
                                Yii::$app->session->setFlash('error', "Problemas al actualizar el usuario");
                                return $this->render('create',
                                    ['model'=>$model]);
                            }

                        } else {
                            Yii::$app->session->setFlash('error', "Problemas de validación del usuario");
                            return $this->render('create',
                                ['model'=>$model]);
                        }

                    } else {
                        Yii::$app->session->setFlash('error', "Problemas al crear el usuario");
                        return $this->render('create',
                            ['model'=>$model]);
                    }
                } else {
                    Yii::$app->session->setFlash('error', "Ya existe el usuario");

                    $user = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                    $security = new Security();
                    $user->setPassword($security->generateRandomString(8));
                    $user->setAttribute(Yii::$app->params['mobile'],$model->mobile);
                    $user->setUserAccountControl($model->uac);
                    $user->setDepartment($model->department);
                    $user->setTitle($model->title);

                    $log = '';
                    $log = $log . 'Usuario: ' . $model->samaccountname . '. ';
                    $log = $log . 'Nombre completo: ' . $model->displayname . '. ';
                    $log = $log . 'Nombres: ' . $model->firstname . '. ';
                    $log = $log . 'Apellidos: ' . $model->lastname . '. ';
                    $log = $log . 'Correo: ' . $model->mail . '. ';
                    $log = $log . 'Cédula: ' . $model->dni . '. ';
                    $log = $log . 'Correo personal: ' . $model->personalmail . '. ';
                    $log = $log . 'Celular: ' . $model->mobile . '. ';
                    $log = $log . 'Departamento: ' . $model->department . '. ';
                    $log = $log . 'Titulo: ' . $model->title . '.';

                    if ($user->update()) {
                        Yii::$app->session->setFlash('success', "Usuario creado correctamente");
                        $username = Yii::$app->user->identity->username;

                        //Enviar usuario creado por email
                        $dni = $model->dni;
                        $fullname = $model->commonname;
                        $mail = $model->mail;
                        $personalmail = $model->personalmail;

                        $this->sendNewUser($dni,$fullname,$mail,$personalmail);

                        //Crear Registro de Log en la base de datos
                        $description =
                            'Usuario creado. ' . $log
                        ;
                        $this->saveLog('adldapCreateUser', $username, $description, $model->samaccountname,'adldap');
                        return $this->redirect(['edituser', 'search' => $model->samaccountname]);
                        //return $this->render('edituser',['model'=>$model]);

                    }

                    //return $this->render('create',['model'=>$model]);
                    return $this->redirect(['edituser', 'search' => $model->samaccountname]);
                }

            } else {
                return $this->render('create',
                    ['model'=>$model]);
            }
        }
        return $this->render('create',
            ['model'=>$model]);
    }


    public function actionCreatestudent()
    {

        $model = new AdldapCreateStudentForm();

        if ($model->load(Yii::$app->request->post())) {
            //PASO 1: VALIDAR CEDULA Y FECHA DE NACIMIENTO
            if ($model->step == 1) {
                $adldapnewuser = \app\models\AdldapNewUsers::find()
                    ->where(['dni' => $model->dni])
                    ->andWhere(['fec_nacimiento' => $model->fec_nacimiento])
                    //->orderBy('id DESC')
                    ->one();

                if (isset($adldapnewuser)) {

                    $user = \Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $model->dni);
                    if (isset($user) and ($adldapnewuser->status == 1)) {

                        //OBTENER PRIMERA INICIAL DE CADA NOMBRE
                        $fn = explode(' ', $adldapnewuser->nombres);
                        $result_fn = '';
                        foreach($fn as $t) {
                            $result_fn .= $t[0];
                        }
                        if (strlen($result_fn)>2) {
                            $result_fn = substr($result_fn,0,2);
                        }

                        //OBTENER EL PRIMER APELLIDO
                        $ln = explode(' ', $adldapnewuser->apellidos);
                        $result_ln = $ln[0];

                        //OBTENER PRIMERA INICIAL DEL SEGUNDO APELLIDO
                        $ln2 = explode(' ', $adldapnewuser->apellidos);
                        $result_ln2= '';
                        foreach($ln2 as $t) {
                            $result_ln2 .= $t[0];
                        }
                        if (strlen($result_ln2)>1) {
                            $result_ln2 = substr($result_ln2,1,1);
                        }

                        //VERIFICAR SI EXISTE EL USUARIO EN EL NUEVO FORMATO
                        $samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                        if ($samaccountname == $user->getAttribute('samaccountname',0)) {
                            $adldapnewuser->status = 3;
                            if ($adldapnewuser->save(false)) {

                                $model->samaccountname = $user->getAttribute('samaccountname',0);
                                $model->mail = $user->getEmail();

                                $model->firstname = $adldapnewuser->nombres;
                                $model->lastname = $adldapnewuser->apellidos;
                                $model->personalmail = $adldapnewuser->email_personal;
                                $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                                $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                                $model->mobile = $adldapnewuser->celular;
                                $model->title = 'Estudiante';
                                $model->department = $adldapnewuser->carrera;
                                $model->token = hash(Yii::$app->params['algorithm'],
                                    Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                                $model->step = 5;
                                return $this->render('create_student',
                                    ['model' => $model]);
                            }
                        }


                        $model->samaccountname = $user->getAttribute('samaccountname',0);
                        $model->firstname = $user->getFirstName();
                        $model->lastname = $user->getLastName();
                        $model->mail = $user->getEmail();
                        $model->commonname = $user->getAttribute('cn',0);
                        $model->displayname = $user->getDisplayName();
                        $model->personalmail = $user->getAttribute(Yii::$app->params['personalmail'],0);
                        $model->mobile = $user->getAttribute(Yii::$app->params['mobile'],0);
                        $model->groups = $user->getGroups();
                        $model->dn = $user->getDn();
                        $model->uac = $user->getUserAccountControl();
                        $model->department = $user->getDepartment();
                        $model->title = $user->getTitle();

                        $model->token = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        $model->step = 0;
                        return $this->render('create_student',
                            ['model' => $model]);
                    }

                    $model->firstname = $adldapnewuser->nombres;
                    $model->lastname = $adldapnewuser->apellidos;
                    $model->personalmail = $adldapnewuser->email_personal;
                    $model->mobile = $adldapnewuser->celular;

                    if ($adldapnewuser->status == 1) {
                        $model->step = 2;
                        return $this->render('create_student',
                            ['model' => $model]);
                    } elseif ($adldapnewuser->status == 2) {
                        $model->firstname = $adldapnewuser->nombres;
                        $model->lastname = $adldapnewuser->apellidos;
                        $model->personalmail = $adldapnewuser->email_personal;
                        $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->mobile = $adldapnewuser->celular;
                        $model->title = 'Estudiante';
                        $model->department = $adldapnewuser->carrera;
                        $model->token = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        $model->step = 4;
                        return $this->render('create_student',
                            ['model' => $model]);
                    } elseif ($adldapnewuser->status == 3) {

                        /*//OBTENER PRIMERA INICIAL DE CADA NOMBRE
                        $fn = explode(' ', $model->firstname);
                        $result_fn = '';
                        foreach($fn as $t) {
                            $result_fn .= $t[0];
                        }
                        if (strlen($result_fn)>2) {
                            $result_fn = substr($result_fn,0,2);
                        }

                        //OBTENER EL PRIMER APELLIDO
                        $ln = explode(' ', $model->lastname);
                        $result_ln = $ln[0];

                        //OBTENER PRIMERA INICIAL DEL SEGUNDO APELLIDO
                        $ln2 = explode(' ', $model->lastname);
                        $result_ln2= '';
                        foreach($ln2 as $t) {
                            $result_ln2 .= $t[0];
                        }
                        if (strlen($result_ln2)>1) {
                            $result_ln2 = substr($result_ln2,1,1);
                        }

                        //VERIFICAR SI EXISTE USUARIO
                        $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                        $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                        if (!isset($checkuser)) {

                            //OBTENER DOS INICIALES DEL SEGUNDO APELLIDO
                            $ln2 = explode(' ', $model->lastname);
                            $result_ln2= '';
                            foreach($ln2 as $t) {
                                $result_ln2 .= $t[0] . $t[1];
                            }
                            if (strlen($result_ln2)>2) {
                                $result_ln2 = substr($result_ln2,2,2);
                            }

                            //VERIFICAR SI EXISTE USUARIO
                            $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                            $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                            if (!isset($checkuser)) {

                                //OBTENER DOS INICIALES DE CADA NOMBRE
                                $fn = explode(' ', $model->firstname);
                                $result_fn = '';
                                foreach($fn as $t) {
                                    $result_fn .= $t[0] . $t[1];
                                }
                                if (strlen($result_fn)>4) {
                                    $result_fn = substr($result_fn,0,4);
                                }

                                //OBTENER PRIMERA INICIAL DEL SEGUNDO APELLIDO
                                $ln2 = explode(' ', $model->lastname);
                                $result_ln2= '';
                                foreach($ln2 as $t) {
                                    $result_ln2 .= $t[0];
                                }
                                if (strlen($result_ln2)>1) {
                                    $result_ln2 = substr($result_ln2,1,1);
                                }

                                //VERIFICAR SI EXISTE USUARIO
                                $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                                $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                                if (!isset($checkuser)) {
                                    Yii::$app->session->setFlash('error',
                                        "Error al identificar su usuario. Por favor notifique su inconveniente en la Mesa de Ayuda");
                                }
                            }
                        }*/

                        $checkuser = \Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $model->dni);;

                        $model->samaccountname = $checkuser->getAttribute('samaccountname',0);
                        $model->mail = $checkuser->getEmail();

                        $model->firstname = $adldapnewuser->nombres;
                        $model->lastname = $adldapnewuser->apellidos;
                        $model->personalmail = $adldapnewuser->email_personal;
                        $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->mobile = $adldapnewuser->celular;
                        $model->title = 'Estudiante';
                        $model->department = $adldapnewuser->carrera;
                        $model->token = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        $model->step = 5;
                        return $this->render('create_student',
                            ['model' => $model]);

                    } elseif ($adldapnewuser->status == 4) {
                        $user = \Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $model->dni);
                        $model->samaccountname = $user->getAttribute('samaccountname',0);
                        $model->mail = $user->getEmail();

                        $model->firstname = $adldapnewuser->nombres;
                        $model->lastname = $adldapnewuser->apellidos;
                        $model->personalmail = $adldapnewuser->email_personal;
                        $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->mobile = $adldapnewuser->celular;
                        $model->title = 'Estudiante';
                        $model->department = $adldapnewuser->carrera;
                        $model->token = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        $model->step = 6;
                        return $this->render('create_student',
                            ['model' => $model]);
                    }
                } else {
                    Yii::$app->session->setFlash('errorNoBd',
                        "Es posible que sus datos sean incorrectos o que usted no conste en los listados enviados por la SENESCYT. <br><br> Recuerde que debe esperar a que se cumplan todas las etapas de postulación dispuestas por SENESCYT");
                    return $this->render('create_student',
                        ['model' => $model]);
                }
            } elseif ($model->step == 2) {
                $adldapnewuser = \app\models\AdldapNewUsers::find()
                    ->where(['dni' => $model->dni])
                    ->andWhere(['fec_nacimiento' => $model->fec_nacimiento])
                    //->orderBy('id DESC')
                    ->one();

                if (isset($adldapnewuser)) {
                    $model->firstname = $adldapnewuser->nombres;
                    $model->lastname = $adldapnewuser->apellidos;
                    //$model->personalmail = $adldapnewuser->email_personal;
                    $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                    $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                    $model->mobile = $adldapnewuser->celular;
                    $model->title = 'Estudiante';
                    $model->department = $adldapnewuser->carrera;

                    if ($adldapnewuser->status == 1) {
                        //Enviar email de verificación del correo personal
                        $dni = $model->dni;
                        $fullname = $model->commonname;
                        $personalmail = $model->personalmail;
                        //Crear un Reset TOKEN
                        $resetToken = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        $this->sendNewStudentToken($dni,$fullname,$personalmail,$resetToken);

                        $model->step = 3;
                        Yii::$app->session->setFlash('personalmail', $model->personalmail);

                        return $this->render('create_student',
                            ['model' => $model]);
                    } elseif ($adldapnewuser->status == 2) {
                        $model->firstname = $adldapnewuser->nombres;
                        $model->lastname = $adldapnewuser->apellidos;
                        $model->personalmail = $adldapnewuser->email_personal;
                        $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->mobile = $adldapnewuser->celular;
                        $model->title = 'Estudiante';
                        $model->department = $adldapnewuser->carrera;
                        $model->token = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        $model->step = 4;
                        return $this->render('create_student',
                            ['model' => $model]);
                    } elseif ($adldapnewuser->status == 3) {

                        /*//OBTENER PRIMERA INICIAL DE CADA NOMBRE
                        $fn = explode(' ', $model->firstname);
                        $result_fn = '';
                        foreach($fn as $t) {
                            $result_fn .= $t[0];
                        }
                        if (strlen($result_fn)>2) {
                            $result_fn = substr($result_fn,0,2);
                        }

                        //OBTENER EL PRIMER APELLIDO
                        $ln = explode(' ', $model->lastname);
                        $result_ln = $ln[0];

                        //OBTENER PRIMERA INICIAL DEL SEGUNDO APELLIDO
                        $ln2 = explode(' ', $model->lastname);
                        $result_ln2= '';
                        foreach($ln2 as $t) {
                            $result_ln2 .= $t[0];
                        }
                        if (strlen($result_ln2)>1) {
                            $result_ln2 = substr($result_ln2,1,1);
                        }

                        //VERIFICAR SI EXISTE USUARIO
                        $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                        $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                        if (!isset($checkuser)) {

                            //OBTENER DOS INICIALES DEL SEGUNDO APELLIDO
                            $ln2 = explode(' ', $model->lastname);
                            $result_ln2= '';
                            foreach($ln2 as $t) {
                                $result_ln2 .= $t[0] . $t[1];
                            }
                            if (strlen($result_ln2)>2) {
                                $result_ln2 = substr($result_ln2,2,2);
                            }

                            //VERIFICAR SI EXISTE USUARIO
                            $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                            $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                            if (!isset($checkuser)) {

                                //OBTENER DOS INICIALES DE CADA NOMBRE
                                $fn = explode(' ', $model->firstname);
                                $result_fn = '';
                                foreach($fn as $t) {
                                    $result_fn .= $t[0] . $t[1];
                                }
                                if (strlen($result_fn)>4) {
                                    $result_fn = substr($result_fn,0,4);
                                }

                                //OBTENER PRIMERA INICIAL DEL SEGUNDO APELLIDO
                                $ln2 = explode(' ', $model->lastname);
                                $result_ln2= '';
                                foreach($ln2 as $t) {
                                    $result_ln2 .= $t[0];
                                }
                                if (strlen($result_ln2)>1) {
                                    $result_ln2 = substr($result_ln2,1,1);
                                }

                                //VERIFICAR SI EXISTE USUARIO
                                $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                                $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                                if (!isset($checkuser)) {
                                    Yii::$app->session->setFlash('error',
                                        "Error al identificar su usuario. Por favor notifique su inconveniente en la Mesa de Ayuda");
                                }
                            }
                        }*/

                        $checkuser = \Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $model->dni);
                        $model->samaccountname = $checkuser->getAttribute('samaccountname',0);
                        $model->mail = $checkuser->getEmail();

                        $model->firstname = $adldapnewuser->nombres;
                        $model->lastname = $adldapnewuser->apellidos;
                        $model->personalmail = $adldapnewuser->email_personal;
                        $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->mobile = $adldapnewuser->celular;
                        $model->title = 'Estudiante';
                        $model->department = $adldapnewuser->carrera;
                        $model->token = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        $model->step = 5;
                        return $this->render('create_student',
                            ['model' => $model]);
                    } elseif ($adldapnewuser->status == 4) {
                        $user = \Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $model->dni);
                        $model->samaccountname = $user->getAttribute('samaccountname',0);
                        $model->mail = $user->getEmail();

                        $model->firstname = $adldapnewuser->nombres;
                        $model->lastname = $adldapnewuser->apellidos;
                        $model->personalmail = $adldapnewuser->email_personal;
                        $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->mobile = $adldapnewuser->celular;
                        $model->title = 'Estudiante';
                        $model->department = $adldapnewuser->carrera;
                        $model->token = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        $model->step = 6;
                        return $this->render('create_student',
                            ['model' => $model]);
                    }
                }
            } elseif ($model->step == 3) {
                $adldapnewuser = \app\models\AdldapNewUsers::find()
                    ->where(['dni' => $model->dni])
                    ->andWhere(['fec_nacimiento' => $model->fec_nacimiento])
                    //->orderBy('id DESC')
                    ->one();

                if (isset($adldapnewuser)) {
                    $model->firstname = $adldapnewuser->nombres;
                    $model->lastname = $adldapnewuser->apellidos;
                    //$model->personalmail = $adldapnewuser->email_personal;
                    $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                    $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                    $model->mobile = $adldapnewuser->celular;
                    $model->title = 'Estudiante';
                    $model->department = $adldapnewuser->carrera;

                    if ($adldapnewuser->status == 1) {
                        $resetToken = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        if ($model->token == $resetToken) {

                            $model->step = 4;
                            $adldapnewuser->email_personal = $model->personalmail;
                            $adldapnewuser->status = 2;
                            $adldapnewuser->save(false);

                            return $this->render('create_student',['model' => $model]);

                        } elseif ($model->token != $resetToken) {
                            Yii::$app->session->setFlash('error',
                                "El token no es válido. Por favor repita el proceso");
                            $model->step = 3;
                            return $this->render('create_student',
                                ['model' => $model]);
                        }
                    } elseif ($adldapnewuser->status == 2) {
                        $model->firstname = $adldapnewuser->nombres;
                        $model->lastname = $adldapnewuser->apellidos;
                        $model->personalmail = $adldapnewuser->email_personal;
                        $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->mobile = $adldapnewuser->celular;
                        $model->title = 'Estudiante';
                        $model->department = $adldapnewuser->carrera;
                        $model->token = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        $model->step = 4;
                        return $this->render('create_student',
                            ['model' => $model]);
                    } elseif ($adldapnewuser->status == 3) {

                        /*//OBTENER PRIMERA INICIAL DE CADA NOMBRE
                        $fn = explode(' ', $model->firstname);
                        $result_fn = '';
                        foreach($fn as $t) {
                            $result_fn .= $t[0];
                        }
                        if (strlen($result_fn)>2) {
                            $result_fn = substr($result_fn,0,2);
                        }

                        //OBTENER EL PRIMER APELLIDO
                        $ln = explode(' ', $model->lastname);
                        $result_ln = $ln[0];

                        //OBTENER PRIMERA INICIAL DEL SEGUNDO APELLIDO
                        $ln2 = explode(' ', $model->lastname);
                        $result_ln2= '';
                        foreach($ln2 as $t) {
                            $result_ln2 .= $t[0];
                        }
                        if (strlen($result_ln2)>1) {
                            $result_ln2 = substr($result_ln2,1,1);
                        }

                        //VERIFICAR SI EXISTE USUARIO
                        $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                        $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                        if (!isset($checkuser)) {

                            //OBTENER DOS INICIALES DEL SEGUNDO APELLIDO
                            $ln2 = explode(' ', $model->lastname);
                            $result_ln2= '';
                            foreach($ln2 as $t) {
                                $result_ln2 .= $t[0] . $t[1];
                            }
                            if (strlen($result_ln2)>2) {
                                $result_ln2 = substr($result_ln2,2,2);
                            }

                            //VERIFICAR SI EXISTE USUARIO
                            $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                            $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                            if (!isset($checkuser)) {

                                //OBTENER DOS INICIALES DE CADA NOMBRE
                                $fn = explode(' ', $model->firstname);
                                $result_fn = '';
                                foreach($fn as $t) {
                                    $result_fn .= $t[0] . $t[1];
                                }
                                if (strlen($result_fn)>4) {
                                    $result_fn = substr($result_fn,0,4);
                                }

                                //OBTENER PRIMERA INICIAL DEL SEGUNDO APELLIDO
                                $ln2 = explode(' ', $model->lastname);
                                $result_ln2= '';
                                foreach($ln2 as $t) {
                                    $result_ln2 .= $t[0];
                                }
                                if (strlen($result_ln2)>1) {
                                    $result_ln2 = substr($result_ln2,1,1);
                                }

                                //VERIFICAR SI EXISTE USUARIO
                                $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                                $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                                if (!isset($checkuser)) {
                                    Yii::$app->session->setFlash('error',
                                        "Error al identificar su usuario. Por favor notifique su inconveniente en la Mesa de Ayuda");
                                }
                            }
                        }*/

                        $checkuser = \Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $model->dni);
                        $model->samaccountname = $checkuser->getAttribute('samaccountname',0);
                        $model->mail = $checkuser->getEmail();

                        $model->firstname = $adldapnewuser->nombres;
                        $model->lastname = $adldapnewuser->apellidos;
                        $model->personalmail = $adldapnewuser->email_personal;
                        $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->mobile = $adldapnewuser->celular;
                        $model->title = 'Estudiante';
                        $model->department = $adldapnewuser->carrera;
                        $model->token = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        $model->step = 5;
                        return $this->render('create_student',
                            ['model' => $model]);
                    } elseif ($adldapnewuser->status == 4) {
                        $user = \Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $model->dni);
                        $model->samaccountname = $user->getAttribute('samaccountname',0);
                        $model->mail = $user->getEmail();

                        $model->firstname = $adldapnewuser->nombres;
                        $model->lastname = $adldapnewuser->apellidos;
                        $model->personalmail = $adldapnewuser->email_personal;
                        $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->mobile = $adldapnewuser->celular;
                        $model->title = 'Estudiante';
                        $model->department = $adldapnewuser->carrera;
                        $model->token = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        $model->step = 6;
                        return $this->render('create_student',
                            ['model' => $model]);
                    }
                }
            } elseif ($model->step == 4) {
                $adldapnewuser = \app\models\AdldapNewUsers::find()
                    ->where(['dni' => $model->dni])
                    ->andWhere(['fec_nacimiento' => $model->fec_nacimiento])
                    //->orderBy('id DESC')
                    ->one();

                if (isset($adldapnewuser)) {
                    $model->firstname = $adldapnewuser->nombres;
                    $model->lastname = $adldapnewuser->apellidos;
                    $model->personalmail = $adldapnewuser->email_personal;
                    $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                    $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                    $model->mobile = $adldapnewuser->celular;
                    $model->title = 'Estudiante';
                    $model->department = $adldapnewuser->carrera;
                    $model->dn = $adldapnewuser->campus;

                    if ($adldapnewuser->status == 2) {

                        //OBTENER PRIMERA INICIAL DE CADA NOMBRE
                        $fn = explode(' ', $model->firstname);
                        $result_fn = '';
                        foreach($fn as $t) {
                            $result_fn .= $t[0];
                        }
                        if (strlen($result_fn)>2) {
                            $result_fn = substr($result_fn,0,2);
                        }

                        //OBTENER EL PRIMER APELLIDO
                        $ln = explode(' ', $model->lastname);
                        $result_ln = $ln[0];

                        //OBTENER PRIMERA INICIAL DEL SEGUNDO APELLIDO
                        $ln2 = explode(' ', $model->lastname);
                        $result_ln2= '';
                        foreach($ln2 as $t) {
                            $result_ln2 .= $t[0];
                        }
                        if (strlen($result_ln2)>1) {
                            $result_ln2 = substr($result_ln2,1,1);
                        }

                        //VERIFICAR SI EXISTE USUARIO
                        $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                        $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                        if (isset($checkuser) == 1) {

                            //OBTENER DOS INICIALES DEL SEGUNDO APELLIDO
                            $ln2 = explode(' ', $model->lastname);
                            $result_ln2= '';
                            foreach($ln2 as $t) {
                                $result_ln2 .= $t[0] . $t[1];
                            }
                            if (strlen($result_ln2)>2) {
                                $result_ln2 = substr($result_ln2,2,2);
                            }

                            //VERIFICAR SI EXISTE USUARIO
                            $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                            $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                            if (isset($checkuser) == 1) {

                                //OBTENER DOS INICIALES DE CADA NOMBRE
                                $fn = explode(' ', $model->firstname);
                                $result_fn = '';
                                foreach($fn as $t) {
                                    $result_fn .= $t[0] . $t[1];
                                }
                                if (strlen($result_fn)>4) {
                                    $result_fn = substr($result_fn,0,4);
                                }

                                //OBTENER PRIMERA INICIAL DEL SEGUNDO APELLIDO
                                $ln2 = explode(' ', $model->lastname);
                                $result_ln2= '';
                                foreach($ln2 as $t) {
                                    $result_ln2 .= $t[0];
                                }
                                if (strlen($result_ln2)>1) {
                                    $result_ln2 = substr($result_ln2,1,1);
                                }

                                //VERIFICAR SI EXISTE USUARIO
                                $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                                $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                                if (isset($checkuser) == 1) {
                                    Yii::$app->session->setFlash('error',
                                        "Error al crear el usuario. Por favor notifique su inconveniente en la Mesa de Ayuda");
                                }
                            }
                        }

                        if (!isset($checkuser)) {
                            $model->mail = $model->samaccountname . '@uea.edu.ec';

                            // https://github.com/Adldap2/Adldap2/blob/master/docs/models/model.md#saving
                            // create user
                            $user = \Yii::$app->ad->make()->user([
                                'cn' => $model->commonname,
                            ]);

                            $log = '';

                            // set attributes with set... function
                            $user->setAccountName($model->samaccountname);
                            $log = $log . 'Usuario: ' . $model->samaccountname . '. ';

                            $user->setDisplayName($model->displayname);
                            $log = $log . 'Nombre completo: ' . $model->displayname . '. ';

                            $user->setFirstName($model->firstname);
                            $log = $log . 'Nombres: ' . $model->firstname . '. ';

                            $user->setLastName($model->lastname);
                            $log = $log . 'Apellidos: ' . $model->lastname . '. ';

                            $user->setUserPrincipalName($model->mail);
                            $user->setEmail($model->mail);
                            $log = $log . 'Correo: ' . $model->mail . '. ';

                            $log = $log . 'Cédula: ' . $model->dni . '. ';
                            $log = $log . 'Correo personal: ' . $model->personalmail . '. ';
                            $log = $log . 'Celular: ' . $model->mobile . '. ';
                            $log = $log . 'Departamento: ' . $model->department . '. ';
                            $log = $log . 'Titulo: ' . $model->title . '.';

                            // create dn
                            $dn = $user->getDnBuilder();
                            $dn->addCn($user->getCommonName());
                            $dn->addOU($model->dn);
                            $dn->addOU('ESTUDIANTES');
                            $user->setDn($dn);
                            //
                            $user->setTitle($model->title);
                            $security = new Security();
                            $user->setPassword($security->generateRandomString(8));
                            $user->setAttribute(Yii::$app->params['dni'],$model->dni);
                            $user->setAttribute(Yii::$app->params['personalmail'],$model->personalmail);
                            $user->setEmail($model->mail);

                            // CREAR USUARIO
                            if ($user->save()) {
                                //VERIFICAR QUE LA CUENTA HA SIDO CREADA
                                $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                                if (isset($checkuser) == 1) {

                                    //Crear Registro de Log en la base de datos
                                    $description =
                                        'Usuario creado. ' . $log
                                    ;
                                    $this->saveLog('adldapCreateUser', $model->samaccountname, $description, $model->samaccountname,'adldap');

                                    $adldapnewuser->status = 3;
                                    $adldapnewuser->save(false);
                                    $model->step = 5;
                                    return $this->render('create_student',
                                        ['model' => $model]);
                                } else {
                                    $model->step = 4;
                                    return $this->render('create_student',
                                        ['model' => $model]);
                                }
                            }
                        }
                    } elseif ($adldapnewuser->status == 3) {

                        /*//OBTENER PRIMERA INICIAL DE CADA NOMBRE
                        $fn = explode(' ', $model->firstname);
                        $result_fn = '';
                        foreach($fn as $t) {
                            $result_fn .= $t[0];
                        }
                        if (strlen($result_fn)>2) {
                            $result_fn = substr($result_fn,0,2);
                        }

                        //OBTENER EL PRIMER APELLIDO
                        $ln = explode(' ', $model->lastname);
                        $result_ln = $ln[0];

                        //OBTENER PRIMERA INICIAL DEL SEGUNDO APELLIDO
                        $ln2 = explode(' ', $model->lastname);
                        $result_ln2= '';
                        foreach($ln2 as $t) {
                            $result_ln2 .= $t[0];
                        }
                        if (strlen($result_ln2)>1) {
                            $result_ln2 = substr($result_ln2,1,1);
                        }

                        //VERIFICAR SI EXISTE USUARIO
                        $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                        $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                        if (!isset($checkuser)) {

                            //OBTENER DOS INICIALES DEL SEGUNDO APELLIDO
                            $ln2 = explode(' ', $model->lastname);
                            $result_ln2= '';
                            foreach($ln2 as $t) {
                                $result_ln2 .= $t[0] . $t[1];
                            }
                            if (strlen($result_ln2)>2) {
                                $result_ln2 = substr($result_ln2,2,2);
                            }

                            //VERIFICAR SI EXISTE USUARIO
                            $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                            $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                            if (!isset($checkuser)) {

                                //OBTENER DOS INICIALES DE CADA NOMBRE
                                $fn = explode(' ', $model->firstname);
                                $result_fn = '';
                                foreach($fn as $t) {
                                    $result_fn .= $t[0] . $t[1];
                                }
                                if (strlen($result_fn)>4) {
                                    $result_fn = substr($result_fn,0,4);
                                }

                                //OBTENER PRIMERA INICIAL DEL SEGUNDO APELLIDO
                                $ln2 = explode(' ', $model->lastname);
                                $result_ln2= '';
                                foreach($ln2 as $t) {
                                    $result_ln2 .= $t[0];
                                }
                                if (strlen($result_ln2)>1) {
                                    $result_ln2 = substr($result_ln2,1,1);
                                }

                                //VERIFICAR SI EXISTE USUARIO
                                $model->samaccountname = strtolower($result_fn . '.' . $result_ln . $result_ln2);
                                $checkuser = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                                if (!isset($checkuser)) {
                                    Yii::$app->session->setFlash('error',
                                        "Error al identificar su usuario. Por favor notifique su inconveniente en la Mesa de Ayuda");
                                }
                            }
                        }*/

                        $checkuser = \Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $model->dni);
                        $model->samaccountname = $checkuser->getAttribute('samaccountname',0);
                        $model->mail = $checkuser->getEmail();

                        $model->firstname = $adldapnewuser->nombres;
                        $model->lastname = $adldapnewuser->apellidos;
                        $model->personalmail = $adldapnewuser->email_personal;
                        $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->mobile = $adldapnewuser->celular;
                        $model->title = 'Estudiante';
                        $model->department = $adldapnewuser->carrera;
                        $model->token = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        $model->step = 5;
                        return $this->render('create_student',
                            ['model' => $model]);
                    } elseif ($adldapnewuser->status == 4) {
                        $user = \Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $model->dni);
                        $model->samaccountname = $user->getAttribute('samaccountname',0);
                        $model->mail = $user->getEmail();

                        $model->firstname = $adldapnewuser->nombres;
                        $model->lastname = $adldapnewuser->apellidos;
                        $model->personalmail = $adldapnewuser->email_personal;
                        $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->mobile = $adldapnewuser->celular;
                        $model->title = 'Estudiante';
                        $model->department = $adldapnewuser->carrera;
                        $model->token = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        $model->step = 6;
                        return $this->render('create_student',
                            ['model' => $model]);
                    }
                }
            } elseif ($model->step == 5) {
                $adldapnewuser = \app\models\AdldapNewUsers::find()
                    ->where(['dni' => $model->dni])
                    ->andWhere(['fec_nacimiento' => $model->fec_nacimiento])
                    //->orderBy('id DESC')
                    ->one();

                if (isset($adldapnewuser)) {
                    $model->firstname = $adldapnewuser->nombres;
                    $model->lastname = $adldapnewuser->apellidos;
                    $model->personalmail = $adldapnewuser->email_personal;
                    $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                    $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                    $model->mobile = $adldapnewuser->celular;
                    $model->title = 'Estudiante';
                    $model->department = $adldapnewuser->carrera;
                    $model->dn = $adldapnewuser->campus;
                    $model->uac = 512;

                    if ($adldapnewuser->status == 3) {

                        if ($model->newPassword == $model->verifyNewPassword) {

                            $explode_commonname = explode(" ", $model->commonname);
                            $similar = false;
                            foreach ($explode_commonname as $name) {
                                $incluye = stripos($model->newPassword, $name);
                                if ($incluye !== false) {
                                    $similar = true;
                                }
                            }

                            $incluye = stripos($model->newPassword, $model->samaccountname);
                            if ($incluye !== false) {
                                $similar = true;
                            }

                            if ($similar == false) {
                                //Actualizar contraseña
                                $user = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);
                                $user->setPassword($model->newPassword);

                                //Actualizar datos personales de la cuenta institucional
                                $user->setTitle($model->title);
                                $user->setAttribute(Yii::$app->params['dni'],$model->dni);
                                $user->setAttribute(Yii::$app->params['personalmail'],$model->personalmail);
                                $user->setAttribute(Yii::$app->params['mobile'],$model->mobile);
                                $user->setUserAccountControl($model->uac);
                                $user->setDepartment($model->department);
                                $user->setTitle($model->title);
                                $user->setEmail($model->mail);

                                //Guardar cambios
                                $user->save();

                                // Agregar licencias para estudiantes
                                $groupNames = $user->getGroupNames($recursive = true);
                                if (count($groupNames)>1) {
                                    $existGroup = '';
                                    foreach ($groupNames as $groupName) {
                                        if ($groupName == 'Microsoft 365 Apps para Estudiantes') {
                                            $existGroup = 'SI';
                                        }
                                    }
                                    if ($existGroup != 'SI') {
                                        $groupObject = \Yii::$app->ad->search()->findBy('cn', 'Microsoft 365 Apps para Estudiantes');
                                        $user->addGroup($groupObject);
                                    }
                                    $existGroup = '';
                                    foreach ($groupNames as $groupName) {
                                        if ($groupName == 'Power BI (free)') {
                                            $existGroup = 'SI';
                                        }
                                    }
                                    if ($existGroup != 'SI') {
                                        $groupObject = \Yii::$app->ad->search()->findBy('cn', 'Power BI (free)');
                                        $user->addGroup($groupObject);
                                    }
                                    $existGroup = '';
                                    foreach ($groupNames as $groupName) {
                                        if ($groupName == 'Office 365 A1 para Estudiantes') {
                                            $existGroup = 'SI';
                                        }
                                    }
                                    if ($existGroup != 'SI') {
                                        $groupObject = \Yii::$app->ad->search()->findBy('cn', 'Office 365 A1 para Estudiantes');
                                        $user->addGroup($groupObject);
                                    }
                                    $existGroup = '';
                                    foreach ($groupNames as $groupName) {
                                        if ($groupName == 'estudiantes') {
                                            $existGroup = 'SI';
                                        }
                                    }
                                    if ($existGroup != 'SI') {
                                        $groupObject = \Yii::$app->ad->search()->findBy('cn', 'estudiantes');
                                        $user->addGroup($groupObject);
                                    }
                                    $existGroup = '';
                                    foreach ($groupNames as $groupName) {
                                        if ($groupName == '3gm4v0hkup5dx55') {
                                            $existGroup = 'SI';
                                        }
                                    }
                                    if ($existGroup != 'SI') {
                                        $groupObject = \Yii::$app->ad->search()->findBy('cn', '3gm4v0hkup5dx55');
                                        $user->addGroup($groupObject);
                                    }
                                    if ($adldapnewuser->campus == 'PUYO') {
                                        $existGroup = '';
                                        foreach ($groupNames as $groupName) {
                                            if ($groupName == 'pnnfxlrnu8mux5w') {
                                                $existGroup = 'SI';
                                            }
                                        }
                                        if ($existGroup != 'SI') {
                                            $groupObject = \Yii::$app->ad->search()->findBy('cn', 'pnnfxlrnu8mux5w');
                                            $user->addGroup($groupObject);
                                        }
                                    }
                                    if ($adldapnewuser->campus == 'LAGO AGRIO') {
                                        $existGroup = '';
                                        foreach ($groupNames as $groupName) {
                                            if ($groupName == 'djga0oexs3jesqu') {
                                                $existGroup = 'SI';
                                            }
                                        }
                                        if ($existGroup != 'SI') {
                                            $groupObject = \Yii::$app->ad->search()->findBy('cn', 'djga0oexs3jesqu');
                                            $user->addGroup($groupObject);
                                        }
                                    }
                                    if ($adldapnewuser->campus == 'PANGUI') {
                                        $existGroup = '';
                                        foreach ($groupNames as $groupName) {
                                            if ($groupName == 'ohgs7tioixj8dr4') {
                                                $existGroup = 'SI';
                                            }
                                        }
                                        if ($existGroup != 'SI') {
                                            $groupObject = \Yii::$app->ad->search()->findBy('cn', 'ohgs7tioixj8dr4');
                                            $user->addGroup($groupObject);
                                        }
                                    }
                                } else {
                                    $groupObject = \Yii::$app->ad->search()->findBy('cn', 'Microsoft 365 Apps para Estudiantes');
                                    $user->addGroup($groupObject);
                                    $groupObject = \Yii::$app->ad->search()->findBy('cn', 'Power BI (free)');
                                    $user->addGroup($groupObject);
                                    $groupObject = \Yii::$app->ad->search()->findBy('cn', 'Office 365 A1 para Estudiantes');
                                    $user->addGroup($groupObject);
                                    $groupObject = \Yii::$app->ad->search()->findBy('cn', 'estudiantes');
                                    $user->addGroup($groupObject);
                                    $groupObject = \Yii::$app->ad->search()->findBy('cn', '3gm4v0hkup5dx55');
                                    $user->addGroup($groupObject);
                                    if ($adldapnewuser->campus == 'PUYO') {
                                        $groupObject = \Yii::$app->ad->search()->findBy('cn', 'pnnfxlrnu8mux5w');
                                        $user->addGroup($groupObject);
                                    }
                                    if ($adldapnewuser->campus == 'LAGO AGRIO') {
                                        $groupObject = \Yii::$app->ad->search()->findBy('cn', 'djga0oexs3jesqu');
                                        $user->addGroup($groupObject);
                                    }
                                    if ($adldapnewuser->campus == 'PANGUI') {
                                        $groupObject = \Yii::$app->ad->search()->findBy('cn', 'ohgs7tioixj8dr4');
                                        $user->addGroup($groupObject);
                                    }
                                }

                                //Crear Registro de Log en la base de datos
                                $description =
                                    'Cambio correcto de contraseña del usuario: ' . $model->samaccountname
                                ;
                                $this->saveLog('resetPasswordToken', $model->samaccountname, $description, $model->samaccountname,'adldap');

                                //Actualizar datos en SIAD Nivelacion
                                $estudianteNivelacion = \app\models\EstudiantesNivelacion::find()
                                    ->where(['CIInfPer' => $model->dni])
                                    ->orWhere(['cedula_pasaporte' => $model->dni])
                                    ->one();
                                if (isset($estudianteNivelacion)) {
                                    $estudianteNivelacion->FechNacimPer = $model->fec_nacimiento;
                                    $estudianteNivelacion->CelularInfPer = $model->mobile;
                                    $estudianteNivelacion->mailPer = $model->personalmail;
                                    $estudianteNivelacion->mailInst = $model->mail;
                                    $estudianteNivelacion->statusper = 1;
                                    $estudianteNivelacion->save(false);
                                }

                                //Actualizar datos en SIAD Pregrado
                                $estudiantePregrado = \app\models\Estudiantes::find()
                                    ->where(['CIInfPer' => $model->dni])
                                    ->orWhere(['cedula_pasaporte' => $model->dni])
                                    ->one();
                                if (isset($estudiantePregrado)) {
                                    $estudiantePregrado->FechNacimPer = $model->fec_nacimiento;
                                    $estudiantePregrado->CelularInfPer = $model->mobile;
                                    $estudiantePregrado->mailPer = $model->personalmail;
                                    $estudiantePregrado->mailInst = $model->mail;
                                    $estudiantePregrado->statusper = 1;
                                    $estudiantePregrado->save(false);
                                }

                                //Enviar usuario creado por email
                                $dni = $model->dni;
                                $fullname = $model->commonname;
                                $mail = $model->mail;
                                $personalmail = $model->personalmail;

                                $this->sendNewStudent($dni,$fullname,$mail,$personalmail);

                                Yii::$app->session->setFlash('successReset');

                                $adldapnewuser->status = 4;
                                $adldapnewuser->save(false);
                                $model->step = 6;
                                return $this->render('create_student',
                                    ['model'=>$model]);

                            } else {
                                Yii::$app->session->setFlash('errorReset',
                                    'NO utilice sus NOMBRES, APELLIDOS y/o NOMBRE DE USUARIO en la nueva contraseña');

                                $model->step = 5;
                                return $this->render('create_student',
                                    ['model'=>$model]);
                            }

                        } else {
                            Yii::$app->session->setFlash('errorReset',
                                'Las contraseñas no coinciden. Vuelva a escribir su contraseña');

                            $model->step = 5;
                            return $this->render('create_student',
                                ['model'=>$model]);
                        }

                    } elseif ($adldapnewuser->status == 4) {
                        $user = \Yii::$app->ad->search()->findBy(Yii::$app->params['dni'], $model->dni);
                        $model->samaccountname = $user->getAttribute('samaccountname',0);
                        $model->mail = $user->getEmail();

                        $model->firstname = $adldapnewuser->nombres;
                        $model->lastname = $adldapnewuser->apellidos;
                        $model->personalmail = $adldapnewuser->email_personal;
                        $model->commonname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->displayname = $adldapnewuser->apellidos . ' ' . $adldapnewuser->nombres;
                        $model->mobile = $adldapnewuser->celular;
                        $model->title = 'Estudiante';
                        $model->department = $adldapnewuser->carrera;
                        $model->token = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);
                        $model->step = 6;
                        return $this->render('create_student',
                            ['model' => $model]);
                    }
                }
            }
        }

        $model->step = 1;
        return $this->render('create_student',
            ['model'=>$model]);
    }


    public function actionEdituser()
    {

        $model = new AdldapEditForm();

        if (Yii::$app->request->post('searchButton')==='searchButton'
            and (Yii::$app->session->get('authtype') == 'adldap')) {
            $post_data = $_POST['AdldapEditForm'];
            if ($post_data['search'] != '') {
                return $this->redirect(
                    'index.php?r=adldap/edituser&search='
                    . $post_data['search']);
            } else {
                Yii::$app->session->setFlash('error',
                    "Buscar no puede estar en blanco");
                return $this->render('edit_user',
                    ['model'=>$model]);
            }

        }

        if (isset($_GET['search'])
            and (Yii::$app->session->get('authtype') == 'adldap')) {
            $search = $_GET['search'];
            if (isset($_GET['samaccountname'])) {
                $samaccountname = $_GET['samaccountname'];
                $user = Yii::$app->ad->getProvider('default')->search()
                    ->whereEquals('samaccountname', $samaccountname)
                    ->first();
            } else {
                $user = Yii::$app->ad->getProvider('default')->search()->users()
                    ->find($search);
                $users = Yii::$app->ad->getProvider('default')->search()->users()
                    ->orWhereContains('samaccountname', $search)
                    ->orWhereContains('cn', $search)
                    ->orWhereEquals(Yii::$app->params['dni'], $search)
                    ->sortBy('samaccountname', 'asc')
                    ->get();
            }

            if (isset($user)) {
                $sAMAccountname = $user->getAttribute('samaccountname',0);
                $model->dni = $user->getAttribute(Yii::$app->params['dni'],0);
                $model->firstname = $user->getFirstName();
                $model->lastname = $user->getLastName();
                $model->mail = $user->getEmail();
                $model->commonname = $user->getAttribute('cn',0);
                $model->displayname = $user->getDisplayName();
                $model->personalmail = $user->getAttribute(Yii::$app->params['personalmail'],0);
                $model->mobile = $user->getAttribute(Yii::$app->params['mobile'],0);
                $model->groups = $user->getGroups();
                $model->dn = $user->getDn();
                $model->uac = $user->getUserAccountControl();
                $model->department = $user->getDepartment();
                $model->title = $user->getTitle();
                $model->samaccountname = $user->getAttribute('samaccountname',0);

                if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                    if (Yii::$app->request->post('sendToken')==='sendToken') {

                        //Crear un Reset TOKEN
                        $resetToken = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->mail);

                        //Enviar Reset TOKEN por email
                        $this->sendToken($model->dni,$model->commonname,$model->mail,$model->personalmail,$resetToken);

                        //Crear Registro de Log en la base de datos
                        $description =
                            'Envío de Token para el usuario: ' . $sAMAccountname
                            . ', al correo electrónico personal: ' . $model->personalmail
                        ;
                        $this->saveLog('sendToken', Yii::$app->user->identity->username, $description, $sAMAccountname,'adldap');

                        //Mensaje de email enviado
                        Yii::$app->session->setFlash('successMail', $model->personalmail);

                        return $this->render('edit_user',
                            ['model'=>$model]);
                    }

                    if (Yii::$app->request->post('sendActivate')==='sendActivate') {

                        //Enviar un mensaje de Bienvenida
                        $this->sendNewUser($model->dni,$model->commonname,$model->mail,$model->personalmail);

                        //Crear Registro de Log en la base de datos
                        $description =
                            'Envío de mensaje de Activación para el usuario: ' . $sAMAccountname
                            . ', al correo electrónico personal: ' . $model->personalmail
                        ;
                        $this->saveLog('sendActivate', Yii::$app->user->identity->username, $description, $sAMAccountname,'adldap');

                        //Mensaje de email enviado
                        Yii::$app->session->setFlash('successActivateMail', $model->personalmail);

                        return $this->render('edit_user',
                            ['model'=>$model]);
                    }

                    if (Yii::$app->request->post('submit')==='submit') {
                        $log = '';
                        if ($model->dni != $user->getAttribute(Yii::$app->params['dni'],0)) {
                            $log = $log . 'Cédula: ' . $user->getAttribute(Yii::$app->params['dni'],0)
                                . ' -> ' . $model->dni . '. ';
                        }
                        if ($model->lastname != $user->getLastName()) {
                            $log = $log . 'Apellidos: ' . $user->getLastName()
                                . ' -> ' . $model->lastname . '. ';
                        }
                        if ($model->firstname != $user->getFirstName()) {
                            $log = $log . 'Nombres: ' . $user->getFirstName()
                                . ' -> ' . $model->firstname . '. ';
                        }
                        if ($model->commonname != $user->getAttribute('cn',0)) {
                            $log = $log . 'Nombre Completo: ' . $user->getAttribute('cn',0)
                                . ' -> ' . $model->commonname . '. ';
                        }
                        if ($model->displayname != $user->getDisplayName()) {
                            $log = $log . 'Nombre para mostrar: ' . $user->getDisplayName()
                                . ' -> ' . $model->displayname . '. ';
                        }
                        if ($model->mail != $user->getEmail()) {
                            $log = $log . 'Correo institucional: ' . $user->getEmail()
                                . ' -> ' . $model->mail . '. ';
                        }
                        if ($model->personalmail != $user->getAttribute(Yii::$app->params['personalmail'], 0)) {
                            $log = $log . 'Correo personal: ' . $user->getAttribute(Yii::$app->params['personalmail'], 0)
                                . ' -> ' . $model->personalmail . '. ';
                        }
                        if ($model->mobile != $user->getAttribute(Yii::$app->params['mobile'], 0)) {
                            $log = $log . 'Celular: ' . $user->getAttribute(Yii::$app->params['mobile'], 0)
                                . ' -> ' . $model->mobile . '. ';
                        }
                        if ($model->title != $user->getTitle()) {
                            $log = $log . 'Puesto: ' . $user->getTitle()
                                . ' -> ' . $model->title . '. ';
                        }
                        if ($model->department != $user->getDepartment()) {
                            $log = $log . 'Departamento: ' . $user->getDepartment()
                                . ' -> ' . $model->department . '. ';
                        }

                        //Más códigos UAC cuentas Active Directory
                        //https://jackstromberg.com/2013/01/useraccountcontrol-attributeflag-values/
                        //https://social.technet.microsoft.com/Forums/en-US/69211f96-b17e-43aa-9a6a-4f8e99ae2b3a/useraccountcontrol-and-employeestatus?forum=ilm2

                        if ($model->uac != $user->getUserAccountControl()) {
                            if ($user->getUserAccountControl() == '512') {
                                $statusUser = 'Cuenta activada';
                            } elseif ($user->getUserAccountControl() == '514') {
                                $statusUser = 'Cuenta desactivada';
                            } elseif ($user->getUserAccountControl() == '66048') {
                                $statusUser = 'Cuenta activada. Contraseña nunca expira';
                            } elseif ($user->getUserAccountControl() == '66050') {
                                $statusUser = 'Cuenta desactivada. Contraseña nunca expira';
                            } else {
                                $statusUser = $user->getUserAccountControl();

                            }if ($model->uac == '512') {
                                $statusModel = 'Cuenta activada';
                            } elseif ($model->uac == '514') {
                                $statusModel = 'Cuenta desactivada';
                            } elseif ($model->uac == '66048') {
                                $statusModel = 'Cuenta activada. Contraseña nunca expira';
                            } elseif ($model->uac == '66050') {
                                $statusModel = 'Cuenta desactivada. Contraseña nunca expira';
                            } else {
                                $statusModel = $model->uac;
                            }
                            $log = $log . 'Estado: ' . $statusUser
                                . ' -> ' . $statusModel . '. ';
                        }

                        $user->setAttribute(Yii::$app->params['dni'],$model->dni);
                        $user->setFirstName($model->firstname);
                        $user->setLastName($model->lastname);
                        //$user->setEmail($model->mail);
                        //$user->setCommonName($model->commonname);
                        $user->setDisplayName($model->displayname);
                        $user->setAttribute(Yii::$app->params['personalmail'],$model->personalmail);
                        $user->setAttribute(Yii::$app->params['mobile'],$model->mobile);
                        $user->setUserAccountControl($model->uac);
                        $user->setDepartment($model->department);
                        $user->setTitle($model->title);

                        if ($user->save()) {
                            Yii::$app->session->setFlash('success', "Actualizado Correctamente");
                            $username = Yii::$app->user->identity->username;

                            //Crear Registro de Log en la base de datos
                            $description =
                                'Información actualizada del usuario: ' . $sAMAccountname
                                . '. ' . $log
                            ;
                            $this->saveLog('adldapEditUser', $username, $description, $sAMAccountname,'adldap');

                            return $this->render('edit_user',
                                ['model'=>$model]);
                        } else {
                            Yii::$app->session->setFlash('error', "Problemas de Actualización");
                            return $this->render('edit_user',
                                ['model'=>$model]);
                        }
                    }


                    if (Yii::$app->request->post('addGroup')==='addGroup') {

                        // https://github.com/Adldap2/Adldap2/blob/master/docs/models/traits/has-member-of.md#adding-a-group
                        // find user
                        $userObject = \Yii::$app->ad->search()->findBy('sAMAccountname', $sAMAccountname);

                        $groupNames = $userObject->getGroupNames($recursive = true);
                        $existGroup = '';
                        foreach ($groupNames as $groupName) {
                            if ($groupName == $model->addGroup) {
                                $existGroup = 'SI';
                            }
                        }

                        if ($existGroup != 'SI') {
                            // find group
                            $groupObject = \Yii::$app->ad->search()->findBy('cn', $model->addGroup);
                            // add group to user
                            $userObject->addGroup($groupObject);

                            if ($groupObject != null && $groupObject->exists && $userObject->save()) {

                                //Crear Registro de Log en la base de datos
                                $description =
                                    'Grupo agregado: ' . $model->addGroup
                                ;
                                $this->saveLog('addGroup', Yii::$app->user->identity->username, $description, $sAMAccountname,'adldap');

                                //Mensaje de grupo eliminado
                                Yii::$app->session->setFlash('success', 'Grupo agregado correctamente');

                                $user = \Yii::$app->ad->search()->findBy('sAMAccountname', $sAMAccountname);
                                $model->groups = $user->getGroups();
                                $model->addGroup = '';
                                $model->deleteGroup = '';

                            } else {
                                //Mensaje de grupo eliminado
                                Yii::$app->session->setFlash('error', 'Error al agregar grupo');
                            }
                        }
                        return $this->render('edit_user',
                            ['model'=>$model]);
                    }


                    if (Yii::$app->request->post('deleteGroup')==='deleteGroup') {

                        // https://github.com/Adldap2/Adldap2/blob/master/docs/models/traits/has-member-of.md#adding-a-group
                        // find user
                        $userObject = \Yii::$app->ad->search()->findBy('sAMAccountname', $sAMAccountname);
                        // find group
                        $groupObject = \Yii::$app->ad->search()->findBy('cn', $model->deleteGroup);
                        // delete group to user
                        $userObject->removeGroup($groupObject);

                        if ($groupObject != null && $groupObject->exists && $userObject->save()) {

                            //Crear Registro de Log en la base de datos
                            $description =
                                'Grupo eliminado: ' . $model->deleteGroup
                            ;
                            $this->saveLog('deleteGroup', Yii::$app->user->identity->username, $description, $sAMAccountname,'adldap');

                            //Mensaje de grupo eliminado
                            Yii::$app->session->setFlash('success', 'Grupo eliminado correctamente');

                            $user = \Yii::$app->ad->search()->findBy('sAMAccountname', $sAMAccountname);
                            $model->groups = $user->getGroups();
                            $model->addGroup = '';
                            $model->deleteGroup = '';

                        } else {
                            //Mensaje de grupo eliminado
                            Yii::$app->session->setFlash('error', 'Error al eliminar grupo');
                        }

                        return $this->render('edit_user',
                            ['model'=>$model]);
                    }

                } else {
                    if ((isset($users)) and (count($users)>1)) {
                        return $this->render('edit_user',
                            [
                                'model'=>$model,
                                'users'=>$users
                            ]);
                    } else {
                        return $this->render('edit_user',
                            ['model'=>$model]);
                    }
                }
            } else {
                Yii::$app->session->setFlash('error',
                    "No se encontraron resultados");
                return $this->render('edit_user',
                    ['model'=>$model]);
            }
        }
        return $this->render('edit_user',
            ['model'=>$model]);
    }


    public function actionViewgroups()
    {

        $model = new AdldapGroupForm();

        if (Yii::$app->request->post('searchButton')==='searchButton'
            and (Yii::$app->session->get('authtype') == 'adldap')) {
            $post_data = $_POST['AdldapGroupForm'];
            if ($post_data['search'] != '') {
                return $this->redirect(
                    'index.php?r=adldap/viewgroups&search='
                    . $post_data['search']);
            } else {
                Yii::$app->session->setFlash('error',
                    "Buscar no puede estar en blanco");
                return $this->render('view_groups',
                    ['model'=>$model]);
            }

        }

        if (isset($_GET['search'])
            and (Yii::$app->session->get('authtype') == 'adldap')) {
            $search = $_GET['search'];

            // find group
            $groupObject = \Yii::$app->ad->search()->findBy('cn', $search);

            if ($groupObject != null && $groupObject->exists) {
                $model->name = $groupObject->getName();
                $model->dn = $groupObject->getDN();
                $model->groupType = $groupObject->getGroupType();
                $model->members = $groupObject->getMembers();
            }

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if (Yii::$app->request->post('deleteMember') === 'deleteMember') {

                    // find group
                    $groupObject = \Yii::$app->ad->search()->findBy('cn', $model->name);

                    if ($groupObject->removeMember($model->deleteMember)) {

                        //Crear Registro de Log en la base de datos
                        $description =
                            'Miembro eliminado: ' . $model->deleteMember;
                        $this->saveLog('deleteMember', Yii::$app->user->identity->username, $description, $model->name, 'adldapGroup');

                        //Mensaje de grupo eliminado
                        Yii::$app->session->setFlash('success', 'Miembro eliminado correctamente');

                        $groupObject = \Yii::$app->ad->search()->findBy('cn', $model->name);
                        $model->members = $groupObject->getMembers();
                        $model->deleteMember = '';

                    } else {
                        //Mensaje de grupo eliminado
                        Yii::$app->session->setFlash('error', 'Error al eliminar miembro');
                    }

                    return $this->render('view_groups',
                        ['model' => $model]);
                }
            }

            return $this->render('view_groups',
                ['model'=>$model]);

        }
        return $this->render('view_groups',
            ['model'=>$model]);
    }


    public function actionViewuser()
    {

        $model = new AdldapEditForm();

        if (Yii::$app->request->post('searchButton')==='searchButton'
            and (Yii::$app->session->get('authtype') == 'adldap')) {
            $post_data = $_POST['AdldapEditForm'];
            if ($post_data['search'] != '') {
                return $this->redirect(
                    'index.php?r=adldap/viewuser&search='
                    . $post_data['search']);
            } else {
                Yii::$app->session->setFlash('error',
                    "Buscar no puede estar en blanco");
                return $this->render('view_user',
                    ['model'=>$model]);
            }

        }

        if (isset($_GET['search'])
            and (Yii::$app->session->get('authtype') == 'adldap')) {
            $search = $_GET['search'];

            if (isset($_GET['samaccountname'])) {
                $samaccountname = $_GET['samaccountname'];
                $user = Yii::$app->ad->getProvider('default')->search()
                    ->whereEquals('samaccountname', $samaccountname)
                    ->first();
            } else {
                $user = Yii::$app->ad->getProvider('default')->search()->users()
                    ->find($search);
                $users = Yii::$app->ad->getProvider('default')->search()->users()
                    ->orWhereContains('samaccountname', $search)
                    ->orWhereContains('cn', $search)
                    ->orWhereEquals(Yii::$app->params['dni'], $search)
                    ->sortBy('samaccountname', 'asc')
                    ->get();
            }

            if (isset($user)) {
                $sAMAccountname = $user->getAttribute('samaccountname',0);
                $model->dni = $user->getAttribute(Yii::$app->params['dni'],0);
                $model->firstname = $user->getFirstName();
                $model->lastname = $user->getLastName();
                $model->mail = $user->getEmail();
                $model->commonname = $user->getAttribute('cn',0);
                $model->displayname = $user->getDisplayName();
                $model->personalmail = $user->getAttribute(Yii::$app->params['personalmail'], 0);
                $model->mobile = $user->getAttribute(Yii::$app->params['mobile'], 0);
                $model->groups = $user->getGroups();
                $model->dn = $user->getDn();
                $model->uac = $user->getUserAccountControl();
                $model->title = $user->getTitle();
                $model->department = $user->getDepartment();

                if (Yii::$app->request->post() && $model->validate()) {
                    if (Yii::$app->request->post('sendToken')==='sendToken') {

                        //Crear un Reset TOKEN
                        $resetToken = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->mail);

                        //Enviar Reset TOKEN por email
                        $this->sendToken($model->dni,$model->commonname,$model->mail,$model->personalmail,$resetToken);

                        //Crear Registro de Log en la base de datos
                        $description =
                            'Envío de Token para el usuario: ' . $sAMAccountname
                            . ', al correo electrónico personal: ' . $model->personalmail
                        ;
                        $this->saveLog('sendToken', Yii::$app->user->identity->username, $description, $sAMAccountname,'adldap');

                        //Mensaje de email enviado
                        Yii::$app->session->setFlash('successMail', $model->personalmail);

                        return $this->render('view_user',
                            ['model'=>$model]);
                    }

                    if (Yii::$app->request->post('sendActivate')==='sendActivate') {

                        //Enviar un mensaje de Bienvenida
                        $this->sendNewUser($model->dni,$model->commonname,$model->mail,$model->personalmail);

                        //Crear Registro de Log en la base de datos
                        $description =
                            'Envío de mensaje de Activación para el usuario: ' . $sAMAccountname
                            . ', al correo electrónico personal: ' . $model->personalmail
                        ;
                        $this->saveLog('sendActivate', Yii::$app->user->identity->username, $description, $sAMAccountname,'adldap');

                        //Mensaje de email enviado
                        Yii::$app->session->setFlash('successActivateMail', $model->personalmail);

                        return $this->render('view_user',
                            ['model'=>$model]);
                    }

                }  else {

                    if ((isset($users)) and (count($users)>1)) {
                        return $this->render('view_user',
                            [
                                'model'=>$model,
                                'users'=>$users
                            ]);
                    } else {
                        return $this->render('view_user',
                            ['model'=>$model]);
                    }
                }
            } else {
                Yii::$app->session->setFlash('error',
                    "No se encontraron resultados");
                return $this->render('view_user',
                    ['model'=>$model]);
            }
        }
        return $this->render('view_user',
            ['model'=>$model]);
    }


    public function actionProfile()
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
            $model->groups = $user->getGroups();
            $model->dn = $user->getDn();
            $model->uac = $user->getUserAccountControl();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $log = '';
                if ($model->personalmail != $user->getAttribute(Yii::$app->params['personalmail'], 0)) {
                    $log = $log . 'Correo personal: ' . $user->getAttribute(Yii::$app->params['personalmail'], 0)
                        . ' -> ' . $model->personalmail . '. ';
                }
                if ($model->mobile != $user->getAttribute(Yii::$app->params['mobile'], 0)) {
                    $log = $log . 'Celular: ' . $user->getAttribute(Yii::$app->params['mobile'], 0)
                        . ' -> ' . $model->mobile . '. ';
                }

                $user->setAttribute(Yii::$app->params['personalmail'],$model->personalmail);
                $user->setAttribute(Yii::$app->params['mobile'],$model->mobile);
                if ($user->save()){

                    Yii::$app->session->setFlash('success', "Actualizado Correctamente");
                    $username = Yii::$app->user->identity->username;

                    //Crear Registro de Log en la base de datos
                    $description =
                        'Información actualizada del usuario: ' . $sAMAccountname
                        . '. ' . $log
                    ;
                    $this->saveLog('adldapEditProfile', $username, $description, $sAMAccountname, 'adldap');

                    return $this->render('profile',
                        ['model' => $model]);
                } else {
                    Yii::$app->session->setFlash('error', "Problemas de Actualización");
                    return $this->render('profile',
                        ['model'=>$model]);
                }

            } else {
                return $this->render('profile',
                    ['model'=>$model]);
            }
        } else {
            return $this->redirect('index.php?r=site/identity');
        }
    }


    public function actionForgetpass()
    {
        $model = new AdldapForgetpassForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $post_form = Yii::$app->request->post('AdldapForgetpassForm');
            $post_mail = strtolower($post_form['mail']);
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

                if (Yii::$app->request->post('sendToken')==='sendToken') {

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
                    $this->saveLog('sendToken', $sAMAccountname, $description, $sAMAccountname,'adldap');

                    //Mensaje de email enviado
                    Yii::$app->session->setFlash('successMail', $personalmail);

                    return $this->render('forgetpass', [
                        'model'=>$model]); //Success
                }

                if (($post_mail == $mail) and ($post_dni == $dni)) {

                    $model->dni = $dni;
                    $model->commonname = $fullname;
                    $model->mail = $mail;
                    $model->personalmail = $personalmail;

                    Yii::$app->session->setFlash('personalmail', $model->personalmail);

                    return $this->render('forgetpass', [
                        'model'=>$model]); //Success

                }

                //
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


    public function actionEditemail()
    {
        $model = new AdldapEditemailForm();
        if ($model->load(Yii::$app->request->post())) {

            if ($model->step == 1) {
                $post_form = Yii::$app->request->post('AdldapEditemailForm');
                $post_mail = strtolower($post_form['mail']);
                $post_dni = $post_form['dni'];
                $post_sAMAccountname = explode("@", $post_mail);
                $sAMAccountname = $post_sAMAccountname[0];

                $user = Yii::$app->ad->getProvider('default')->search()
                    ->findBy('sAMAccountname', $sAMAccountname);

                if (isset($user)) {
                    $estudiante_nivelacion = \app\models\EstudiantesNivelacion::find()
                        ->where(['cedula_pasaporte' => $post_dni])
                        ->one();
                    if (isset($estudiante_nivelacion)) {
                        $fec_nacimiento = $estudiante_nivelacion->FechNacimPer;
                    }

                    $estudiante_pregrado = \app\models\Estudiantes::find()
                        ->where(['cedula_pasaporte' => $post_dni])
                        ->one();
                    if (isset($estudiante_pregrado)) {
                        $fec_nacimiento = $estudiante_pregrado->FechNacimPer;
                    }

                    if (isset($fec_nacimiento)) {
                        if ($fec_nacimiento == $model->fec_nacimiento) {
                            $model->personalmail = $user->getAttribute(Yii::$app->params['personalmail'],0);
                            $model->step = 2;
                            return $this->render('edit_email', [
                                'model' => $model,
                            ]);
                        }
                    }

                    Yii::$app->session->setFlash('errorFecha','Fecha de nacimiento incorrecta o usted no consta en las bases de datos de estudiantes de Pregrado o Nivelación');
                    $model->step = 1;
                    return $this->render('edit_email', [
                        'model' => $model,
                    ]);

                } else {
                    Yii::$app->session->setFlash('errorUser','Cédula, Pasaporte o Correo institucional incorrecto');
                    $model->step = 1;
                    return $this->render('edit_email',
                        ['model'=>$model]);
                }
            }

            if ($model->step == 2) {
                $post_form = Yii::$app->request->post('AdldapEditemailForm');
                $post_mail = strtolower($post_form['mail']);
                $post_sAMAccountname = explode("@", $post_mail);
                $sAMAccountname = $post_sAMAccountname[0];

                $user = Yii::$app->ad->getProvider('default')->search()
                    ->findBy('sAMAccountname', $sAMAccountname);

                $mail = $user->getAttribute('mail',0);
                $dni = $user->getAttribute(Yii::$app->params['dni'],0);
                $personalmail = $user->getAttribute(Yii::$app->params['personalmail'],0);
                $fullname = $user->getAttribute('cn',0);

                $post_personalmail = explode("@", $model->personalmail);
                $dominio_personalmail = $post_personalmail[1];

                if ($dominio_personalmail != 'uea.edu.ec') {
                    if ($model->personalmail != $personalmail) {

                        //Crear un Reset TOKEN
                        $resetToken = hash(Yii::$app->params['algorithm'],
                            Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);

                        //Enviar Reset TOKEN por email
                        $this->sendTokenEmail($dni,$fullname,$mail,$model->personalmail,$resetToken);

                        //Crear Registro de Log en la base de datos
                        $description =
                            'Envío de Token para el usuario: ' . $sAMAccountname
                            . ', al correo electrónico personal: ' . $model->personalmail
                        ;
                        $this->saveLog('sendTokenEmail', $sAMAccountname, $description, $sAMAccountname,'adldap');

                        $model->step = 3;
                        return $this->render('edit_email', [
                            'model'=>$model]); //Success
                    }
                    Yii::$app->session->setFlash('errorEmail', 'El nuevo correo personal debe ser diferente al correo personal actual');
                    $model->step = 2;
                    return $this->render('edit_email', [
                        'model'=>$model]);
                }
                Yii::$app->session->setFlash('errorEmail', 'El nuevo correo debe ser personal y no contener el dominio uea.edu.ec');
                $model->step = 2;
                return $this->render('edit_email', [
                    'model'=>$model]);
            }

            if ($model->step == 3) {
                $post_form = Yii::$app->request->post('AdldapEditemailForm');
                $post_mail = strtolower($post_form['mail']);
                $post_sAMAccountname = explode("@", $post_mail);
                $sAMAccountname = $post_sAMAccountname[0];

                $user = Yii::$app->ad->getProvider('default')->search()
                    ->findBy('sAMAccountname', $sAMAccountname);

                $personalmail = $user->getAttribute(Yii::$app->params['personalmail'],0);

                //Crear un Reset TOKEN
                $resetToken = hash(Yii::$app->params['algorithm'],
                    Yii::$app->params['saltKey'] . Yii::$app->params['tokenDateFormat'] . $model->personalmail);

                if ($model->token == $resetToken) {

                    $user->setAttribute(Yii::$app->params['personalmail'],$model->personalmail);
                    $user->save();

                    //Crear Registro de Log en la base de datos
                    $description =
                        'Cambio de correo personal: ' . $personalmail
                        . ' -> ' . $model->personalmail
                    ;
                    $this->saveLog('adldapEditEmail', $sAMAccountname, $description, $sAMAccountname,'adldap');

                    $model->step = 4;
                    return $this->render('edit_email', [
                        'model'=>$model]); //Success
                }
                Yii::$app->session->setFlash('errorToken', 'TOKEN incorrecto o caducado. Lea detalladamente toda la información enviada a su correo personal');
                $model->step = 3;
                return $this->render('edit_email', [
                    'model' => $model,
                ]);

            }

        }
        $model->personalmail = 'test@uea.edu.ec';
        $model->step = 1;
        return $this->render('edit_email', [
                'model' => $model,
            ]);
    }


    public function actionForgetuser()
    {
        $model = new AdldapForgetuserForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $post_form = Yii::$app->request->post('AdldapForgetuserForm');
            $post_dni = $post_form['dni'];

            $users = Yii::$app->ad->getProvider('default')->search()->users()
                ->orWhereEquals(Yii::$app->params['dni'], $post_dni)
                ->sortBy('samaccountname', 'asc')
                ->get();

            if (isset($users)) {

                Yii::$app->session->setFlash('successSearch');

                if (isset($users)) {
                    return $this->render('forgetuser', [
                        'model'=>$model,
                        'users'=>$users
                    ]); //Success
                }

                return $this->render('forgetuser', [
                    'model'=>$model]); //Success

            } else {

                Yii::$app->session->setFlash('error','DNI, Cédula o Pasaporte incorrecto');
                return $this->render('forgetuser',
                    ['model'=>$model]); //DNI incorrecta
            }

        } else {
            return $this->render('forgetuser', [
                'model' => $model
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

            $user = Yii::$app->ad->getProvider('default')->search()
                ->findBy('mail', $post_mail);

            if (isset($user)) {
                $sAMAccountname = $user->getAttribute('samaccountname', 0);
                $commonname =  $user->getAttribute('cn', 0);
                $mail = $user->getAttribute('mail', 0);
                $resetToken = hash(Yii::$app->params['algorithm'], Yii::$app->params['saltKey'] .
                    Yii::$app->params['tokenDateFormat'] . $mail);
                if (($post_mail == $mail) and ($post_resetToken == $resetToken)) {
                    if ($post_newPassword == $post_verifyNewPassword) {

                        $explode_commonname = explode(" ", $commonname);
                        $similar = false;
                        foreach ($explode_commonname as $name) {
                            $incluye = stripos($post_newPassword, $name);
                            if ($incluye !== false) {
                                $similar = true;
                            }
                        }

                        $incluye = stripos($post_newPassword, $sAMAccountname);
                        if ($incluye !== false) {
                            $similar = true;
                        }

                        if ($similar == false) {
                            $user->setPassword($post_newPassword);
                            $user->save();

                            //Crear Registro de Log en la base de datos
                            $description =
                                'Cambio correcto de contraseña del usuario: ' . $sAMAccountname
                            ;
                            $this->saveLog('resetPasswordToken', $sAMAccountname, $description, $sAMAccountname,'adldap');


                            Yii::$app->session->setFlash('successReset');
                            return $this->render('reset', ['model' => $model]); //Success

                        } else {
                            Yii::$app->session->setFlash('errorReset',
                                'NO utilice sus NOMBRES, APELLIDOS y/o NOMBRE DE USUARIO en la nueva contraseña');

                            return $this->render('reset',
                                ['model' => $model]); //resetToken incorrecto
                        }

                    } else {
                        Yii::$app->session->setFlash('errorReset',
                            'La verificación de la nueva contraseña es incorrecta');

                        return $this->render('reset',
                            ['model' => $model]); //resetToken incorrecto
                    }
                }
                Yii::$app->session->setFlash('errorReset',
                    'Reset Token incorrecto o caducado. Genere uno nuevo.');
                return $this->render('reset',
                    ['model' => $model]); //resetToken incorrecto
            } else {
                Yii::$app->session->setFlash('errorReset',
                    'Usuario o Correo institucional incorrecto');
                return $this->render('reset',
                    ['model'=>$model]); //Email incorrecto
            }
        } else {
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
                            $this->saveLog('resetPassword', $sAMAccountname, $description, $sAMAccountname,'adldap');

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
            Yii::$app->session->setFlash('recommendation',
                'Su nueva contraseña debe contener al menos 8 dígitos
                        entre mayúsculas, minúsculas y números. 
                        NO UTILICE SUS NOMBRES y/o APELLIDOS');
            return $this->render('password', [
                'model' => $model,
            ]);
        }
    }


    public function saveLog($type, $username, $description, $external_id, $external_type)
    {
        //Registro (Log) Evento
        $modelLogs              = new Logs();
        $modelLogs->type        = $type;
        $modelLogs->username    = $username;
        $modelLogs->datetime    = date('Y-m-d H:i:s');
        $modelLogs->description = $description;
        ;
        $modelLogs->ipaddress       = \app\models\User::obtenerip();
        $modelLogs->external_id     = $external_id;
        $modelLogs->external_type   = $external_type;
        $modelLogs->save(false);
    }


    public function sendToken($dni,$fullname,$mail,$personalmail,$resetToken)
    {
            $body =
                "Estimado usuario," . "\n" .
                "Se ha solicitado reiniciar la contraseña de la cuenta institucional de " . Yii::$app->params['company'] . "\n\n" .
                "Céd/Pasaporte/Código: " . $dni . "\n" .
                "Nombres/Apellidos:       " . $fullname . "\n" .
                "Cuenta institucional:     " . $mail . "\n\n" .
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


    public function sendTokenEmail($dni,$fullname,$mail,$personalmail,$resetToken)
    {
            $body =
                "Estimado usuario," . "\n" .
                "Se ha solicitado cambiar el correo personal de su cuenta institucional en la " . Yii::$app->params['company'] . "\n\n" .
                "Céd/Pasaporte:            " . $dni . "\n" .
                "Nombres/Apellidos:      " . $fullname . "\n" .
                "Cuenta institucional:     " . $mail . "\n\n" .
                "--------------------------------------------------------------------------------------" . "\n" .
                "Utilice el siguiente TOKEN para validar su cuenta personal:" . "\n\n" .
                $resetToken . "\n\n" .
                "--------------------------------------------------------------------------------------" . "\n" .
                "NOTA: TOKEN válido SOLO el ". date('d-m-Y') . " (dd-mm-AA) desde las 00:00 hasta las 23:59" . "\n\n" .
                "---> Correo enviado por el sistema automático de Gestión de identidad. NO RESPONDA ESTE CORREO <---"
            ;

            Yii::$app->mailer->compose()
                ->setTo($personalmail)
                ->setFrom(Yii::$app->params['from'], Yii::$app->params['fromName'])
                ->setCc(Yii::$app->params['cc'])
                ->setSubject('Validar correo personal')
                ->setTextBody($body)
                ->send();
            return true;
    }


    public function sendNewUser($dni,$fullname,$mail,$personalmail)
    {
            $body =
                "Estimado usuario," . "\n" .
                "Se ha creado una cuenta institucional en " . Yii::$app->params['company'] . "\n\n" .
                "Céd/Pasaporte/Código: " . $dni . "\n" .
                "Nombres/Apellidos:       " . $fullname . "\n" .
                "Cuenta institucional:     " . $mail . "\n\n" .
                "--------------------------------------------------------------------------------------" . "\n" .
                "Haga clic en el siguiente enlace para activar su cuenta:" . "\n\n" .
                "https://password.uea.edu.ec" . "\n\n" .
                "--------------------------------------------------------------------------------------" . "\n" .
                "---> Correo enviado por el sistema automático de Gestión de identidad. NO RESPONDA ESTE CORREO <---"
            ;

            Yii::$app->mailer->compose()
                ->setTo($personalmail)
                ->setFrom(Yii::$app->params['from'], Yii::$app->params['fromName'])
                ->setCc(Yii::$app->params['cc'])
                ->setSubject(Yii::$app->params['subjectNew'])
                ->setTextBody($body)
                ->send();
            return true;
    }


    public function sendNewStudent($dni,$fullname,$mail,$personalmail)
    {
            $body =
                "Estimado usuario," . "\n" .
                "Se ha creado una cuenta institucional en la " . Yii::$app->params['company'] . "\n\n" .
                "Céd/Pasaporte/Código: " . $dni . "\n" .
                "Nombres/Apellidos:       " . $fullname . "\n" .
                "Cuenta institucional:     " . $mail . "\n\n" .
                "--------------------------------------------------------------------------------------" . "\n" .
                "Guarde estos datos. Si olvidó su contraseña ingrese en el siguiente enlace:" . "\n" .
                "https://password.uea.edu.ec" . "\n" .
                "--------------------------------------------------------------------------------------" . "\n" .
                "---> Correo enviado por el sistema automático de Gestión de identidad. NO RESPONDA ESTE CORREO <---"
            ;

            Yii::$app->mailer->compose()
                ->setTo($personalmail)
                ->setFrom(Yii::$app->params['from'], Yii::$app->params['fromName'])
                ->setCc(Yii::$app->params['cc'])
                ->setSubject('UEA | Datos de su cuenta institucional')
                ->setTextBody($body)
                ->send();
            return true;
    }


    public function sendNewStudentToken($dni,$fullname,$personalmail,$resetToken)
    {
            $body =
                "Estimado/a estudiante," . "\n" .
                "Correo de validación para obtener su cuenta institucional en la " . Yii::$app->params['company'] . "\n\n" .
                "Céd/Pasaporte/Código: " . $dni . "\n" .
                "Nombres/Apellidos:       " . $fullname . "\n\n" .
                "--------------------------------------------------------------------------------------" . "\n" .
                "TOKEN: " . "\n" .
                $resetToken . "\n" .
                "--------------------------------------------------------------------------------------" . "\n" .
                "RECUERDE: El TOKEN es valido solo hasta hoy " . date('d-m-Y') .  "  23h59" . "\n" .
                "---> Correo enviado por el sistema automático de Gestión de identidad. NO RESPONDA ESTE CORREO <---"
            ;

            Yii::$app->mailer->compose()
                ->setTo($personalmail)
                ->setFrom(Yii::$app->params['from'], Yii::$app->params['fromName'])
                ->setCc(Yii::$app->params['cc'])
                ->setSubject('UEA | Bienvenido a la Universidad Estatal Amazónica')
                ->setTextBody($body)
                ->send();
            return true;
    }

}
