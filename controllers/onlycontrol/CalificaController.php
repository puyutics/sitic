<?php

namespace app\controllers\onlycontrol;

use Yii;
use app\models\onlycontrol\Califica;
use app\models\onlycontrol\CalificaSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CalificaController implements the CRUD actions for Califica model.
 */
class CalificaController extends Controller
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
     * Lists all Califica models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CalificaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Califica model.
     * @param string $CALI_ID
     * @param string $CALI_NOM
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($CALI_ID, $CALI_NOM)
    {
        return $this->render('view', [
            'model' => $this->findModel($CALI_ID, $CALI_NOM),
        ]);
    }

    /**
     * Creates a new Califica model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Califica();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'CALI_ID' => $model->CALI_ID, 'CALI_NOM' => $model->CALI_NOM]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Califica model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $CALI_ID
     * @param string $CALI_NOM
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($CALI_ID, $CALI_NOM)
    {
        $model = $this->findModel($CALI_ID, $CALI_NOM);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'CALI_ID' => $model->CALI_ID, 'CALI_NOM' => $model->CALI_NOM]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Califica model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $CALI_ID
     * @param string $CALI_NOM
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($CALI_ID, $CALI_NOM)
    {
        $this->findModel($CALI_ID, $CALI_NOM)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Califica model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $CALI_ID
     * @param string $CALI_NOM
     * @return Califica the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($CALI_ID, $CALI_NOM)
    {
        if (($model = Califica::findOne(['CALI_ID' => $CALI_ID, 'CALI_NOM' => $CALI_NOM])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
