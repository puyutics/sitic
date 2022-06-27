<?php

namespace app\controllers;

use Yii;
use Yii\base\Security;
use app\models\Logs;
use app\models\RolUser;
use app\models\RolUserSearch;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;
use app\models\AdldapEditForm;

/**
 * RoluserController implements the CRUD actions for RolUser model.
 */
class RoluserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','delete','index','update','view',
                    'pdf','email','user','adduser'],
                'rules' => [
                    [
                        'actions' => ['create','index','update','view',
                            'pdf','email','user','adduser'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['create','index','update','view',
                            'pdf','email','adduser'],
                        'allow' => true,
                        'roles' => ['rolComunicados'],
                    ],
                    [
                        'actions' => ['pdf','email','user'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => false,
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all RolUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RolUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = [
            'id' => SORT_DESC,
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUser()
    {
        $username = Yii::$app->user->identity->username;
        $searchModel = new RolUserSearch();
        $searchModel->username = $username;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = [
            'anio' => SORT_DESC,
            'mes' => SORT_DESC,
        ];

        return $this->render('user', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'username' => $username,
        ]);
    }

    /**
     * Displays a single RolUser model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "Rol de Pago",
                'content'=>$this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer'=> Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    Html::a('Editar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
            ];
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new RolUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new RolUser();

        if ($request->isAjax) {
            //Process for ajax request
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title'=> "Subir nuevo Rol de Pago" . "<br>" .
                        Html::a('Agregar Funcionario',['adduser','action'=>'create'],['class'=>'btn btn-warning','role'=>'modal-remote'])
                    ,
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=>
                        Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Subir',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            } elseif ($model->load($request->post())) {
                //Comprobar registro duplicado
                $rolUser = \app\models\RolUser::find()
                    ->andWhere(['username' => $model->username])
                    ->andWhere(['rol_tipo_id' => $model->rol_tipo_id])
                    ->andWhere(['anio' => $model->anio])
                    ->andWhere(['mes' => $model->mes])
                    ->one();
                if (!isset($rolUser)) {
                    $model->filefolder = '-';
                    $model->filename = '-';
                    $model->filetype = '-';
                    $model->upload_rol = UploadedFile::getInstance($model, 'upload_rol');
                    if ($model->validate()) {
                        $userProfile = \app\models\UserProfile::find()
                            ->where(['username' => $model->username])
                            ->one();
                        $dni = $userProfile->dni;
                        $firstname = $userProfile->firstname;
                        $lastname = $userProfile->lastname;
                        $mail = $userProfile->mail;
                        $personalmail = $userProfile->personalmail;
                        $rol_tipo_nombre = $model->rolTipo->nombre;
                        $anio = $model->anio;
                        if ($model->mes == 1) $mes = '01-Enero';
                        if ($model->mes == 2) $mes = '02-Febrero';
                        if ($model->mes == 3) $mes = '03-Marzo';
                        if ($model->mes == 4) $mes = '04-Abril';
                        if ($model->mes == 5) $mes = '05-Mayo';
                        if ($model->mes == 6) $mes = '06-Junio';
                        if ($model->mes == 7) $mes = '07-Julio';
                        if ($model->mes == 8) $mes = '08-Agosto';
                        if ($model->mes == 9) $mes = '09-Septiembre';
                        if ($model->mes == 10) $mes = '10-Octubre';
                        if ($model->mes == 11) $mes = '11-Noviembre';
                        if ($model->mes == 12) $mes = '12-Diciembre';
                        if (isset($model->upload_rol)) {
                            $folder_uploads = 'uploads/roles';
                            $folder_anio = $model->anio;
                            $folder_mes = $model->mes;
                            $model->filefolder = $folder_uploads . '/'
                                . $folder_anio . '/'
                                . $folder_mes . '/'
                            ;
                            if (!file_exists($model->filefolder)) {
                                mkdir($model->filefolder, 0755, true);
                            }
                            $model->filename = 'rol_pago_'.$model->anio.'_'.$mes.'_'.$dni.'_'.$model->rolTipo->nom_corto;
                            $model->filetype = $model->upload_rol->extension;
                            $model->uploadRol($model);
                        }
                        $model->status = 0;
                        if ($model->save()) {
                            $filefolder = $model->filefolder;
                            $filename = $model->filename;
                            $filetype = $model->filetype;
                            if ($this->sendEmail($dni, $firstname, $lastname, $mail, $personalmail, $rol_tipo_nombre, $anio, $mes, $filefolder, $filename, $filetype)) {
                                $model->status = 1;
                                if ($model->save()) {
                                    //Crear Registro de Log en la base de datos
                                    $logusername = Yii::$app->user->identity->username;
                                    $external_id = $model->id;
                                    $description =
                                        'Email enviado - Rol de Pago'
                                        . '. DNI: ' . $dni
                                        . '. Nombres: ' . $firstname
                                        . '. Apellidos: ' . $lastname
                                        . '. Email institucional: ' . $mail
                                        . '. Email Personal: ' . $personalmail
                                        . '. Tipo Rol: ' . $rol_tipo_nombre
                                        . '. Año: ' . $anio
                                        . '. Mes: ' . $mes
                                        . '. '
                                    ;
                                    $this->saveLog('roluserEmail', $logusername, $description, $external_id,'roluser');
                                }
                            }
                            return [
                                'forceReload'=>'#crud-datatable-pjax',
                                'title'=> "Subir nuevo Rol de Pago",
                                'content'=>'<span class="text-success">Subir Rol de Pago exitoso</span>',
                                'footer'=>
                                    Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                    Html::a('Nuevo',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                            ];
                        }
                    }
                    return [
                        'title'=> "Subir nuevo Rol de Pago" . "<br>" .
                            Html::a('Agregar Funcionario',['adduser','action'=>'create'],['class'=>'btn btn-warning','role'=>'modal-remote'])
                        ,
                        'content'=>$this->renderAjax('create', [
                            'model' => $model,
                        ]),
                        'footer'=>
                            Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::button('Subir',['class'=>'btn btn-primary','type'=>"submit"])
                    ];
                } else {
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Subir nuevo Rol de Pago",
                        'content'=>'<span class="text-danger">Rol de pago ya registrado o duplicado</span>',
                        'footer'=>
                            Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a('Nuevo',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];
                }
            } else {
                return [
                    'title'=> "Subir nuevo Rol de Pago" . "<br>" .
                        Html::a('Agregar Funcionario',['adduser','action'=>'create'],['class'=>'btn btn-warning','role'=>'modal-remote'])
                    ,
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=>
                        Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Subir',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        } else {
            //Process for non-ajax request
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing RolUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isAjax) {
            //Process for ajax request
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title'=> "Editar Rol de Pago" . "<br>" .
                        Html::a('Agregar Funcionario',['adduser','action'=>'update','id'=>$id],['class'=>'btn btn-warning','role'=>'modal-remote'])
                    ,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=>
                        Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Actualizar',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            } elseif ($model->load($request->post())) {
                $model->upload_rol = UploadedFile::getInstance($model, 'upload_rol');
                if ($model->validate()) {
                    $userProfile = \app\models\UserProfile::find()
                        ->where(['username' => $model->username])
                        ->one();
                    $dni = $userProfile->dni;
                    $firstname = $userProfile->firstname;
                    $lastname = $userProfile->lastname;
                    $mail = $userProfile->mail;
                    $personalmail = $userProfile->personalmail;
                    $rol_tipo_nombre = $model->rolTipo->nombre;
                    $anio = $model->anio;
                    if ($model->mes == 1) $mes = '01-Enero';
                    if ($model->mes == 2) $mes = '02-Febrero';
                    if ($model->mes == 3) $mes = '03-Marzo';
                    if ($model->mes == 4) $mes = '04-Abril';
                    if ($model->mes == 5) $mes = '05-Mayo';
                    if ($model->mes == 6) $mes = '06-Junio';
                    if ($model->mes == 7) $mes = '07-Julio';
                    if ($model->mes == 8) $mes = '08-Agosto';
                    if ($model->mes == 9) $mes = '09-Septiembre';
                    if ($model->mes == 10) $mes = '10-Octubre';
                    if ($model->mes == 11) $mes = '11-Noviembre';
                    if ($model->mes == 12) $mes = '12-Diciembre';
                    if (isset($model->upload_rol)) {
                        //Eliminar archivo anterior
                        $filefolder = $model->filefolder;
                        $filename = $model->filename;
                        $filetype = $model->filetype;
                        if (file_exists($filefolder.$filename.'.'.$filetype)) {
                            unlink($filefolder.$filename.'.'.$filetype);
                        }
                        //Subir nuevo archivo
                        $folder_uploads = 'uploads/roles';
                        $folder_anio = $model->anio;
                        $folder_mes = $model->mes;
                        $model->filefolder = $folder_uploads . '/'
                            . $folder_anio . '/'
                            . $folder_mes . '/'
                        ;
                        if (!file_exists($model->filefolder)) {
                            mkdir($model->filefolder, 0755, true);
                        }
                        $model->filename = 'rol_pago_'.$model->anio.'_'.$mes.'_'.$dni.'_'.$model->rolTipo->nom_corto;
                        $model->filetype = $model->upload_rol->extension;
                        $model->uploadRol($model);
                    }
                    $model->status = 0;
                    if ($model->save()) {
                        $filefolder = $model->filefolder;
                        $filename = $model->filename;
                        $filetype = $model->filetype;
                        if ($this->sendEmail($dni, $firstname, $lastname, $mail, $personalmail, $rol_tipo_nombre, $anio, $mes, $filefolder, $filename, $filetype)) {
                            $model->status = 1;
                            if ($model->save()) {
                                //Crear Registro de Log en la base de datos
                                $logusername = Yii::$app->user->identity->username;
                                $external_id = $model->id;
                                $description =
                                    'Email enviado - Rol de Pago'
                                    . '. DNI: ' . $dni
                                    . '. Nombres: ' . $firstname
                                    . '. Apellidos: ' . $lastname
                                    . '. Email institucional: ' . $mail
                                    . '. Email Personal: ' . $personalmail
                                    . '. Tipo Rol: ' . $rol_tipo_nombre
                                    . '. Año: ' . $anio
                                    . '. Mes: ' . $mes
                                    . '. '
                                ;
                                $this->saveLog('roluserEmail', $logusername, $description, $external_id,'roluser');
                            }
                        }
                        return [
                            'forceReload'=>'#crud-datatable-pjax',
                            'title'=> "Editar Rol de Pago" . "<br>" .
                                Html::a('Agregar Funcionario',['adduser','action'=>'update','id'=>$id],['class'=>'btn btn-warning','role'=>'modal-remote'])
                            ,
                            'content'=>$this->renderAjax('pdf', [
                                'model' => $this->findModel($id),
                            ]),
                            'footer'=>
                                Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Actualizar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                        ];
                    }

                }
                return [
                    'title'=> "Editar Rol de Pago" . "<br>" .
                        Html::a('Agregar Funcionario',['adduser','action'=>'update','id'=>$id],['class'=>'btn btn-warning','role'=>'modal-remote'])
                    ,
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=>
                        Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Subir',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            } else {
                return [
                    'title'=> "Editar Rol de Pago" . "<br>" .
                        Html::a('Agregar Funcionario',['adduser','action'=>'update','id'=>$id],['class'=>'btn btn-warning','role'=>'modal-remote'])
                    ,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=>
                        Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Guardar',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        } else {
            //Process for non-ajax request
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing RolUser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RolUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RolUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RolUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //Funciones personalizadas
    public function actionPdf($id)
    {
        $id = base64_decode($id);
        return $this->render('pdf', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionAdduser($action, $id = NULL)
    {
        $request = Yii::$app->request;
        $model = new AdldapEditForm();

        if ($request->isAjax) {
            //Process for ajax request
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title'=> "Agregar Funcionario",
                    'content'=>$this->renderAjax('_adduser', [
                        'model' => $model,
                    ]),
                    'footer'=>
                        Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Agregar',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            } elseif ($model->load($request->post())) {
                $search = $model->search;
                $ldapUser = Yii::$app->ad->getProvider('default')->search()->users()
                    ->find($search);
                if (isset($ldapUser)) {
                    //Extraer datos del usuario
                    $samaccountname = $ldapUser->getAttribute('samaccountname',0);
                    $dni = $ldapUser->getAttribute(Yii::$app->params['dni'],0);
                    $firstname = $ldapUser->getFirstName();
                    $lastname = $ldapUser->getLastName();
                    $commonname = $ldapUser->getCommonName();
                    $displayname = $ldapUser->getDisplayName();
                    $mail = $ldapUser->getEmail();
                    $personalmail = $ldapUser->getAttribute(Yii::$app->params['personalmail'], 0);
                    $mobile = $ldapUser->getAttribute(Yii::$app->params['mobile'], 0);
                    //Crear Usuario si no existe
                    $user = \app\models\User::findByUsername($samaccountname);
                    if (!isset($user)) {
                        $security = new Security();
                        $password = hash(Yii::$app->params['algorithm'],$security->generateRandomString(8));
                        $created_at = $updated_at = idate("U");
                        \Yii::$app->db->createCommand(
                            'INSERT INTO `user` (
                          `username`,
                          `password`,
                          `auth_key`,
                          `status`,
                          `created_at`,
                          `updated_at`
                          ) VALUES (
                          \'' . $samaccountname . '\',
                          \'' . $password . '\',
                          \'' . $password . '\',
                          \'' . 1 . '\',
                          \'' . $created_at . '\',
                          \'' . $updated_at . '\'
                          )
                        ')
                            ->execute();
                    }
                    //Crear Perfil del usuario
                    $userprofile = \app\models\UserProfile::findByUsername($samaccountname);
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
                          WHERE `username` = \''. $samaccountname . '\'
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
                          \'' . $samaccountname . '\',
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
                    //Comprobar su la action es create or update
                    if ($action == 'create') {
                        return [
                            'forceReload'=>'#crud-datatable-pjax',
                            'title'=> "Agregar funcionario",
                            'content'=>'<span class="text-success">Agregar funcionario exitoso</span>'.
                                '<br>'.$dni.' : '.$lastname.' '.$firstname
                            ,
                            'footer'=>
                                Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Regresar',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                        ];
                    }
                    if ($action == 'update') {
                        return [
                            'forceReload'=>'#crud-datatable-pjax',
                            'title'=> "Agregar funcionario",
                            'content'=>'<span class="text-success">Agregar funcionario exitoso</span>'.
                                '<br>'.$dni.' : '.$lastname.' '.$firstname
                            ,
                            'footer'=>
                                Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Regresar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                        ];
                    }
                } else {
                    //Comprobar su la action es create or update
                    if ($action == 'create') {
                        return [
                            'forceReload'=>'#crud-datatable-pjax',
                            'title'=> "Agregar funcionario",
                            'content'=>'<span class="text-danger">No se ha encontrado al funcionario</span>',
                            'footer'=>
                                Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Regresar',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                        ];
                    }
                    if ($action == 'update') {
                        return [
                            'forceReload'=>'#crud-datatable-pjax',
                            'title'=> "Agregar funcionario",
                            'content'=>'<span class="text-danger">No se ha encontrado al funcionario</span>',
                            'footer'=>
                                Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                                Html::a('Regresar',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                        ];
                    }
                }
            } else {
                return [
                    'title'=> "Agregar Funcionario",
                    'content'=>$this->renderAjax('_adduser', [
                        'model' => $model,
                    ]),
                    'footer'=>
                        Html::button('Cerrar',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Agregar',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        } else {
            //Process for non-ajax request
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            return $this->render('_adduser', [
                'model' => $model,
            ]);
        }
    }

    public function actionEmail($id)
    {
        $id = base64_decode($id);
        $tiempoInicial = $this->microtimeFloat();
        $enviados = 0;
        $rolUser = \app\models\RolUser::find()
            ->where(['id' => $id])
            ->one();
        if (isset($rolUser)) {
            $userProfile = \app\models\UserProfile::find()
                ->where(['username' => $rolUser->username])
                ->one();
            $dni = $userProfile->dni;
            $firstname = $userProfile->firstname;
            $lastname = $userProfile->lastname;
            $mail = $userProfile->mail;
            $personalmail = $userProfile->personalmail;
            $rol_tipo_nombre = $rolUser->rolTipo->nombre;
            $anio = $rolUser->anio;
            if ($rolUser->mes == 1) $mes = '01-Enero';
            if ($rolUser->mes == 2) $mes = '02-Febrero';
            if ($rolUser->mes == 3) $mes = '03-Marzo';
            if ($rolUser->mes == 4) $mes = '04-Abril';
            if ($rolUser->mes == 5) $mes = '05-Mayo';
            if ($rolUser->mes == 6) $mes = '06-Junio';
            if ($rolUser->mes == 7) $mes = '07-Julio';
            if ($rolUser->mes == 8) $mes = '08-Agosto';
            if ($rolUser->mes == 9) $mes = '09-Septiembre';
            if ($rolUser->mes == 10) $mes = '10-Octubre';
            if ($rolUser->mes == 11) $mes = '11-Noviembre';
            if ($rolUser->mes == 12) $mes = '12-Diciembre';
            $filefolder = $rolUser->filefolder;
            $filename = $rolUser->filename;
            $filetype = $rolUser->filetype;

            if ($this->sendEmail($dni, $firstname, $lastname, $mail, $personalmail, $rol_tipo_nombre, $anio, $mes, $filefolder, $filename, $filetype)) {
                $enviados = $enviados + 1;
                $rolUser->status = 1;
                if ($rolUser->save(false)) {
                    //Crear Registro de Log en la base de datos
                    $logusername = Yii::$app->user->identity->username;
                    $external_id = $rolUser->id;
                    $description =
                        'Email enviado - Rol de Pago'
                        . '. DNI: ' . $dni
                        . '. Nombres: ' . $firstname
                        . '. Apellidos: ' . $lastname
                        . '. Email institucional: ' . $mail
                        . '. Email Personal: ' . $personalmail
                        . '. Tipo Rol: ' . $rol_tipo_nombre
                        . '. Año: ' . $anio
                        . '. Mes: ' . $mes
                        . '. '
                    ;
                    $this->saveLog('roluserEmail', $logusername, $description, $external_id,'roluser');

                    echo $enviados . '. DNI: ' . $dni . '. Email: ' . $mail  . '. Email Personal: ' . $personalmail . '. Funcionario: ' . $lastname . ' ' . $firstname;
                } else {
                    print_r($rolUser->errors);
                }
            }
        }

        $tiempoFinal = $this->microtimeFloat();
        $tiempoEjecucion = round($tiempoFinal - $tiempoInicial,2) . ' segundos';
        echo '<br>';
        echo 'Correos enviados: ' . $enviados;
        echo '<br>';
        echo 'Tiempo: ' . $tiempoEjecucion;
    }

    /*public function actionEmails()
    {
        $tiempoInicial = $this->microtimeFloat();
        $enviados = 0;
        $examenes = \app\models\Examen::find()
            ->where(['status' => 0])
            ->all();

        echo 'Total de correos por enviar: ' . count($examenes);
        echo '<br>';
        echo '<br>';

        if (isset($examenes)) {
            foreach ($examenes as $examen) {
                $dni = $examen['dni'];
                $oferta_id = $examen['oferta_id'];
                $email = $examen['email'];
                $url = $examen['url'];
                $username = $examen['username'];
                $password = $examen['password'];
                $fecha = substr($examen['fecha_hora'],0,10);
                $hora = substr($examen['fecha_hora'],11,8);
                $grupo = $examen['grupo'];

                $userExamenes = \app\models\Examen::find()
                    ->where(['dni' => $dni])
                    ->andWhere(['oferta_id' => $oferta_id])
                    ->all();

                $message = 1;
                if (count($userExamenes) > 1) {
                    $message = 2;
                }

                if ($this->sendEmail($dni, $email, $url, $username, $password, $fecha, $hora, $grupo, $message)) {
                    $enviados = $enviados + 1;
                    $examen->status = 1;
                    if ($examen->save()) {
                        //Crear Registro de Log en la base de datos
                        $logusername = Yii::$app->user->identity->username;
                        $external_id = $examen->id;
                        $description =
                            'Email enviado - Examen de ubicación'
                            . '. DNI: ' . $dni
                            . '. Email: ' . $email
                            . '. URL: ' . $url
                            . '. Username: ' . $username
                            . '. Password: ' . $password
                            . '. Fecha: ' . $fecha
                            . '. Hora: ' . $hora
                            . '. Grupo: ' . $grupo
                            . '.'
                        ;
                        $this->saveLog('examenEmail', $logusername, $description, $external_id,'examen');

                        echo $enviados . '. DNI: ' . $dni . '. Email: ' . $email . '. USUARIO: ' . $username . '. CÓDIGO: ' . $password;
                    }
                }
            }
        }

        $tiempoFinal = $this->microtimeFloat();
        $tiempoEjecucion = round($tiempoFinal - $tiempoInicial,2) . ' segundos';
        echo '<br>';
        echo 'Correos enviados: ' . $enviados;
        echo '<br>';
        echo 'Tiempo: ' . $tiempoEjecucion;
    }*/

    public function sendEmail($dni, $firstname, $lastname, $mail, $personalmail, $rol_tipo_nombre, $anio, $mes, $filefolder, $filename, $filetype)
    {
        $body =
            "UNIVERSIDAD ESTATAL AMAZÓNICA" . "\n" .
            "--------------------------------------------------------------------------------------" . "\n" .
            "ROL DE PAGO" . "\n" .
            "Cédula/Pasaporte: " . $dni . "\n" .
            "Funcionario: " .$lastname." ".$firstname. "\n" .
            "Tipo de Rol: " . $rol_tipo_nombre . "\n" .
            "Año: " . $anio . "\n" .
            "Mes: " . $mes . "\n" .
            "--------------------------------------------------------------------------------------" . "\n" .
            "Para acceder a revisar sus Roles de Pagos, haga clic en el siguiente enlace:" . "\n" .
            "http://www.uea.edu.ec/sitic/index.php?r=roluser/user" . "\n" .
            "--------------------------------------------------------------------------------------" . "\n" .
            "Correo enviado automáticamente por el sistema UEA | SITIC" . "\n" .
            "NO RESPONDA ESTE CORREO"
        ;

        Yii::$app->mailerRoles->compose()
            ->setTo($mail)
            ->setCc($personalmail)
            ->setFrom('roles@uea.edu.ec','UEA | ROL DE PAGO')
            ->setSubject('UEA | ROL DE PAGO '.$lastname." ".$firstname)
            ->setTextBody($body)
            ->attach($filefolder.$filename.'.'.$filetype)
            ->send();
        return true;
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
        $modelLogs->ipaddress       = Yii::$app->request->userIP;
        $modelLogs->external_id     = $external_id;
        $modelLogs->external_type   = $external_type;
        $modelLogs->save(false);
    }

    public function microtimeFloat()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    }


}
