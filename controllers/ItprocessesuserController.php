<?php

namespace app\controllers;

use Yii;
use app\models\ItProcessesUser;
use app\models\ItProcessesUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * ItprocessesuserController implements the CRUD actions for ItProcessesUser model.
 */
class ItprocessesuserController extends Controller
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
                    'eusername','eitprocessesid','edescription',
                    'edateassigned','edatereleased','estatus'],
                'rules' => [
                    [
                        'actions' => ['admin','create','index','update',
                            'eusername','eitprocessesid','edescription',
                            'edateassigned','edatereleased','estatus'],
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
     * Lists all ItProcessesUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItProcessesUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItProcessesUser model.
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
     * Creates a new ItProcessesUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItProcessesUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['itprocesses/admin', 'id' => $model->it_processes_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ItProcessesUser model.
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
            return $this->redirect(['itprocesses/admin', 'id' => $model->it_processes_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ItProcessesUser model.
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
     * Finds the ItProcessesUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItProcessesUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItProcessesUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    /*
    ** Funciones personalizadas
    */
    public function actionEusername(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcessesUser::findOne($id);
            $posted = current($_POST['ItProcessesUser']);
            $post = ['ItProcessesUser' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->username;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEdescription(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcessesUser::findOne($id);
            $posted = current($_POST['ItProcessesUser']);
            $post = ['ItProcessesUser' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->description;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEitprocessesid(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcessesUser::findOne($id);
            $posted = current($_POST['ItProcessesUser']);
            $post = ['ItProcessesUser' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->itProcesses->process;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEdateassigned(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcessesUser::findOne($id);
            $posted = current($_POST['ItProcessesUser']);
            $post = ['ItProcessesUser' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->date_assigned;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEdatereleased(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcessesUser::findOne($id);
            $posted = current($_POST['ItProcessesUser']);
            $post = ['ItProcessesUser' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->date_released;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEstatus(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcessesUser::findOne($id);
            $posted = current($_POST['ItProcessesUser']);
            $post = ['ItProcessesUser' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->status;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }
}
