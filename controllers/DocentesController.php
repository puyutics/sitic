<?php

namespace app\controllers;

use Yii;
use app\models\Docentes;
use app\models\DocentesSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocentesController implements the CRUD actions for Docentes model.
 */
class DocentesController extends Controller
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
                        'actions' => ['index','update','view'],
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
     * Lists all Docentes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocentesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Docentes model.
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

    /**
     * Creates a new Docentes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Docentes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->CIInfPer]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Docentes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $dominio= explode("@", $model->mailInst);
            $dominio = $dominio[1];
            $modelDocente = $this->findModel($id);
            $log = '';
            if (($modelDocente->mailInst != $model->mailInst) and ($dominio == 'uea.edu.ec')) {
                $log = $log . '(SIAD Docente) Correo Institucional: ' . $modelDocente->mailInst
                    . ' -> ' . $model->mailInst;

                if ($modelDocente->StatusPer != $model->StatusPer) {
                    $log = $log . '. (SIAD Docente) Estado: ' . $modelDocente->StatusPer
                        . ' -> ' . $model->StatusPer;
                }

                //Crear Registro de Log en la base de datos
                $description =
                    'Información actualizada del usuario: ' . $model->CIInfPer
                    . '. ' . $log
                ;

                $username = Yii::$app->user->identity->username;
                $external_id = explode("@", $model->mailInst);
                $external_id = $external_id[0];

                if ($model->save()) {
                    $this->saveLog('siadDoceneteEmail', $username, $description, $external_id,'adldap');
                    return $this->redirect(['adldap/edituser', 'search' => $model->cedula_pasaporte]);
                }
            }

            if ($modelDocente->StatusPer != $model->StatusPer) {
                $log = $log . '(SIAD Docente) Estado: ' . $modelDocente->StatusPer
                    . ' -> ' . $model->StatusPer;

                //Crear Registro de Log en la base de datos
                $description =
                    'Información actualizada del usuario: ' . $model->CIInfPer
                    . '. ' . $log
                ;
                $username = Yii::$app->user->identity->username;
                $external_id = explode("@", $model->mailInst);
                $external_id = $external_id[0];

                if ($model->save(false)) {
                    $this->saveLog('siadDoceneteStatus', $username, $description, $external_id,'adldap');
                    return $this->redirect(['adldap/edituser', 'search' => $model->cedula_pasaporte]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Docentes model.
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
     * Finds the Docentes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Docentes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Docentes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
