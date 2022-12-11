<?php

namespace app\controllers\onlycontrol;

use Yii;
use app\models\onlycontrol\NomPuertaDel;
use app\models\onlycontrol\NomPuertaDelSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NompuertadelController implements the CRUD actions for NomPuertaDel model.
 */
class NompuertadelController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','delete','index','update','view'],
                'rules' => [
                    [
                        'actions' => ['index','view'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['create','update','index','view'],
                        'allow' => false,
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
     * Lists all NomPuertaDel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NomPuertaDelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NomPuertaDel model.
     * @param string $NOM_ID
     * @param string $PUER_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($NOM_ID, $PUER_ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($NOM_ID, $PUER_ID),
        ]);
    }

    /**
     * Creates a new NomPuertaDel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NomPuertaDel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'NOM_ID' => $model->NOM_ID, 'PUER_ID' => $model->PUER_ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NomPuertaDel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $NOM_ID
     * @param string $PUER_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($NOM_ID, $PUER_ID)
    {
        $model = $this->findModel($NOM_ID, $PUER_ID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'NOM_ID' => $model->NOM_ID, 'PUER_ID' => $model->PUER_ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NomPuertaDel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $NOM_ID
     * @param string $PUER_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($NOM_ID, $PUER_ID)
    {
        $this->findModel($NOM_ID, $PUER_ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NomPuertaDel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $NOM_ID
     * @param string $PUER_ID
     * @return NomPuertaDel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($NOM_ID, $PUER_ID)
    {
        if (($model = NomPuertaDel::findOne(['NOM_ID' => $NOM_ID, 'PUER_ID' => $PUER_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
