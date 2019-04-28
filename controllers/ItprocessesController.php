<?php

namespace app\controllers;

use Yii;
use app\models\ItProcesses;
use app\models\ItProcessesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * ItprocessesController implements the CRUD actions for ItProcesses model.
 */
class ItprocessesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['admin','create','delete','index','update', 'view',
                    'eprocess','edescription','emetrics','emagnitude',
                    'edatecreation','edateclosed','estatus'],
                'rules' => [
                    [
                        'actions' => ['admin','create','index','update',
                            'eprocess','edescription','emetrics','emagnitude',
                            'edatecreation','edateclosed','estatus'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
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
     * Lists all ItProcesses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItProcessesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = [
            'process' => SORT_ASC,
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Function admin (Vista detallada de Proyectos)
     */
    public function actionAdmin($id)
    {
        return $this->render('admin', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single ItProcesses model.
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
     * Creates a new ItProcesses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItProcesses();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ItProcesses model.
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
            return $this->redirect(['admin', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ItProcesses model.
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
     * Finds the ItProcesses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItProcesses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItProcesses::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    /*
    ** Funciones personalizadas
    */
    public function actionEprocess(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcesses::findOne($id);
            $posted = current($_POST['ItProcesses']);
            $post = ['ItProcesses' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->process;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEdescription(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcesses::findOne($id);
            $posted = current($_POST['ItProcesses']);
            $post = ['ItProcesses' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->description;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEmetrics(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcesses::findOne($id);
            $posted = current($_POST['ItProcesses']);
            $post = ['ItProcesses' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->metrics;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEdatecreation(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcesses::findOne($id);
            $posted = current($_POST['ItProcesses']);
            $post = ['ItProcesses' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->date_creation;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEdateclosed(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcesses::findOne($id);
            $posted = current($_POST['ItProcesses']);
            $post = ['ItProcesses' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->date_closed;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEmagnitude(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcesses::findOne($id);
            $posted = current($_POST['ItProcesses']);
            $post = ['ItProcesses' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->magnitude;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
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
