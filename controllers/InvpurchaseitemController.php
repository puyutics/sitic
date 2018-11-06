<?php

namespace app\controllers;

use app\models\InvItemsUnassigned;
use app\models\InvItemUser;
use Yii;
use app\models\Logs;
use app\models\InvPurchaseItem;
use app\models\InvPurchaseItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use yii\helpers\Json;

use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;


/**
 * InvpurchaseitemController implements the CRUD actions for InvPurchaseItem model.
 */
class InvpurchaseitemController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['admin','create','index','unassigned','update', 'view',
                    'edescription','einvpurchaseid','einvmodelsid',
                    'eserialnumber','econtrolcode','eamount'],
                'rules' => [
                    [
                        'actions' => ['admin','create','index','unassigned','view',
                            'edescription','einvpurchaseid','einvmodelsid',
                            'eserialnumber','econtrolcode','eamount'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => ['update'],
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
     * Lists all InvPurchaseItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvPurchaseItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Funcion Personalizada // Vista Bienes sin Asignar
     */
    public function actionUnassigned()
    {
        $searchModel = new \app\models\InvItemsUnassignedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('unassigned', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InvPurchaseItem model.
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
     * Creates a new InvPurchaseItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InvPurchaseItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);

            //Registro (Log) Evento itemCreated
            $username = Yii::$app->user->identity->username;
            $external_id = $model->getPrimaryKey();
            $description =
                'Nuevo item creado por el usuario: ' . $username
                . '. Detalle: ' . $model->description
                . '. Serie: ' . $model->serial_number
            ;
            $this->saveLog('itemCreated', $username, $description,  $external_id, 'invpurchaseitem');

            return $this->redirect(['invpurchase/admin', 'id' => $model->inv_purchase_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InvPurchaseItem model.
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

            //Registro (Log) Evento itemUpdate
            $username = Yii::$app->user->identity->username;
            $external_id = $model->getPrimaryKey();
            $description =
                'Item modificado: ' . $model->description
            ;
            $this->saveLog('itemUpdated', $username, $description,  $external_id, 'invpurchaseitem');

            return $this->redirect(['invpurchase/admin', 'id' => $model->inv_purchase_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InvPurchaseItem model.
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
     * Finds the InvPurchaseItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InvPurchaseItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InvPurchaseItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /** Funciones propias **/
    public function actionEdescription(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvPurchaseItem::findOne($id);
            $posted = current($_POST['InvPurchaseItem']);
            $post = ['InvPurchaseItem' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->description;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEinvmodelsid(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvPurchaseItem::findOne($id);
            $posted = current($_POST['InvPurchaseItem']);
            $post = ['InvPurchaseItem' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->invModels->model;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEinvpurchaseid(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvPurchaseItem::findOne($id);
            $posted = current($_POST['InvPurchaseItem']);
            $post = ['InvPurchaseItem' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->invPurchase->code;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEserialnumber(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvPurchaseItem::findOne($id);
            $posted = current($_POST['InvPurchaseItem']);
            $post = ['InvPurchaseItem' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->serial_number;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEcontrolcode(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvPurchaseItem::findOne($id);
            $posted = current($_POST['InvPurchaseItem']);
            $post = ['InvPurchaseItem' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->control_code;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEamount(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvPurchaseItem::findOne($id);
            $posted = current($_POST['InvPurchaseItem']);
            $post = ['InvPurchaseItem' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->amount;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }


    public function saveLog($type, $username, $description, $external_id, $external_type)
    {
        //Registro (Log) Evento
        $modelLogs              = new Logs();
        $modelLogs->type        = $type;
        $modelLogs->username    = $username;
        $modelLogs->datetime    = date('Y-m-d H:i:s');
        $modelLogs->description = $description;
        $modelLogs->ipaddress       = Yii::$app->request->userIP;
        $modelLogs->external_id     = $external_id;
        $modelLogs->external_type   = $external_type;
        $modelLogs->save(false);
    }

}
