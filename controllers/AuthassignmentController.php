<?php

namespace app\controllers;

use app\models\Logs;
use Yii;
use app\models\AuthAssignment;
use app\models\AuthAssignmentSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthassignmentController implements the CRUD actions for AuthAssignment model.
 */
class AuthassignmentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','delete','index','update', 'view'],
                'rules' => [
                    [
                        'actions' => ['create','update','index','view'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
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
     * Lists all AuthAssignment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthAssignmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthAssignment model.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($item_name, $user_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($item_name, $user_id),
        ]);
    }

    /**
     * Creates a new AuthAssignment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AuthAssignment();

        if ($model->load(Yii::$app->request->post())) {

            //Comprobar si existe un Rol de Usuario
            $auth_assignment = \app\models\AuthAssignment::find()
                ->where(["item_name" => $model->item_name])
                ->andWhere(["user_id" => $model->user_id])
                ->all();
            if (count($auth_assignment)==0) {
                $model->created_at = idate("U");
                if ($model->save()) {

                    $auth_item_child = \app\models\AuthItemChild::find()
                        ->where(["parent" => $model->item_name])
                        ->one();

                    $user = \app\models\User::find()
                        ->where(["id" => $model->user_id])
                        ->one();

                    //Crear Registro de Log en la base de datos
                    $description =
                        'Nuevo Rol de Usuario Creado: '
                        . $auth_item_child->child
                        . '. Usuario: '
                        . $user->username;
                    $username = Yii::$app->user->identity->username;
                    $this->saveLog('authAssignmentCreate', $username, $description, $model->item_name.'@'.$model->user_id,'authassignment');

                    return $this->redirect(['index']);
                }
            } else {
                Yii::$app->session->setFlash('error',
                    'No puede duplicar el Rol de Usuario');
                return $this->redirect(['index']);
            }

            //return $this->redirect(['view', 'item_name' => $model->item_name, 'user_id' => $model->user_id]);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AuthAssignment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($item_name, $user_id)
    {
        $model = $this->findModel($item_name, $user_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $auth_item_child = \app\models\AuthItemChild::find()
                ->where(["parent" => $model->item_name])
                ->one();

            $user = \app\models\User::find()
                ->where(["id" => $model->user_id])
                ->one();

            //Crear Registro de Log en la base de datos
            $description =
                'Rol de Usuario modificado: '
                . $auth_item_child->child
                . '. Usuario: '
                . $user->username;
            $username = Yii::$app->user->identity->username;
            $this->saveLog('authAssignmentUpdate', $username, $description, $model->item_name.'@'.$model->user_id,'authassignment');

            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthAssignment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $item_name
     * @param string $user_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($item_name, $user_id)
    {
        $this->findModel($item_name, $user_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthAssignment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $item_name
     * @param string $user_id
     * @return AuthAssignment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($item_name, $user_id)
    {
        if (($model = AuthAssignment::findOne(['item_name' => $item_name, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
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
}
