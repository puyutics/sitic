<?php

namespace app\controllers\onlycontrol;

use Yii;
use app\models\onlycontrol\NewCredencial;
use app\models\onlycontrol\NewCredencialSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NewcredencialController implements the CRUD actions for NewCredencial model.
 */
class NewcredencialController extends Controller
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
     * Lists all NewCredencial models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewCredencialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NewCredencial model.
     * @param string $CR_FIMPRESION
     * @param string $CR_ID
     * @param string $CR_RESULTADO
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($CR_FIMPRESION, $CR_ID, $CR_RESULTADO)
    {
        return $this->render('view', [
            'model' => $this->findModel($CR_FIMPRESION, $CR_ID, $CR_RESULTADO),
        ]);
    }

    /**
     * Creates a new NewCredencial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NewCredencial();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'CR_FIMPRESION' => $model->CR_FIMPRESION, 'CR_ID' => $model->CR_ID, 'CR_RESULTADO' => $model->CR_RESULTADO]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NewCredencial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $CR_FIMPRESION
     * @param string $CR_ID
     * @param string $CR_RESULTADO
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($CR_FIMPRESION, $CR_ID, $CR_RESULTADO)
    {
        $model = $this->findModel($CR_FIMPRESION, $CR_ID, $CR_RESULTADO);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'CR_FIMPRESION' => $model->CR_FIMPRESION, 'CR_ID' => $model->CR_ID, 'CR_RESULTADO' => $model->CR_RESULTADO]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NewCredencial model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $CR_FIMPRESION
     * @param string $CR_ID
     * @param string $CR_RESULTADO
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($CR_FIMPRESION, $CR_ID, $CR_RESULTADO)
    {
        $this->findModel($CR_FIMPRESION, $CR_ID, $CR_RESULTADO)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NewCredencial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $CR_FIMPRESION
     * @param string $CR_ID
     * @param string $CR_RESULTADO
     * @return NewCredencial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($CR_FIMPRESION, $CR_ID, $CR_RESULTADO)
    {
        if (($model = NewCredencial::findOne(['CR_FIMPRESION' => $CR_FIMPRESION, 'CR_ID' => $CR_ID, 'CR_RESULTADO' => $CR_RESULTADO])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
