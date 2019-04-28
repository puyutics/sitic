<?php

namespace app\controllers;

use Yii;
use app\models\ItReportsPowerbi;
use app\models\ItReportsPowerbiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * ItreportspowerbiController implements the CRUD actions for ItReportsPowerbi model.
 */
class ItreportspowerbiController extends Controller
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
                            'report','edescription','estatus'],
                'rules' => [
                    [
                        'actions' => ['create','index','update','view',
                            'report','edescription','estatus'],
                            'allow' => true,
                            'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['index','report'],
                        'allow' => true,
                        'roles' => ['rolDirector'],
                    ],
                    [
                        'actions' => ['delete',],
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
     * Lists all ItReportsPowerbi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ItReportsPowerbiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = [
            'description' => SORT_ASC,
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItReportsPowerbi model.
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
     * Creates a new ItReportsPowerbi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItReportsPowerbi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ItReportsPowerbi model.
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
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ItReportsPowerbi model.
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
     * Finds the ItReportsPowerbi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItReportsPowerbi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItReportsPowerbi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    /*
    ** Funciones personalizadas
    */
    public function actionReport()
    {
        return $this->render('report');
    }

    public function actionEdescription(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItReportsPowerbi::findOne($id);
            $posted = current($_POST['ItReportsPowerbi']);
            $post = ['ItReportsPowerbi' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->description;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEstatus(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = ItReportsPowerbi::findOne($id);
            $posted = current($_POST['ItReportsPowerbi']);
            $post = ['ItReportsPowerbi' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->status;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }
}
