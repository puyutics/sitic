<?php

namespace app\controllers;

use Yii;
use app\models\TabIntFormulario;
use app\models\TabIntFormularioSearch;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;
use Da\QrCode\QrCode;

/**
 * TabintformularioController implements the CRUD actions for TabIntFormulario model.
 */
class TabintformularioController extends Controller
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
                    'admin','beneficiario','beneficiarioadmin','contrato',
                    'reporte','reportegrafico','estatus'],
                'rules' => [
                    [
                        'actions' => ['create','index','view',
                            'admin','beneficiario','beneficiarioadmin',
                            'contrato','reporte','reportegrafico','estatus'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['index','estatus'],
                        'allow' => true,
                        'roles' => ['rolTecnicos'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['view','beneficiario'],
                        'allow' => true,
                        'roles' => ['@'],
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
     * Lists all TabIntFormulario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TabIntFormularioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $countDataProvider = $dataProvider->getTotalCount();
        $dataProvider->pagination = ['pageSize' => $countDataProvider];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexcge()
    {
        $searchModel = new TabIntFormularioSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $countDataProvider = $dataProvider->getTotalCount();
        $dataProvider->pagination = ['pageSize' => $countDataProvider];
        $dataProvider->sort->defaultOrder = ['apellidos' => SORT_ASC , 'nombres' => SORT_ASC];

        return $this->render('indexcge', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TabIntFormulario model.
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


    public function actionAdmin($id)
    {
        return $this->render('admin', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionBeneficiario()
    {
        if (isset(Yii::$app->user->identity->username)
            and (Yii::$app->session->get('authtype') == 'adldap')) {

            $model = new \app\models\AdldapEditForm();
            $sAMAccountname = Yii::$app->user->identity->username;
            $user = Yii::$app->ad->getProvider('default')->search()
                ->findBy('sAMAccountname', $sAMAccountname);

            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);
            }

            $model->dni = $user->getAttribute(Yii::$app->params['dni'],0);
            $model->firstname = $user->getFirstName();
            $model->lastname = $user->getLastName();
            $model->commonname = $user->getCommonName();
            $model->displayname = $user->getDisplayName();
            $model->mail = $user->getEmail();
            $model->personalmail = $user->getAttribute(Yii::$app->params['personalmail'], 0);
            $model->mobile = $user->getAttribute(Yii::$app->params['mobile'], 0);
            $model->title = $user->getTitle();
            $model->department = $user->getDepartment();
            $model->groups = $user->getGroups();
            $model->dn = $user->getDn();
            $model->uac = $user->getUserAccountControl();

            return $this->render('beneficiario',
                ['model'=>$model]);

        } else {
            return $this->redirect('index.php?r=site/identity');
        }
    }


    public function actionBeneficiarioadmin()
    {

        $model = new \app\models\AdldapEditForm();

        if (Yii::$app->request->post('searchButton')==='searchButton'
            and (Yii::$app->session->get('authtype') == 'adldap')) {
            $post_data = $_POST['AdldapEditForm'];
            if ($post_data['search'] != '') {
                return $this->redirect(
                    'index.php?r=tabintformulario/beneficiarioadmin&search='
                    . $post_data['search']);
            } else {
                Yii::$app->session->setFlash('error',
                    "Buscar no puede estar en blanco");
                return $this->render('_admin_beneficiario',
                    ['model'=>$model]);
            }

        }

        if (isset($_GET['search'])
            and (Yii::$app->session->get('authtype') == 'adldap')) {
            $search = $_GET['search'];
            $user = Yii::$app->ad->getProvider('default')->search()->users()->find($search);

            if (isset($user)) {
                $sAMAccountname = $user->getAttribute('samaccountname',0);
                $model->dni = $user->getAttribute(Yii::$app->params['dni'],0);
                $model->firstname = $user->getFirstName();
                $model->lastname = $user->getLastName();
                $model->mail = $user->getEmail();
                $model->commonname = $user->getAttribute('cn',0);
                $model->displayname = $user->getDisplayName();
                $model->personalmail = $user->getAttribute(Yii::$app->params['personalmail'], 0);
                $model->mobile = $user->getAttribute(Yii::$app->params['mobile'], 0);
                $model->groups = $user->getGroups();
                $model->dn = $user->getDn();
                $model->uac = $user->getUserAccountControl();
                $model->department = $user->getDepartment();
                $model->title = $user->getTitle();
                $model->samaccountname = $user->getAttribute('samaccountname',0);

                return $this->render('_admin_beneficiario',
                    ['model'=>$model]);

            } else {
                Yii::$app->session->setFlash('error',
                    "No se encontraron resultados");
                return $this->render('_admin_beneficiario',
                    ['model'=>$model]);
            }
        } else {
            return $this->render('_admin_beneficiario',
                ['model'=>$model]);
        }
    }


    /**
     * Creates a new TabIntFormulario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TabIntFormulario();
        if ($model->load(Yii::$app->request->post())) {
            $model->upload_cedula_pasaporte = UploadedFile::getInstance($model, 'upload_cedula_pasaporte');
            $model->upload_servicio_basico = UploadedFile::getInstance($model, 'upload_servicio_basico');
            $model->upload_referencia_foto = UploadedFile::getInstance($model, 'upload_referencia_foto');

            $model->doc_cedula_pasaporte = 'cp_' . md5($model->cedula) . '.' . $model->upload_cedula_pasaporte->extension;
            $model->doc_servicio_basico = 'sb_' . md5($model->cedula) . '.' . $model->upload_servicio_basico->extension;
            $model->referencia_foto = 'rf_' . md5($model->cedula) . '.' . $model->upload_referencia_foto->extension;
            $model->doc_responsabilidad_uso = 'ru_' . md5($model->cedula) . '.pdf';
            $model->doc_contrato = 'dc_' . md5($model->cedula) . '.pdf';
            $model->qrcode = 'qr_' . md5($model->cedula) . '.png';
            $model->fec_registro = date('Y-m-d H:i:s');
            $model->status = 1;

            if ($model->uploadDocumentos($model)){
                if ($model->save()) {

                    //Crear Código QR
                    $url = Url::to('@web/uploads/tabintformulario/contrato/', 'https');
                    $filename = $model->qrcode;
                    $this->generarQRcode($url,$filename);

                    //if (strcmp($model->encuesta_beneficiario ,'TABLET e Internet Educativo Ilimitado') == 1) {
                    if ($model->encuesta_beneficiario == 'TABLET e Internet Educativo Ilimitado') {
                        //Asignar 1 Tablet
                        $inv_item_user_id = $this->asignarTablet(
                            $model->username,
                            $model->email,
                            $model->cedula,
                            $model->nombres,
                            $model->apellidos
                        );

                        //Crear Contrato en PDF
                        $this->generarContratoTablet($model->getPrimaryKey(), $url, $inv_item_user_id);

                        //Registro (Log) Evento
                        $username = $model->username;
                        $external_id = $model->getPrimaryKey();
                        $description = "Contrato de préstamo de Tablet generado. Usuario: "
                            . $model->email . ". Cédula / Pasaporte: " . $model->cedula . ". Nombre: " .  $model->nombres
                            . " " . $model->apellidos;
                        $this->saveLog('contratoTablet', $username, $description,  $external_id, 'tabintformulario');

                    } elseif ($model->encuesta_beneficiario == 'Internet Educativo Ilimitado') {
                        //Crear Contrato en PDF
                        $this->generarContratoInternet($model->getPrimaryKey(), $url);

                        //Registro (Log) Evento
                        $username = $model->username;
                        $external_id = $model->getPrimaryKey();
                        $description = "Contrato de Internet Educativo generado. Usuario: "
                            . $model->email . ". Cédula / Pasaporte: " . $model->cedula . ". Nombre: " .  $model->nombres
                            . " " . $model->apellidos;
                        $this->saveLog('contratoInternet', $username, $description,  $external_id, 'tabintformulario');

                    }

                    //Enviar Email
                    $this->enviarEmail($model->cedula, $model->nombres, $model->apellidos, $model->email, $url, $model->doc_contrato);

                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionContrato($id)
    {
        $model = $this->findModel($id);
        $url = Url::to('@web/uploads/tabintformulario/contrato/', 'https');

        //if (strcmp($model->encuesta_beneficiario ,'TABLET e Internet Educativo Ilimitado') == 1) {
        if ($model->encuesta_beneficiario == 'TABLET e Internet Educativo Ilimitado') {

            //////Buscar Tablets Asignada
            $inv_items_assigned = \app\models\InvItemsAssigned::find()
                ->where(["inv_purchase_id" => 36])
                ->andWhere(["username" => $model->username])
                ->one();
            $inv_purchase_item_id = $inv_items_assigned->inv_purchase_item_id;
            $inv_item_user = \app\models\InvItemUser::find()
                ->where(["inv_purchase_item_id" => $inv_purchase_item_id])
                ->andWhere(["username" => $model->username])
                ->one();
            $inv_item_user_id = $inv_item_user->id;

            //Crear Contrato en PDF
            $this->generarContratoTablet($id, $url, $inv_item_user_id);

        } elseif ($model->encuesta_beneficiario == 'Internet Educativo Ilimitado') {
            //Crear Contrato en PDF
            $this->generarContratoInternet($id, $url);
        }

        //Enviar Email
        $this->enviarEmail($model->cedula, $model->nombres, $model->apellidos, $model->email, $url, $model->doc_contrato);

        return $this->redirect($url . $model->doc_contrato);
    }

    public function actionReporte($dni,$provincia,$beneficio,$status,$fecha_inicio,$fecha_fin)
    {
        if ($dni == '') $dni = '%';
        if ($provincia == '') $provincia = '%';
        if ($beneficio == '') $beneficio = '%';
        if ($status == '') $status = '%';
        if ($fecha_inicio == '') $fecha_inicio = '%';
        if ($fecha_fin == '') $fecha_fin = '%';

        if (($fecha_inicio != '%') and ($fecha_fin != '%')) {
            $tabintformulario = \app\models\TabIntFormulario::find()
                ->where("cedula LIKE '" . $dni . "'")
                ->andWhere("provincia LIKE '" . $provincia . "'")
                ->andWhere("encuesta_beneficiario LIKE '" . $beneficio . "'")
                ->andWhere("status LIKE '" . $status . "'")
                ->andWhere("fec_registro >= '" . $fecha_inicio . "'")
                ->andWhere("fec_registro <= '" . $fecha_fin . "'")
                ->orderBy('provincia ASC, canton ASC, parroquia ASC, apellidos ASC')
                ->all();
        } elseif ($fecha_inicio != '%') {
            $tabintformulario = \app\models\TabIntFormulario::find()
                ->where("cedula LIKE '" . $dni . "'")
                ->andWhere("provincia LIKE '" . $provincia . "'")
                ->andWhere("encuesta_beneficiario LIKE '" . $beneficio . "'")
                ->andWhere("status LIKE '" . $status . "'")
                ->andWhere("fec_registro >= '" . $fecha_inicio . "'")
                ->orderBy('provincia ASC, canton ASC, parroquia ASC, apellidos ASC')
                ->all();
        } elseif ($fecha_fin != '%') {
            $tabintformulario = \app\models\TabIntFormulario::find()
                ->where("cedula LIKE '" . $dni . "'")
                ->andWhere("provincia LIKE '" . $provincia . "'")
                ->andWhere("encuesta_beneficiario LIKE '" . $beneficio . "'")
                ->andWhere("status LIKE '" . $status . "'")
                ->andWhere("fec_registro <= '" . $fecha_fin . "'")
                ->orderBy('provincia ASC, canton ASC, parroquia ASC, apellidos ASC')
                ->all();
        } else {
            $tabintformulario = \app\models\TabIntFormulario::find()
                ->where("cedula LIKE '" . $dni . "'")
                ->andWhere("provincia LIKE '" . $provincia . "'")
                ->andWhere("encuesta_beneficiario LIKE '" . $beneficio . "'")
                ->andWhere("status LIKE '" . $status . "'")
                ->orderBy('provincia ASC, canton ASC, parroquia ASC, apellidos ASC')
                ->all();
        }

        $pdf = new Pdf([
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            'destination' => Pdf::DEST_BROWSER,
        ]);
        $pdf->marginTop = 40;
        $pdf->content = $this->renderPartial('_reporte', [
            'dni' => $dni,
            'provincia' => $provincia,
            'beneficio' => $beneficio,
            'status' => $status,
            'fecha_inicio' => $fecha_inicio,
            'fecha_fin' => $fecha_fin,
            'tabintformulario' => $tabintformulario
        ]);
        $pdf->tempPath = Yii::getAlias('@web/runtime/mpdf/');
        $pdf->options = [
            'title' => 'Reporte de Contratos',
            'subject' => 'Contratos de Recursos Académicos',
        ];

        return $pdf->render();
    }

    public function actionReportegrafico()
    {
        return $this->render('_reportegrafico');
    }

    /**
     * Updates an existing TabIntFormulario model.
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
     * Deletes an existing TabIntFormulario model.
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
     * Finds the TabIntFormulario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TabIntFormulario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TabIntFormulario::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function generarQRcode($url,$qrcode)
    {
        $qrCode = (new QrCode($url . $qrcode))
            ->setSize(250)
            ->setMargin(5)
            ->useForegroundColor(0, 0, 0);
        $qrCode->writeFile('uploads/tabintformulario/qrcode/' . $qrcode );
    }

    public function asignarTablet($username, $email, $cedula, $nombres, $apellidos)
    {
        $modelInvItemUser = new \app\models\InvItemUser();
        $modelInvItemUser->username = $username;
        //////Buscar Tablets no asignadas
        $inv_items_unassigned = \app\models\InvItemsUnassigned::find()
            ->where(["inv_purchase_id" => 36])
            ->orderBy(["id" => SORT_ASC])
            ->one();
        //////Asignar Resultado
        $modelInvItemUser->inv_purchase_item_id = $inv_items_unassigned->id;
        $modelInvItemUser->description = "Tablet asignada automáticamente por el módulo de Gestión de Recursos Académicos. Usuario: "
            . $email . ". Cédula / Pasaporte: " . $cedula . ". Nombre: " .  $nombres
            . " " . $apellidos;;
        $modelInvItemUser->date_asigned = date('Y-m-d');
        $modelInvItemUser->status = 1;

        if ($modelInvItemUser->save()) {
            //Registro (Log) Evento
            $external_id = $modelInvItemUser->getPrimaryKey();
            $description = $modelInvItemUser->description;
            $this->saveLog('assignedTablet', $username, $description,  $external_id, 'invitemuser');


            return $modelInvItemUser->getPrimaryKey();
        }
    }

    public function generarContratoTablet($id, $url, $inv_item_user_id)
    {
        $tabintformulario = \app\models\TabIntFormulario::find()
            ->where(["id" => $id])
            ->one();

        $invitemuser = \app\models\InvItemUser::find()
            ->where(["id" => $inv_item_user_id])
            ->one();

        $dni = $tabintformulario->cedula;
        $filename = $tabintformulario->doc_contrato;
        $invpurchaseitemid = $invitemuser->inv_purchase_item_id;

        $pdf = Yii::$app->pdf;
        $pdf->marginTop = 40;
        $pdf->filename = "uploads/tabintformulario/contrato/" . $filename;
        $pdf->content = $this->renderPartial('_contrato_tablet', [
            'id' => $id,
            'dni' => $dni,
            'url' => $url,
            'invpurchaseitemid' => $invpurchaseitemid,
        ]);
        $pdf->tempPath = Yii::getAlias('@web/runtime/mpdf/');
        $pdf->options = [
            'title' => 'Contrato de Préstamo de Recursos Académicos',
            'subject' => 'Datos del Contrato',
        ];
        return $pdf->render();
    }

    public function generarContratoInternet($id, $url)
    {
        $tabintformulario = \app\models\TabIntFormulario::find()
            ->where(["id" => $id])
            ->one();

        $dni = $tabintformulario->cedula;
        $filename = $tabintformulario->doc_contrato;

        $pdf = Yii::$app->pdf;
        $pdf->marginTop = 40;
        $pdf->filename = "uploads/tabintformulario/contrato/" . $filename;
        $pdf->content = $this->renderPartial('_contrato_internet', [
            'id' => $id,
            'dni' => $dni,
            'url' => $url,
        ]);
        $pdf->tempPath = Yii::getAlias('@web/runtime/mpdf/');
        $pdf->options = [
            'title' => 'Contrato de Préstamo de Recursos Académicos',
            'subject' => 'Datos del Contrato',
        ];
        return $pdf->render();
    }

    public function enviarEmail($dni,$nombres,$apellidos,$email,$url,$filename)
    {
        $body =
            "Estimado estudiante," . "\n" .
            "Se ha generado un nuevo contrato para la entrega de Recursos Académicos por parte de la " . Yii::$app->params['company'] . "\n\n" .
            "Cédula / Pasaporte: " . $dni . "\n" .
            "Nombres Completos: " . $nombres . " " . $apellidos . "\n" .
            "--------------------------------------------------------------------------------------" . "\n" .
            "Haga clic en el siguiente enlace para descargar o imprimir su contrato:" . "\n\n" .
            Url::to($url. $filename) . "\n\n" .
            "--------------------------------------------------------------------------------------" . "\n" .
            "---> Correo enviado por el Módulo | Gestión Recursos Académicos (SITIC). NO RESPONDA ESTE CORREO <---"
        ;

        Yii::$app->mailerSitic->compose()
            ->setTo($email)
            ->setFrom('sitic@uea.edu.ec', 'SITIC | UEA')
            ->setCc('sitic@uea.edu.ec')
            ->setSubject("UEA - Contrato Recursos Académicos")
            ->setTextBody($body)
            ->attach('uploads/tabintformulario/contrato/' . $filename)
            ->send();
        return true;
    }


    public function saveLog($type, $username, $description, $external_id, $external_type)
    {
        //Registro (Log) Evento
        $modelLogs              = new \app\models\Logs();
        $modelLogs->type        = $type;
        $modelLogs->username    = $username;
        $modelLogs->datetime    = date('Y-m-d H:i:s');
        $modelLogs->description = $description;
        $modelLogs->ipaddress       = \app\models\User::obtenerip();
        $modelLogs->external_id     = $external_id;
        $modelLogs->external_type   = $external_type;
        $modelLogs->save(false);
    }

    public function actionEstatus(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = TabIntFormulario::findOne($id);
            $posted = current($_POST['TabIntFormulario']);
            $post = ['TabIntFormulario' => $posted];
            if ($model->load($post) && $model->save(false)){
                $value=$model->status;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error al actualizar']);
            echo $out;
            return;
        }
    }
}
