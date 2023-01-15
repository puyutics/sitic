<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\PuertaStaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs del Servidor (Usuario)';
$this->params['breadcrumbs'][] = $this->title;

//Buscar usuario en Onlycontrol
$oc_user_id = base64_decode($_GET['oc_user_id']);
$oc_user = \app\models\onlycontrol\Nomina::find()
    ->where(['NOMINA_ID' => $oc_user_id])
    ->one();

if (isset($oc_user)) {
    $oc_user_admin_bio = $oc_user->NOMINA_ADMIN_BIO;
}

?>
<div class="puerta-sta-index">

    <div class="alert alert-warning" align="center">
        <h3 align="center"><?= $this->title ?></h3>
        <h3 align="center"><?= $oc_user->NOMINA_APE .' '. $oc_user->NOMINA_NOM ?></h3>
        <h4 align="center" style="color:palevioletred">Tipo: <?php if ($oc_user_admin_bio == 1) echo 'Administrador'; else echo 'Usuario'; ?></h4>
        <h4 align="center" style="color:palevioletred">Cédula: <?= $oc_user->NOMINA_COD ?></h4>
        <h4 align="center" style="color:palevioletred">Código: <?= $oc_user->NOMINA_ID ?></h4>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'label' => 'Registro',
                'attribute' => 'P_Status',
            ],
            [
                'label' => 'Fecha / Hora',
                'attribute' => 'P_Fecha',
            ],
            [
                'label' => 'Origen',
                'attribute' => 'P_Maq',
            ],
            [
                'label' =>'Usuario',
                'attribute' =>'P_User',
                'value' => function ($model) {
                    $oc_user = \app\models\onlycontrol\Nomina::find()
                        ->where(['NOMINA_ID' => $model->P_User])
                        ->one();
                    if (isset($oc_user)) {
                        return $oc_user->NOMINA_ID .': '. $oc_user->NOMINA_APE .' '. $oc_user->NOMINA_NOM;
                    } else {
                        return $model->P_User;
                    }
                },
                'format' => 'html',
            ],
            [
                'label' => 'IP Address',
                'attribute' => 'P_ID',
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
