<?php

namespace app\controllers;

use Yii;
use app\models\PhonesExtensions;
use app\models\PhonesExtensionsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * PhonesextensionsController implements the CRUD actions for PhonesExtensions model.
 */
class PhonesextensionsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create','index','update', 'view','public',
                    'embedded'],
                'rules' => [
                    [
                        'actions' => ['create','index','update',
                            'embedded'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => false,
                    ],
                    [
                        'actions' => ['public'],
                        'allow' => true,
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
     * Lists all PhonesExtensions models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhonesExtensionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = [
            'extension' => SORT_ASC,
        ];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all PhonesExtensions models.
     * @return mixed
     */
    public function actionPublic()
    {
        $searchModel = new PhonesExtensionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort->defaultOrder = [
            'extension' => SORT_ASC,
        ];

        return $this->render('public', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PhonesExtensions model.
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
     * Creates a new PhonesExtensions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PhonesExtensions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PhonesExtensions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing PhonesExtensions model.
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
     * Finds the PhonesExtensions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PhonesExtensions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PhonesExtensions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    /**
     * Displays GLPI UEA page.
     *
     * @return string
     */
    public function actionEmbedded()
    {
        return $this->render('embedded');
    }


    /*
    ** Funciones personalizadas
    */
    public function actionEextension(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = PhonesExtensions::findOne($id);
            $posted = current($_POST['PhonesExtensions']);
            $post = ['PhonesExtensions' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->extension;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEdescription(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = PhonesExtensions::findOne($id);
            $posted = current($_POST['PhonesExtensions']);
            $post = ['PhonesExtensions' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->description;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEipv4address(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = PhonesExtensions::findOne($id);
            $posted = current($_POST['PhonesExtensions']);
            $post = ['PhonesExtensions' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->ipv4_address;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEusername(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = PhonesExtensions::findOne($id);
            $posted = current($_POST['PhonesExtensions']);
            $post = ['PhonesExtensions' => $posted];
            if ($model->load($post) && $model->save()){
                $user = Yii::$app->ad->getProvider('default')->search()->
                        findBy('sAMAccountname', $model->username);
                $value=$user->getAttribute('cn',0);
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEdepartmentid(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = PhonesExtensions::findOne($id);
            $posted = current($_POST['PhonesExtensions']);
            $post = ['PhonesExtensions' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->department->department;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEinvpurchaseitemid(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = PhonesExtensions::findOne($id);
            $posted = current($_POST['PhonesExtensions']);
            $post = ['PhonesExtensions' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->invPurchaseItem->description;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }
}
