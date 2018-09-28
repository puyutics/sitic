<?php

namespace app\controllers;

use Yii;
use app\models\Logs;
use app\models\InvItemUser;
use app\models\InvItemUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\filters\AccessControl;
use yii\helpers\Json;

/**
 * InvitemuserController implements the CRUD actions for InvItemUser model.
 */
class InvitemuserController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['assigned','create','index','update', 'view',
                    'eusername','einvpurchaseitemid','edateasigned',
                    'edatereleased','edescription','estatus'],
                'rules' => [
                    [
                        'actions' => ['assigned','create','index','update','view',
                            'eusername','einvpurchaseitemid','edateasigned',
                            'edatereleased','edescription','estatus'],
                        'allow' => true,
                        'roles' => ['rolAdministrador'],
                    ],
                    [
                        'actions' => [],
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
     * Lists all InvItemUser models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InvItemUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Funcion Personalizada // Vista Bienes Asignados
     */
    public function actionAssigned()
    {
        $searchModel = new \app\models\InvItemsAssignedSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('assigned', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single InvItemUser model.
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
     * Creates a new InvItemUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new InvItemUser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);

            //Registro (Log) Evento itemAssigned
            $username = Yii::$app->user->identity->username;
            $external_id = $model->getPrimaryKey();
            $description =
                'Bien asignado al usuario: ' . $model->username
                . '. Detalle: ' . $model->description
            ;            ;
            $this->saveLog('itemAssigned', $username, $description,  $external_id, 'invitemuser');

            return $this->redirect(['invpurchaseitem/view', 'id' => $model->inv_purchase_item_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing InvItemUser model.
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
            //return $this->redirect(['invpurchase/admin', 'id' => $model->invPurchaseItem->inv_purchase_id]);
            return $this->redirect(['invpurchaseitem/view', 'id' => $model->inv_purchase_item_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InvItemUser model.
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
     * Finds the InvItemUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InvItemUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InvItemUser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    /*
    ** Funciones personalizadas
    */
    public function actionEusername(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvItemUser::findOne($id);
            $posted = current($_POST['InvItemUser']);
            $post = ['InvItemUser' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->username;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEinvpurchaseitemid(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvItemUser::findOne($id);
            $posted = current($_POST['InvItemUser']);
            $post = ['InvItemUser' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->invPurchaseItem->description;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEdescription(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvItemUser::findOne($id);
            $posted = current($_POST['InvItemUser']);
            $post = ['InvItemUser' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->description;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEdateasigned(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvItemUser::findOne($id);
            $posted = current($_POST['InvItemUser']);
            $post = ['InvItemUser' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->date_asigned;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEdatereleased(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvItemUser::findOne($id);
            $posted = current($_POST['InvItemUser']);
            $post = ['InvItemUser' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->date_released;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }

    public function actionEstatus(){
        if(Yii::$app->request->post('hasEditable')){
            $id=Yii::$app->request->post('editableKey');
            $model = InvItemUser::findOne($id);
            $posted = current($_POST['InvItemUser']);
            $post = ['InvItemUser' => $posted];
            if ($model->load($post) && $model->save()){
                $value=$model->status;
                $out=Json::encode(['output'=>$value,'message'=>'']);}
            else $out=Json::encode(['output'=>'','message'=>'Error en el Ingreso']);
            echo $out;
            return;
        }
    }


    public function saveLog($type, $username, $description, $external_id, $external_type)
    {
        //Registro (Log) Evento sendToken
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
