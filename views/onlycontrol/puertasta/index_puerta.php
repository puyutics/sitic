<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\onlycontrol\PuertaStaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs del Servidor';
$this->params['breadcrumbs'][] = $this->title;

if (isset($_GET['oc_zona'])) {
    $oc_zona = base64_decode($_GET['oc_zona']);
    $puerta = \app\models\onlycontrol\Puerta::find()
        ->where(['PRT_COD' => $oc_zona])
        ->one();
} else {
    $oc_zona = NULL;
}

?>
<div class="puerta-sta-index">

    <div class="alert alert-warning" align="center">
        <h3 align="center"><?= $this->title ?></h3>
    </div>

    <h4 align="center">
        <code>Filtro:</code> <?php if ($oc_zona == NULL) echo 'Todos los equipos'; else echo '('.$puerta->PRT_COD.') '.$puerta->PRI_DES; ?>
    </h4>

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
