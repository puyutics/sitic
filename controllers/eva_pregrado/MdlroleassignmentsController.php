<?php

namespace app\controllers\eva_pregrado;

use Yii;
use app\models\eva_pregrado\MdlRoleAssignments;
use app\models\eva_pregrado\MdlRoleAssignmentsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MdlroleassignmentsController implements the CRUD actions for MdlRoleAssignments model.
 */
class MdlroleassignmentsController extends Controller
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
                    'mdlenrolsync','mdlcourseview','mdlcoursesync','siad2eva',
                    'logs'],
                'rules' => [
                    [
                        'actions' => ['index','mdlenrolsync','mdlcoursesync',
                            'mdlcourseview','siad2eva','logs'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['index','mdlenrolsync','mdlcoursesync',
                            'mdlcourseview','siad2eva','logs'],
                        'allow' => true,
                        'roles' => ['rolTecnicos'],
                    ],
                    [
                        'actions' => ['mdlenrolsync','delete','update','view'],
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
     * Lists all MdlRoleAssignments models.
     * @return mixed
     */
    public function actionIndex($role = NULL)
    {
        $searchModel = new MdlRoleAssignmentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($role != NULL) {
            if ($role == 'teacher') {
                $dataProvider->query->Where(['roleid' => 3]);
                $dataProvider->query->orWhere(['roleid' => 4]);
            }
            if ($role == 'student') {
                $dataProvider->query->Where(['roleid' => 5]);
            }
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionMdlenrolsync()
    {
        return $this->render('_mdl_enrol_sync');
    }


    public function actionLogs()
    {
        return $this->render('_mdl_enrol_logs');
    }


    public function actionMdlcourseview()
    {
        return $this->render('_mdl_course_view');
    }


    public function actionMdlcoursesync()
    {
        return $this->render('_mdl_course_sync');
    }

    /**
     * Displays a single MdlRoleAssignments model.
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
     * Creates a new MdlRoleAssignments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new MdlRoleAssignments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing MdlRoleAssignments model.
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
     * Deletes an existing MdlRoleAssignments model.
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
     * Finds the MdlRoleAssignments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MdlRoleAssignments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MdlRoleAssignments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
