<?php

namespace app\controllers;

use Yii;
use app\models\Logs;
use app\models\Documents;
use app\models\DocumentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use yii\helpers\Json;

use app\models\UploadForm;
use yii\web\UploadedFile;

/**
 * DocumentsController implements the CRUD actions for Documents model.
 */
class DocumentsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','index','update', 'view','efilename','efiletype',
                    'edescription','edate','estatus'],
                'rules' => [
                    [
                        'actions' => ['create','update','index','efilename','efiletype',
                            'edescription','edate','estatus','view'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
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
     * Lists all Documents models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocumentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Documents model.
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
     * Creates a new Documents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Documents();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->attachment = UploadedFile::getInstance($model, 'attachment');
            if ($model->upload($model)) {
                //return $this->redirect(['view', 'id' => $model->id]);

                //Registro (Log) Evento uploadDocument
                $modelLogs = new Logs();
                $modelLogs->type = 'uploadDocument';
                $modelLogs->username = Yii::$app->user->identity->username;
                $modelLogs->datetime = date('Y-m-d H:i:s');
                $modelLogs->description =
                    'Nuevo documento subido por: ' . $model->username
                    . '. Detalle: ' . $model->description
                ;
                $modelLogs->ipaddress = Yii::$app->request->userIP;
                $modelLogs->external_id = $model->getPrimaryKey();
                $modelLogs->external_type = 'documents';
                $modelLogs->save(false);

                return $this->redirect([strtolower($model->external_type) . '/admin',
                    'id' => $model->external_id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Documents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->attachment = UploadedFile::getInstance($model, 'attachment');
            if ($model->upload($model)) {
                //return $this->redirect(['view', 'id' => $model->id]);
                return $this->redirect([strtolower($model->external_type) . '/admin',
                    'id' => $model->external_id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Documents model.
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
     * Finds the Documents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Documents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Documents::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    /*
    ** Funciones personalizadas
    */
    public function actionEfilename(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = Documents::findOne($id);
            $posted = current($_POST['Documents']);
            $post = ['Documents' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->filename;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEfiletype(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = Documents::findOne($id);
            $posted = current($_POST['Documents']);
            $post = ['Documents' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->filetype;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEdescription(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = Documents::findOne($id);
            $posted = current($_POST['Documents']);
            $post = ['Documents' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->description;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEdate()
    {
        if (Yii::$app->request->post('hasEditable')) {
            $id = Yii::$app->request->post('editableKey');
            $model = Documents::findOne($id);
            $posted = current($_POST['Documents']);
            $post = ['Documents' => $posted];
            if ($model->load($post) && $model->save()) {
                $value = $model->date;
                $out = Json::encode(['output' => $value, 'message' => '']);
            } else $out = Json::encode(['output' => '', 'message' => 'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEstatus(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProjects::findOne($id);
            $posted = current($_POST['ItProjects']);
            $post = ['ItProjects' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->status;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }
}
