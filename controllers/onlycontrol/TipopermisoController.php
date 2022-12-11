<?php

namespace app\controllers\onlycontrol;

use Yii;
use app\models\onlycontrol\TipoPermiso;
use app\models\onlycontrol\TipoPermisoSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TipopermisoController implements the CRUD actions for TipoPermiso model.
 */
class TipopermisoController extends Controller
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
     * Lists all TipoPermiso models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TipoPermisoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TipoPermiso model.
     * @param string $TIPO_ID
     * @param string $TIPO_NOM
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($TIPO_ID, $TIPO_NOM)
    {
        return $this->render('view', [
            'model' => $this->findModel($TIPO_ID, $TIPO_NOM),
        ]);
    }

    /**
     * Creates a new TipoPermiso model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TipoPermiso();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'TIPO_ID' => $model->TIPO_ID, 'TIPO_NOM' => $model->TIPO_NOM]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TipoPermiso model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $TIPO_ID
     * @param string $TIPO_NOM
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($TIPO_ID, $TIPO_NOM)
    {
        $model = $this->findModel($TIPO_ID, $TIPO_NOM);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'TIPO_ID' => $model->TIPO_ID, 'TIPO_NOM' => $model->TIPO_NOM]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TipoPermiso model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $TIPO_ID
     * @param string $TIPO_NOM
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($TIPO_ID, $TIPO_NOM)
    {
        $this->findModel($TIPO_ID, $TIPO_NOM)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TipoPermiso model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $TIPO_ID
     * @param string $TIPO_NOM
     * @return TipoPermiso the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($TIPO_ID, $TIPO_NOM)
    {
        if (($model = TipoPermiso::findOne(['TIPO_ID' => $TIPO_ID, 'TIPO_NOM' => $TIPO_NOM])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
