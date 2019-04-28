<?php

namespace app\controllers;

use Yii;
use app\models\ItProcessesPurchase;
use app\models\ItProcessesPurchaseSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * ItprocessespurchaseController implements the CRUD actions for ItProcessesPurchase model.
 */
class ItprocessespurchaseController extends Controller
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
                    'eitprocessesid','einvpurchaseid','estatus'],
                'rules' => [
                    [
                        'actions' => ['create','index','update',
                            'eitprocessesid','einvpurchaseid','estatus'],
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
     * Lists all ItProcessesPurchase models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItProcessesPurchaseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItProcessesPurchase model.
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
     * Creates a new ItProcessesPurchase model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItProcessesPurchase();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['itprocesses/admin', 'id' => $model->it_processes_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ItProcessesPurchase model.
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
     * Deletes an existing ItProcessesPurchase model.
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
     * Finds the ItProcessesPurchase model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItProcessesPurchase the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItProcessesPurchase::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    /*
    ** Funciones personalizadas
    */
    public function actionEitprocessesid(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcessesPurchase::findOne($id);
            $posted = current($_POST['ItProcessesPurchase']);
            $post = ['ItProcessesPurchase' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->itProcesses->process;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEinvpurchaseid(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcessesPurchase::findOne($id);
            $posted = current($_POST['ItProcessesPurchase']);
            $post = ['ItProcessesPurchase' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->invPurchase->description;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEstatus(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItProcessesPurchase::findOne($id);
            $posted = current($_POST['ItProcessesPurchase']);
            $post = ['ItProcessesPurchase' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->status;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }
}
