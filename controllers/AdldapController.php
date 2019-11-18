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
use app\models\AdldapCreateForm;
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
                'only' => ['create','index','editprofile','edituser','viewuser','forgetpass',
                    'forgetuser','password','reset','saveLog','sendToken','sendNewUser',
                    'viewgroups'],
                'rules' => [
                    [
                        'actions' => ['create','index','editprofile','edituser',
                            'forgetpass','forgetuser','password','reset','saveLog',
                            'sendToken','sendNewUser','viewgroups'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['saveLog','sendToken'],
                        'allow' => true,
                        'roles' => ['rolDirector'],
                    ],
                    [
                        'actions' => ['editprofile','viewuser','sendToken'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],

                    [
                        'actions' => ['index','forgetpass','forgetuser','password','reset',
                                        'saveLog'],
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


    public function actionCreate()
    {

        $model = new AdldapCreateForm();

        if (Yii::$app->session->get('authtype') == 'adldap') {

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                // https://github.com/Adldap2/Adldap2/blob/master/docs/models/model.md#saving
                // create user
                $user = \Yii::$app->ad->make()->user([
                    'cn' => $model->commonname,
                ]);

                // set attributes with set... function
                $user->setAccountName($model->samaccountname);
                $user->setDisplayName($model->displayname);
                $user->setFirstName($model->firstname);
                $user->setLastName($model->lastname);
                $user->setUserPrincipalName($model->mail);

                // create dn
                $dn = $user->getDnBuilder();
                $dn->addCn($user->getCommonName());
                $dn->addOu($model->dn);
                $user->setDn($dn);

                // save an check return value
                if ($user->save()) {

                    $security = new Security();
                    $user = \Yii::$app->ad->search()->findBy('sAMAccountname', $model->samaccountname);

                    if (isset($user)) {
                        $user->setTitle($model->title);
                        $user->setPassword($security->generateRandomString(8));
                        $user->setAttribute(Yii::$app->params['dni'],$model->dni);
                        $user->setAttribute(Yii::$app->params['personalmail'],$model->personalmail);
                        $user->setAttribute(Yii::$app->params['mobile'],$model->mobile);
                        $user->setUserAccountControl($model->uac);
                        $user->setDepartment($model->department);
                        $user->setTitle($model->title);
                        $user->setEmail($model->mail);

                        $user->save();

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
                            'Usuario creado: ' . $model->samaccountname
                            . ". $model->commonname. $model->personalmail"
                        ;
                        $this->saveLog('adldapCreateUser', $username, $description, $model->samaccountname,'adldap');
                        return $this->redirect(['edituser', 'search' => $model->samaccountname]);
                        //return $this->render('edituser',['model'=>$model]);
                    }

                    else {
                        Yii::$app->session->setFlash('error', "Usuario no encontrado");
                        return $this->render('create',
                            ['model'=>$model]);
                    }

                } else {
                    Yii::$app->session->setFlash('error', "Problemas al crear el usuario");
                    return $this->render('create',
                        ['model'=>$model]);
                }

            } else {
                return $this->render('create',
                    ['model'=>$model]);
            }
        }
        return $this->render('create',
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
            $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);
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
            $model->department = $user->getDepartment();
            $model->title = $user->getTitle();
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

                if (Yii::$app->request->post('submit')==='submit') {
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
                            . " ($model->uac)"
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
            $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);
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

            } else {
                return $this->render('view_user',
                    ['model'=>$model]);
            }
        }
        return $this->render('view_user',
            ['model'=>$model]);
    }


    public function actionEditprofile()
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
                $user->setAttribute(Yii::$app->params['personalmail'],$model->personalmail);
                $user->setAttribute(Yii::$app->params['mobile'],$model->mobile);
                if ($user->save()){

                    Yii::$app->session->setFlash('success', "Actualizado Correctamente");
                    $username = Yii::$app->user->identity->username;

                    //Crear Registro de Log en la base de datos
                    $description =
                        'Información actualizada del perfil: ' . $sAMAccountname;
                    $this->saveLog('adldapEditProfile', $username, $description, $sAMAccountname, 'adldap');

                    return $this->render('edit_profile',
                        ['model' => $model]);
                } else {
                    Yii::$app->session->setFlash('error', "Problemas de Actualización");
                    return $this->render('edit_profile',
                        ['model'=>$model]);
                }

            } else {
                return $this->render('edit_profile',
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
                $this->saveLog('forgetUser', $sAMAccountname, $description, $sAMAccountname,'adldap');

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
                                'NO utilice sus NOMBRES y/o APELLIDOS en la nueva contraseña');

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
        //Registro (Log) Evento sendToken
        $modelLogs              = new Logs();
        $modelLogs->type        = $type;
        $modelLogs->username    = $username;
        $modelLogs->datetime    = date('Y-m-d H:i:s');
        $modelLogs->description = $description;
        ;
        $modelLogs->ipaddress       = Yii::$app->request->userIP;
        $modelLogs->external_id     = $external_id;
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


    public function sendNewUser($dni,$fullname,$mail,$personalmail)
    {
            $body =
                "Estimado usuario," . "\n" .
                "Se ha creado una cuenta institucional en " . Yii::$app->params['company'] . "\n\n" .
                "Céd/Pasaporte/Código: " . $dni . "\n" .
                "Nombres/Apellidos:    " . $fullname . "\n" .
                "Cuenta institucional:  " . $mail . "\n\n" .
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

}
