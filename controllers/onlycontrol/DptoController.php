<?php

namespace app\controllers\onlycontrol;

use Yii;
use app\models\onlycontrol\Dpto;
use app\models\onlycontrol\DptoSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DptoController implements the CRUD actions for Dpto model.
 */
class DptoController extends Controller
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
     * Lists all Dpto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DptoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dpto model.
     * @param string $DEP_ID
     * @param string $DEP_NOM
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($DEP_ID, $DEP_NOM)
    {
        return $this->render('view', [
            'model' => $this->findModel($DEP_ID, $DEP_NOM),
        ]);
    }

    /**
     * Creates a new Dpto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dpto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'DEP_ID' => $model->DEP_ID, 'DEP_NOM' => $model->DEP_NOM]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Dpto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $DEP_ID
     * @param string $DEP_NOM
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($DEP_ID, $DEP_NOM)
    {
        $model = $this->findModel($DEP_ID, $DEP_NOM);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'DEP_ID' => $model->DEP_ID, 'DEP_NOM' => $model->DEP_NOM]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Dpto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $DEP_ID
     * @param string $DEP_NOM
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($DEP_ID, $DEP_NOM)
    {
        $this->findModel($DEP_ID, $DEP_NOM)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Dpto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $DEP_ID
     * @param string $DEP_NOM
     * @return Dpto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($DEP_ID, $DEP_NOM)
    {
        if (($model = Dpto::findOne(['DEP_ID' => $DEP_ID, 'DEP_NOM' => $DEP_NOM])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
