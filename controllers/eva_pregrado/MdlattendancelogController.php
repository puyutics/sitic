<?php

namespace app\controllers\eva_pregrado;

use Yii;
use app\models\eva_pregrado\MdlAttendanceLog;
use app\models\eva_pregrado\MdlAttendanceLogSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MdlattendancelogController implements the CRUD actions for MdlAttendanceLog model.
 */
class MdlattendancelogController extends Controller
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
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['rolTecnicos'],
                    ],
                    [
                        'actions' => ['create','delete','update','view'],
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
     * Lists all MdlAttendanceLog models.
     * @return mixed
     */
    public function actionIndex($mdl_attendance_sessions_id = NULL)
    {
        $searchModel = new MdlAttendanceLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($mdl_attendance_sessions_id != NULL) {
            $mdl_attendance_sessions_id = base64_decode($mdl_attendance_sessions_id);
            $dataProvider->query->Where(['sessionid' => $mdl_attendance_sessions_id]);
            $countDataProvider = $dataProvider->getTotalCount();
            $dataProvider->pagination = ['pageSize' => $countDataProvider];
        }
        $dataProvider->sort->defaultOrder = [
            'sessionid' => SORT_ASC,
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MdlAttendanceLog model.
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
     * Creates a new MdlAttendanceLog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MdlAttendanceLog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MdlAttendanceLog model.
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
     * Deletes an existing MdlAttendanceLog model.
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
     * Finds the MdlAttendanceLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MdlAttendanceLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MdlAttendanceLog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
