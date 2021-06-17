<?php

namespace app\controllers;

use Yii;
use app\models\CheckInOut;
use app\models\CheckInOutSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CheckinoutController implements the CRUD actions for CheckInOut model.
 */
class CheckinoutController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','index'],
                'rules' => [
                    [
                        'actions' => ['create','update','index','view'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['index','delete','view','create','update'],
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
     * Lists all CheckInOut models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CheckInOutSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CheckInOut model.
     * @param integer $USERID
     * @param string $CHECKTIME
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($USERID, $CHECKTIME)
    {
        return $this->render('view', [
            'model' => $this->findModel($USERID, $CHECKTIME),
        ]);
    }

    /**
     * Creates a new CheckInOut model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CheckInOut();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'USERID' => $model->USERID, 'CHECKTIME' => $model->CHECKTIME]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CheckInOut model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $USERID
     * @param string $CHECKTIME
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($USERID, $CHECKTIME)
    {
        $model = $this->findModel($USERID, $CHECKTIME);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'USERID' => $model->USERID, 'CHECKTIME' => $model->CHECKTIME]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CheckInOut model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $USERID
     * @param string $CHECKTIME
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($USERID, $CHECKTIME)
    {
        $this->findModel($USERID, $CHECKTIME)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CheckInOut model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $USERID
     * @param string $CHECKTIME
     * @return CheckInOut the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($USERID, $CHECKTIME)
    {
        if (($model = CheckInOut::findOne(['USERID' => $USERID, 'CHECKTIME' => $CHECKTIME])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
