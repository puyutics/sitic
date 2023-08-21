<?php

namespace app\controllers;

use app\models\AdldapEditForm;
use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\base\Security;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use yii\web\Response;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'delete', 'index', 'update', 'view',
                    'estatus', 'adduser'],
                'rules' => [
                    [
                        'actions' => ['index', 'estatus', 'adduser'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['create','delete','update','view'],
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionEstatus(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = \app\models\User::findOne($id);
            $posted = current($_POST['User']);
            $post = ['User' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->status;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionAdduser($action)
    {
        $request = Yii::$app->request;
        $model = new AdldapEditForm();

        if ($request->isAjax) {
            //Process for ajax request
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title'=> "Agregar usuario",
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
                    $this->redirect([$action]);
                }
            } else {
                return [
                    'title'=> "Agregar usuario",
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

            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }
}
