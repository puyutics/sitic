<?php

namespace app\controllers\onlycontrol;

use Yii;
use app\models\onlycontrol\TblZonaequipo;
use app\models\onlycontrol\TblZonaequipoSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TblzonaequipoController implements the CRUD actions for TblZonaequipo model.
 */
class TblzonaequipoController extends Controller
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
     * Lists all TblZonaequipo models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblZonaequipoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblZonaequipo model.
     * @param string $PRT_COD
     * @param string $ZM_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($PRT_COD, $ZM_ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($PRT_COD, $ZM_ID),
        ]);
    }

    /**
     * Creates a new TblZonaequipo model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblZonaequipo();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'PRT_COD' => $model->PRT_COD, 'ZM_ID' => $model->ZM_ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TblZonaequipo model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $PRT_COD
     * @param string $ZM_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($PRT_COD, $ZM_ID)
    {
        $model = $this->findModel($PRT_COD, $ZM_ID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'PRT_COD' => $model->PRT_COD, 'ZM_ID' => $model->ZM_ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblZonaequipo model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $PRT_COD
     * @param string $ZM_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($PRT_COD, $ZM_ID)
    {
        $this->findModel($PRT_COD, $ZM_ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblZonaequipo model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $PRT_COD
     * @param string $ZM_ID
     * @return TblZonaequipo the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($PRT_COD, $ZM_ID)
    {
        if (($model = TblZonaequipo::findOne(['PRT_COD' => $PRT_COD, 'ZM_ID' => $ZM_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
