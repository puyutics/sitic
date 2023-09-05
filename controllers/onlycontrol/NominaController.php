<?php

namespace app\controllers\onlycontrol;

use Yii;
use app\models\onlycontrol\Nomina;
use app\models\onlycontrol\NominaSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NominaController implements the CRUD actions for Nomina model.
 */
class NominaController extends Controller
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
                    'profile','clearstudents'],
                'rules' => [
                    [
                        'actions' => ['index','view','profile','clearstudents'],
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
     * Lists all Nomina models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NominaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = [
            'NOMINA_AREA1' => SORT_ASC,
            'NOMINA_DEP1' => SORT_ASC,
            'NOMINA_APE' => SORT_ASC,
            'NOMINA_NOM' => SORT_ASC,
        ];
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Nomina model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionClearstudents()
    {
        return $this->render('clear_students');
    }

    public function actionProfile($oc_user_id)
    {
        $id = base64_decode($oc_user_id);
        return $this->render('profile', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Nomina model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Nomina();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->NOMINA_ID]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Nomina model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->NOMINA_ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Nomina model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Nomina model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Nomina the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Nomina::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
