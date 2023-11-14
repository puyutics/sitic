<?php

namespace app\controllers\onlycontrol;

use Yii;
use app\models\Logs;
use app\models\onlycontrol\PuertaSta;
use app\models\onlycontrol\NomPuerta;
use app\models\onlycontrol\NomPuertaDel;
use app\models\onlycontrol\NomPuertaSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NompuertaController implements the CRUD actions for NomPuerta model.
 */
class NompuertaController extends Controller
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
                    'indexuser','indexpuerta','revoca'],
                'rules' => [
                    [
                        'actions' => ['index','view','create','indexuser',
                            'indexpuerta','revoca'],
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
     * Lists all NomPuerta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NomPuertaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = ['TURN_NOW' => SORT_DESC,];
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexuser($oc_user_id)
    {
        $oc_user_id = base64_decode($oc_user_id);
        $searchModel = new NomPuertaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->Where(['NOM_ID' => $oc_user_id]);
        $dataProvider->sort->defaultOrder = ['TURN_NOW' => SORT_DESC,];
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index_user', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexpuerta($oc_zona)
    {
        $oc_zona = base64_decode($oc_zona);
        $searchModel = new NomPuertaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->Where(['PUER_ID' => $oc_zona]);
        $dataProvider->sort->defaultOrder = ['TURN_NOW' => SORT_DESC,];
        $dataProvider->pagination = ['pageSize' => 50];

        return $this->render('index_puerta', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NomPuerta model.
     * @param string $NOM_ID
     * @param string $PUER_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($NOM_ID, $PUER_ID)
    {
        return $this->render('view', [
            'model' => $this->findModel($NOM_ID, $PUER_ID),
        ]);
    }

    /**
     * Creates a new NomPuerta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($oc_user_id)
    {
        $oc_user_id = base64_decode($oc_user_id);
        $model = new NomPuerta();

        if ($model->load(Yii::$app->request->post())) {
            $puertas_id = $model->nomPuertas;
            foreach ($puertas_id as $puerta_id) {
                $model_new = new NomPuerta();
                $model_new->NOM_ID = $oc_user_id;
                $model_new->PUER_ID = $puerta_id;

                //Check registro existente
                $nomPuerta = \app\models\onlycontrol\NomPuerta::find()
                    ->where(['NOM_ID' => $model_new->NOM_ID])
                    ->andWhere(['PUER_ID' => $model_new->PUER_ID])
                    ->one();

                if (!isset($nomPuerta)) {
                    $oc_user = \app\models\onlycontrol\Nomina::findOne($oc_user_id);
                    $nomina_fing = $oc_user->NOMINA_FING;
                    $nomina_fsal = $oc_user->NOMINA_FSAL;
                    $model_new->TURN_ID = 0;
                    if ($nomina_fing != NULL) {
                        $model_new->TURN_FECI = date('Ymd 00:00:00.000', strtotime($nomina_fing));
                    } else {
                        $model_new->TURN_FECI = date('Ymd 00:00:00.000');
                    }
                    if ($nomina_fsal != NULL) {
                        $model_new->TURN_FECF = date('Ymd 00:00:00.000', strtotime($nomina_fsal));
                    } else {
                        $fecha_actual = date('Ymd 00:00:00.000');
                        $model_new->TURN_FECF = date('Ymd 00:00:00.000', strtotime($fecha_actual."+ 1 year"));
                    }
                    $model_new->TURN_TIPO = 1;
                    $model_new->TURN_STA = 0; //0 Control Activo 1 Sin Control
                    $model_new->TURN_NOW = date('Ymd H:i:s.000');
                    $model_new->TURN_MARCA = 8; //4 PyC - 8 RF
                    $model_new->TURN_TCOD = 'RF'; //4 PyC - 8 RF
                    $model_new->TURN_SEL = '0';
                    $model_new->TURN_ESTADO_UP = 0;
                    $model_new->TURN_FECHA_UP = NULL;
                    $model_new->ES_SINCRONIZADO = 0;
                    $model_new->ES_UPDATE = 1;
                    $model_new->TURN_CONFSIMILAR = 0;

                    if ($model_new->save(false)) {
                        //Agregar log al servidor OnlyControl
                        $modelPuertaSta = new PuertaSta();
                        $fecha_inicio = date('d/m/Y',strtotime($model_new->TURN_FECI));
                        $fecha_fin = date('d/m/Y',strtotime($model_new->TURN_FECF));
                        $modelPuertaSta->P_ID = $_SERVER['SERVER_ADDR'];
                        $modelPuertaSta->P_Fecha = $model_new->TURN_NOW ;
                        $modelPuertaSta->P_Status = 'Otorga Acceso Zona: '.$model_new->PUER_ID.' Usuario: '.$model_new->NOM_ID.' -> Tipo Permiso: LIBRE / Rango de Fechas: '.$fecha_inicio.' - '.$fecha_fin.' / Modo Marcacion: '.$model_new->TURN_TCOD.' / Horario: LIBRE 00:00 - 23:59';
                        $modelPuertaSta->P_User = '999998';
                        $modelPuertaSta->P_Maq = 'sitic';
                        $modelPuertaSta->save();

                        //Eliminar puerta eliminada
                        $nomPuertaDel = \app\models\onlycontrol\NomPuertaDel::find()
                            ->where(['NOM_ID' => $model_new->NOM_ID])
                            ->andWhere(['PUER_ID' => $model_new->PUER_ID])
                            ->one();
                        if (isset($nomPuertaDel)) {
                            $nomPuertaDel->delete();
                        }

                        //Crear Registro de Log en la base de datos
                        $external_id = $model_new->NOM_ID.'@'.$model_new->PUER_ID;
                        $description = $modelPuertaSta->P_Status;
                        $username = Yii::$app->user->identity->username;
                        $this->saveLog('onlycontrolNompuertaCreate', $username, $description, $external_id,'onlycontrol/nompuerta');
                    }
                }
            }
            return $this->redirect(['onlycontrol/nompuerta/indexuser',
                'oc_user_id' => base64_encode($model_new->NOM_ID),
            ]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionRevoca($oc_user_id, $oc_puerta_id)
    {
        $oc_user_id = base64_decode($oc_user_id);
        $oc_puerta_id = base64_decode($oc_puerta_id);
        $model = $this->findModel($oc_user_id, $oc_puerta_id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->delete()) {
                //Registra puerta eliminada
                $nomPuertaDel = NomPuertaDel::find()
                    ->where(['NOM_ID' => $oc_user_id])
                    ->andWhere((['PUER_ID' => $oc_puerta_id]))
                    ->one();
                if (!isset($nomPuertaDel)) {
                    $modelNomPuertaDel = new NomPuertaDel();
                    $modelNomPuertaDel->NOM_ID = $oc_user_id;
                    $modelNomPuertaDel->PUER_ID = $oc_puerta_id;
                    $modelNomPuertaDel->FLAG_T = 0;
                    $modelNomPuertaDel->TURN_ESTADO_DEL = 1;
                    $modelNomPuertaDel->TURN_FECHA_DEL = date('Ymd H:i:s.000');
                    $modelNomPuertaDel->save();
                } else {
                    $modelNomPuertaDel = $nomPuertaDel;
                    $modelNomPuertaDel->TURN_ESTADO_DEL = 1;
                    $modelNomPuertaDel->TURN_FECHA_DEL = date('Ymd H:i:s.000');
                    $modelNomPuertaDel->save();
                }

                //Agregar log al servidor OnlyControl
                $modelPuertaSta = new PuertaSta();
                $modelPuertaSta->P_ID = $_SERVER['SERVER_ADDR'];
                $modelPuertaSta->P_Fecha = $modelNomPuertaDel->TURN_FECHA_DEL;
                $modelPuertaSta->P_Status = 'Revoca Acceso Zona: '.$model->PUER_ID.' Usuario: '.$model->NOM_ID;
                $modelPuertaSta->P_User = '999998';
                $modelPuertaSta->P_Maq = 'sitic';
                $modelPuertaSta->save();

                //Crear Registro de Log en la base de datos
                $external_id = $model->NOM_ID.'@'.$model->PUER_ID;
                $description = $modelPuertaSta->P_Status;
                $username = Yii::$app->user->identity->username;
                $this->saveLog('onlycontrolNompuertaRevoca', $username, $description, $external_id,'onlycontrol/nompuerta');

                return $this->redirect(['onlycontrol/nompuerta/indexuser',
                    'oc_user_id' => base64_encode($model->NOM_ID),
                ]);

            }

            Yii::$app->session->setFlash('error',
                'Registro Eliminado');
        }
        return $this->render('revoca', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NomPuerta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $NOM_ID
     * @param string $PUER_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($NOM_ID, $PUER_ID)
    {
        $model = $this->findModel($NOM_ID, $PUER_ID);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'NOM_ID' => $model->NOM_ID, 'PUER_ID' => $model->PUER_ID]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NomPuerta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $NOM_ID
     * @param string $PUER_ID
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($NOM_ID, $PUER_ID)
    {
        $this->findModel($NOM_ID, $PUER_ID)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NomPuerta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $NOM_ID
     * @param string $PUER_ID
     * @return NomPuerta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($NOM_ID, $PUER_ID)
    {
        if (($model = NomPuerta::findOne(['NOM_ID' => $NOM_ID, 'PUER_ID' => $PUER_ID])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function saveLog($type, $username, $description, $external_id, $external_type)
    {
        //Registro (Log) Evento
        $modelLogs              = new Logs();
        $modelLogs->type        = $type;
        $modelLogs->username    = $username;
        $modelLogs->datetime    = date('Y-m-d H:i:s');
        $modelLogs->description = $description;
        ;
        $modelLogs->ipaddress       = \app\models\User::obtenerip();
        $modelLogs->external_id     = $external_id;
        $modelLogs->external_type   = $external_type;
        $modelLogs->save(false);
    }
}
