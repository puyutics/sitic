<?php

namespace app\controllers;

use Yii;
use app\models\CcppProveedorCategoria;
use app\models\CcppProveedorCategoriaSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CcppproveedorcategoriaController implements the CRUD actions for CcppProveedorCategoria model.
 */
class CcppproveedorcategoriaController extends Controller
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
                        'actions' => ['create','index','view'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['update','index','view'],
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
     * Lists all CcppProveedorCategoria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CcppProveedorCategoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CcppProveedorCategoria model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CcppProveedorCategoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($ccpp_proveedor_id)
    {
        $ccpp_proveedor_id = base64_decode($ccpp_proveedor_id);

        $model = new CcppProveedorCategoria();
        $model->ccpp_proveedor_id = $ccpp_proveedor_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['ccppproveedor/admin', 'id' => base64_encode($model->ccpp_proveedor_id)]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CcppProveedorCategoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CcppProveedorCategoria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CcppProveedorCategoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CcppProveedorCategoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CcppProveedorCategoria::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
