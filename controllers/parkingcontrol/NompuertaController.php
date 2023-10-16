<?php

namespace app\controllers\parkingcontrol;

use Yii;
use app\models\parkingcontrol\NomPuerta;
use app\models\parkingcontrol\NomPuertaSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NompuertaController implements the CRUD actions for NomPuerta model.
 */
class NompuertaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','delete','index','update','view',
                    'indexuser','indexpuerta'],
                'rules' => [
                    [
                        'actions' => ['index','view','indexuser','indexpuerta'],
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
     * Lists all NomPuerta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NomPuertaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexuser($oc_user_id)
    {
        $oc_user_id = base64_decode($oc_user_id);
        $searchModel = new NomPuertaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->Where(['NOM_ID' => $oc_user_id]);
        $dataProvider->sort->defaultOrder = ['TURN_NOW' => SORT_DESC,];
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index_user', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexpuerta($oc_zona)
    {
        $oc_zona = base64_decode($oc_zona);
        $searchModel = new NomPuertaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->Where(['PUER_ID' => $oc_zona]);
        $dataProvider->sort->defaultOrder = ['TURN_NOW' => SORT_DESC,];
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index_puerta', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NomPuerta model.
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
     * Creates a new NomPuerta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NomPuerta();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'NOM_ID' => $model->NOM_ID, 'PUER_ID' => $model->PUER_ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NomPuerta model.
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
     * Deletes an existing NomPuerta model.
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
     * Finds the NomPuerta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $NOM_ID
     * @param string $PUER_ID
     * @return NomPuerta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($NOM_ID, $PUER_ID)
    {
        if (($model = NomPuerta::findOne(['NOM_ID' => $NOM_ID, 'PUER_ID' => $PUER_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
