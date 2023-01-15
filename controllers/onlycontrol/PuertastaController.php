<?php

namespace app\controllers\onlycontrol;

use Yii;
use app\models\onlycontrol\PuertaSta;
use app\models\onlycontrol\PuertaStaSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PuertastaController implements the CRUD actions for PuertaSta model.
 */
class PuertastaController extends Controller
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
                    'indexpuerta','indexuser'],
                'rules' => [
                    [
                        'actions' => ['index','view','indexpuerta','indexuser'],
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
     * Lists all PuertaSta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PuertaStaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['P_Fecha' => SORT_DESC,];
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
        $searchModel = new PuertaStaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->Where(['like', 'P_Status', $oc_user_id]);
        if ($oc_zona != NULL) {
            $dataProvider->query->andWhere(['like', 'P_Status', $oc_zona]);
        }
        $dataProvider->sort->defaultOrder = ['P_Fecha' => SORT_DESC,];
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index_user', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexpuerta($oc_zona)
    {
        $oc_zona = base64_decode($oc_zona);
        $puerta = \app\models\onlycontrol\Puerta::find()
            ->where(['PRT_COD' => $oc_zona])
            ->one();
        $searchModel = new PuertaStaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->orWhere(['like', 'P_Status', $oc_zona]);
        $dataProvider->query->orWhere(['=', 'P_Status', 'Equipo Activo: '.$puerta->PRI_IP]);
        $dataProvider->query->orWhere(['=', 'P_Status', 'Equipo INActivo: '.$puerta->PRI_IP]);
        $dataProvider->sort->defaultOrder = ['P_Fecha' => SORT_DESC,];
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index_puerta', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PuertaSta model.
     * @param string $P_Fecha
     * @param string $P_ID
     * @param string $P_User
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($P_Fecha, $P_ID, $P_User)
    {
        return $this->render('view', [
            'model' => $this->findModel($P_Fecha, $P_ID, $P_User),
        ]);
    }

    /**
     * Creates a new PuertaSta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PuertaSta();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'P_Fecha' => $model->P_Fecha, 'P_ID' => $model->P_ID, 'P_User' => $model->P_User]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PuertaSta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $P_Fecha
     * @param string $P_ID
     * @param string $P_User
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($P_Fecha, $P_ID, $P_User)
    {
        $model = $this->findModel($P_Fecha, $P_ID, $P_User);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'P_Fecha' => $model->P_Fecha, 'P_ID' => $model->P_ID, 'P_User' => $model->P_User]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PuertaSta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $P_Fecha
     * @param string $P_ID
     * @param string $P_User
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($P_Fecha, $P_ID, $P_User)
    {
        $this->findModel($P_Fecha, $P_ID, $P_User)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PuertaSta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $P_Fecha
     * @param string $P_ID
     * @param string $P_User
     * @return PuertaSta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($P_Fecha, $P_ID, $P_User)
    {
        if (($model = PuertaSta::findOne(['P_Fecha' => $P_Fecha, 'P_ID' => $P_ID, 'P_User' => $P_User])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
