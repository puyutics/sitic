<?php

namespace app\controllers;

use Yii;
use app\models\Logs;
use app\models\InvModels;
use app\models\InvModelsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * InvmodelsController implements the CRUD actions for InvModels model.
 */
class InvmodelsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','delete','index','update', 'view',
                    'einvmanufacturersid','emodel','econsumables'],
                'rules' => [
                    [
                        'actions' => ['create','index','update',
                            'einvmanufacturersid','emodel','econsumables'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['create','index','update',
                            'einvmanufacturersid','emodel','econsumables'],
                        'allow' => true,
                        'roles' => ['rolTecnicos'],
                    ],
                    [
                        'actions' => ['delete','view'],
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
     * Lists all InvModels models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvModelsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->enableMultiSort = true;
        $dataProvider->sort->defaultOrder = [
            'model' => SORT_ASC,
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InvModels model.
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
     * Creates a new InvModels model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InvModels();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            //return $this->redirect(['index']);

            //Registro (Log) Evento modelCreated
            $username = Yii::$app->user->identity->username;
            $description =
                'Nuevo modelo creado por el usuario: ' . $username
                . '. Detalle: ' . $model->model
            ;            ;
            $this->saveLog('modelCreated', $username, $description, 'invModels');

            return $this->redirect('index.php?r=invpurchaseitem/index');
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InvModels model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            //return $this->redirect(['index']);
            return $this->redirect('index.php?r=invpurchaseitem/index');
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InvModels model.
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
     * Finds the InvModels model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InvModels the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InvModels::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    /*
    ** Funciones personalizadas
    */
    public function actionEinvmanufacturersid(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvModels::findOne($id);
            $posted = current($_POST['InvModels']);
            $post = ['InvModels' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->inv_manufacturers_id;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEmodel(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvModels::findOne($id);
            $posted = current($_POST['InvModels']);
            $post = ['InvModels' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->model;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEconsumables(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvModels::findOne($id);
            $posted = current($_POST['InvModels']);
            $post = ['InvModels' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->consumables;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
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
        $modelLogs->ipaddress       = \app\models\User::obtenerip();
        $modelLogs->external_id     = $username;
        $modelLogs->external_type   = $external_type;
        $modelLogs->save(false);
    }
}
