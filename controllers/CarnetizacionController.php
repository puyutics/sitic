<?php

namespace app\controllers;

use app\models\Logs;
use Yii;
use app\models\Carnetizacion;
use app\models\CarnetizacionSearch;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CarnetizacionController implements the CRUD actions for Carnetizacion model.
 */
class CarnetizacionController extends Controller
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
                    'fixcarnet','reportegrafico'],
                'rules' => [
                    [
                        'actions' => ['create','index','update','view',
                            'fixcarnet','reportegrafico'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['update','index'],
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
     * Lists all Carnetizacion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CarnetizacionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = [
            'fec_registro' => SORT_DESC,
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Carnetizacion model.
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
     * Creates a new Carnetizacion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Carnetizacion();
        $username = Yii::$app->user->identity->username;
        $user_profile = \app\models\UserProfile::find()
            ->where(['username' => $username])
            ->one();
        if (isset($user_profile)) {
            $dni = $user_profile->dni;
        }
        if (isset($_GET['dni'])) {
            $dni = $_GET['dni'];
        }

        //Verificar si existe el perfil de estudiante de pregrado
        $estudiante = \app\models\Estudiantes::find()
            ->where(['CIInfPer' => $dni])
            ->orWhere(['cedula_pasaporte' => $dni])
            ->one();
        if (isset($estudiante)) {
            //Verificar si es un usuario activo
            if ($estudiante->statusper == 1) {
                //Verificar si tiene una matrícula vigente
                $periodo = \app\models\Periodo::getUltimoPeriodoActivo();
                $periodoDescriptivo = \app\models\Periodo::Periododescriptivo($periodo);
                $matricula = \app\models\Matricula::find()
                    ->where(['CIInfPer' => $estudiante->CIInfPer])
                    ->andWhere(['idPer' => $periodo])
                    ->andWhere(['statusMatricula' => 'APROBADA'])
                    ->one();
                $periodolectivo = \app\models\Periodo::find()
                    ->where(['idper' => $periodo])
                    ->one();
                if (isset($matricula)) {
                    $model->username = $username;
                    $model->CIInfPer = $estudiante->CIInfPer;
                    $model->cedula_pasaporte = $estudiante->cedula_pasaporte;
                    $model->TipoDocInfPer = $estudiante->TipoDocInfPer;
                    $model->ApellInfPer = $estudiante->ApellInfPer;
                    $model->ApellMatInfPer = $estudiante->ApellMatInfPer;
                    $model->NombInfPer = $estudiante->NombInfPer;
                    $model->FechNacimPer = $estudiante->FechNacimPer;
                    $model->mailInst = $estudiante->mailInst;
                    $model->fotografia = $estudiante->fotografia;
                    $model->idMatricula = $matricula->idMatricula;
                    $model->idCarr = $matricula->idCarr;
                    $model->idPer = $matricula->idPer;
                    $model->fechfinalperlec = $periodolectivo->fechfinalperlec;
                    $model->filefolder = 'uploads/carnetizacion/' . $periodo . '/';
                    $model->filename = 'carnet_' . $periodo . '_' . $dni;
                    $model->filetype = '.pdf';

                    //Verificar registro BD duplicado
                    $carnetizacion = \app\models\Carnetizacion::find()
                        ->where(['CIInfPer' => $model->CIInfPer])
                        ->andWhere(['idPer' => $model->idPer])
                        ->one();

                    if (isset($carnetizacion)) {
                        return $this->redirect(['view', 'id' => base64_encode($carnetizacion->id)]);
                    }

                    if ($model->load(Yii::$app->request->post())) {
                        $model->fec_registro = date('Y-m-d H:i:s');

                        if ($model->save()) {
                            //Crear Registro de Log en la base de datos
                            $description =
                                'Nuevo Carnet Digital Generado: ' . $model->cedula_pasaporte .
                                '. Estudiante: ' . $model->ApellInfPer . ' ' . $model->ApellMatInfPer . ' ' . $model->NombInfPer .
                                '. Email Institucional: ' . $model->mailInst .
                                '. Periodo: ' . $periodoDescriptivo .
                                '. Válido hasta: ' . $model->fechfinalperlec
                            ;
                            $this->saveLog('carnetizacionCreate', $username, $description, $model->id,'carnetizacion');

                            //Verificar si la carpeta existe
                            $filefolder = $model->filefolder;
                            if (!file_exists($filefolder)) {
                                mkdir($filefolder, 0755, true);
                            }
                            //Generar el carnet en PDF
                            $this->generarCarnet($model);

                            //Enviar carnet digital por email
                            $this->enviarCarnet($model);

                            return $this->redirect(['view', 'id' => base64_encode($model->id)]);
                        }
                    }
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionFixcarnet($id)
    {
        $id = base64_decode($id);
        $model = \app\models\Carnetizacion::findOne($id);

        //Generar el carnet en PDF
        $this->generarCarnet($model);

        //Enviar carnet digital por email
        $this->enviarCarnet($model);

        return $this->redirect(['view', 'id' => base64_encode($model->id)]);
    }

    public function actionReportegrafico()
    {
        return $this->render('_reportegrafico');
    }

    public function generarCarnet($model)
    {
        $pdf = Yii::$app->pdf;
        $pdf->filename = $model->filefolder . $model->filename . $model->filetype;
        $pdf->format = [100,160];
        $pdf->marginLeft = 0;
        $pdf->marginTop = 0;
        $pdf->marginRight = 0;
        $pdf->marginBottom = 0;
        $css = '.circular {
                    border-radius: 50px
                }';
        $pdf->cssInline = $css;
        $pdf->content = $this->renderPartial('_carnet', [
            'model' => $model,
        ]);
        $pdf->tempPath = Yii::getAlias('@web/runtime/mpdf/');
        $pdf->options = [
            'title' => 'Carnet Estudiantil',
            'subject' => 'Carnet Estudiantil',
        ];
        return $pdf->render();
    }

    public function enviarCarnet($model)
    {
        $url = Url::to('@web/index.php?r=carnetizacion/view&id='.base64_encode($model->id), 'https');
        $body =
            "Estimado estudiante," . "\n" .
            "Se ha generado su carnet digital de forma exitosa.\n\n" .
            "Cédula / Pasaporte: " . $model->cedula_pasaporte . "\n" .
            "Nombres Completos: " . $model->ApellInfPer . ' ' . $model->ApellMatInfPer . ' ' . $model->NombInfPer . "\n" .
            "--------------------------------------------------------------------------------------" . "\n" .
            "Haga clic en el siguiente enlace para visualizar, descargar o imprimir su carnet digital:" . "\n\n" .
            Url::to($url) . "\n\n" .
            "--------------------------------------------------------------------------------------" . "\n" .
            "---> Correo enviado por el Sistema Integrado de Tecnologías de la Información y Comunicación | SITIC. 
            NO RESPONDA ESTE CORREO <---"
        ;

        Yii::$app->mailer->compose()
            ->setTo($model->mailInst)
            ->setFrom('identidad@uea.edu.ec')
            ->setSubject("UEA | Carnet Digital")
            ->setTextBody($body)
            ->attach($model->filefolder . $model->filename . $model->filetype)
            ->send();
        return true;
    }

    /**
     * Updates an existing Carnetizacion model.
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
     * Deletes an existing Carnetizacion model.
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
     * Finds the Carnetizacion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Carnetizacion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Carnetizacion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function saveLog($type, $username, $description, $external_id, $external_type)
    {
        //Registro (Log) Evento sendToken
        $modelLogs              = new Logs();
        $modelLogs->type        = $type;
        $modelLogs->username    = $username;
        $modelLogs->datetime    = date('Y-m-d H:i:s');
        $modelLogs->description = $description;
        $modelLogs->ipaddress       = \app\models\User::obtenerip();
        $modelLogs->external_id     = $external_id;
        $modelLogs->external_type   = $external_type;
        $modelLogs->save(false);
    }
}
