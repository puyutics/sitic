<?php

namespace app\controllers;

use Yii;
use app\models\SysEmail;
use app\models\SysEmailSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SysemailController implements the CRUD actions for SysEmail model.
 */
class SysemailController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','delete','index','update','send','sendadldapgroup','view'],
                'rules' => [
                    [
                        'actions' => ['create','index','update','send','sendadldapgroup',
                            'view'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['view','create','index','update','send'],
                        'allow' => true,
                        'roles' => ['@'],
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
     * Lists all SysEmail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SysEmailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SysEmail model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $id = base64_decode($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SysEmail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SysEmail();

        if ($model->load(Yii::$app->request->post())) {
            $model->datetime = date('Y-m-d H:i:s');
            $model->to = json_encode($model->to);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => base64_encode($model->id)]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SysEmail model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);
        $model->to = json_decode($model->to);

        if ($model->load(Yii::$app->request->post())) {
            $model->datetime = date('Y-m-d H:i:s');
            $model->to = json_encode($model->to);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => base64_encode($model->id)]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SysEmail model.
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
     * Finds the SysEmail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SysEmail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SysEmail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionSend($id,$type)
    {
        $id = base64_decode($id);
        $type = base64_decode($type);

        //Datos
        $model = $this->findModel($id);
        $head = $this->renderPartial('_head');
        $footer = $this->renderPartial('_footer');

        return $this->render('send', [
            'model' => $model,
            'type' => $type,
            'head' => $head,
            'footer' => $footer,
        ]);

    }

    public function actionSendadldapgroup($id)
    {
        $id = base64_decode($id);
        $model = $this->findModel($id);

        $head = $this->renderPartial('_head');
        $footer = $this->renderPartial('_footer');


    }

}
