<?php

namespace app\controllers\onlycontrol;

use Yii;
use app\models\onlycontrol\Asistnow;
use app\models\onlycontrol\AsistnowSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AsistnowController implements the CRUD actions for Asistnow model.
 */
class AsistnowController extends Controller
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
     * Lists all Asistnow models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AsistnowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['ASIS_ING' => SORT_DESC,];
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexuser($oc_user_id, $oc_zona = NULL)
    {
        $oc_user_id = base64_decode($oc_user_id);
        $oc_zona = base64_decode($oc_zona);
        $searchModel = new AsistnowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->Where(['ASIS_ID' => $oc_user_id]);
        if ($oc_zona != NULL) {
            $dataProvider->query->andWhere(['ASIS_ZONA' => $oc_zona]);
        }
        $dataProvider->sort->defaultOrder = ['ASIS_ING' => SORT_DESC,];
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index_user', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexpuerta($oc_zona)
    {
        $oc_zona = base64_decode($oc_zona);
        $searchModel = new AsistnowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['ASIS_ZONA' => $oc_zona]);
        $dataProvider->sort->defaultOrder = ['ASIS_ING' => SORT_DESC,];
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index_puerta', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Asistnow model.
     * @param string $ASIS_ID
     * @param string $ASIS_ING
     * @param string $ASIS_ZONA
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($ASIS_ID, $ASIS_ING, $ASIS_ZONA)
    {
        return $this->render('view', [
            'model' => $this->findModel($ASIS_ID, $ASIS_ING, $ASIS_ZONA),
        ]);
    }

    /**
     * Creates a new Asistnow model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Asistnow();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ASIS_ID' => $model->ASIS_ID, 'ASIS_ING' => $model->ASIS_ING, 'ASIS_ZONA' => $model->ASIS_ZONA]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Asistnow model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $ASIS_ID
     * @param string $ASIS_ING
     * @param string $ASIS_ZONA
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($ASIS_ID, $ASIS_ING, $ASIS_ZONA)
    {
        $model = $this->findModel($ASIS_ID, $ASIS_ING, $ASIS_ZONA);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'ASIS_ID' => $model->ASIS_ID, 'ASIS_ING' => $model->ASIS_ING, 'ASIS_ZONA' => $model->ASIS_ZONA]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Asistnow model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $ASIS_ID
     * @param string $ASIS_ING
     * @param string $ASIS_ZONA
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($ASIS_ID, $ASIS_ING, $ASIS_ZONA)
    {
        $this->findModel($ASIS_ID, $ASIS_ING, $ASIS_ZONA)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Asistnow model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $ASIS_ID
     * @param string $ASIS_ING
     * @param string $ASIS_ZONA
     * @return Asistnow the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($ASIS_ID, $ASIS_ING, $ASIS_ZONA)
    {
        if (($model = Asistnow::findOne(['ASIS_ID' => $ASIS_ID, 'ASIS_ING' => $ASIS_ING, 'ASIS_ZONA' => $ASIS_ZONA])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
