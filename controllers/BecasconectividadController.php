<?php

namespace app\controllers;

use Yii;
use app\models\BecasConectividad;
use app\models\BecasConectividadSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BecasconectividadController implements the CRUD actions for BecasConectividad model.
 */
class BecasconectividadController extends Controller
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
                    'beneficiario','beneficiarioadmin'],
                'rules' => [
                    [
                        'actions' => ['index','beneficiarioadmin'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['create','beneficiario','view'],
                        'allow' => true,
                        'roles' => ['@'],
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
     * Lists all BecasConectividad models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BecasConectividadSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BecasConectividad model.
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
     * Creates a new BecasConectividad model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BecasConectividad();
        if ($model->load(Yii::$app->request->post())) {

            $becas = \app\models\BecasConectividad::find()
                ->where(['dni'=>$model->dni])
                ->all();

            if (count($becas) > 0 ) {
                return $this->redirect(['view', 'id' => $becas[0]->id]);
            } else {
                $model->upload_libreta = UploadedFile::getInstance($model, 'upload_libreta');

                $model->doc_libreta = md5($model->dni) . '.' . $model->upload_libreta->extension;
                $model->fec_registro = date('Y-m-d H:i:s');
                $model->status = 1;

                if ($model->uploadDocumentos($model)){
                    if ($model->save()) {

                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BecasConectividad model.
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
     * Deletes an existing BecasConectividad model.
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
     * Finds the BecasConectividad model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BecasConectividad the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BecasConectividad::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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
                    'index.php?r=becasconectividad/beneficiarioadmin&search='
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
}
