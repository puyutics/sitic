<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcppProveedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$modelCcppProveedorCategoria = new \app\models\CcppProveedorCategoria();
$modelCcppProveedorCategoria->ccpp_categoria_id = $model->id;

$searchModelCcppProveedor = new \app\models\CcppProveedorSearch();
$searchModelCcppProveedor->id = $modelCcppProveedorCategoria->ccpp_proveedor_id;
$dataProviderCcppProveedor = $searchModelCcppProveedor->search(Yii::$app->request->queryParams);
$dataProviderCcppProveedor->sort->defaultOrder = [
    'razon_social' => SORT_ASC,
];
?>
<div class="ccpp-proveedor-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProviderCcppProveedor,
        'filterModel' => $searchModelCcppProveedor,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'razon_social',
            'ruc',
            'ciudad',
            'direccion',
            'sitio_web',
            //'status',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'kartik\grid\ActionColumn',
                'template'=>'{admin}',
                'buttons'=>[
                    'admin' => function ($url, $model) {
                        return Html::a('<span class="btn btn-success center-block">Abrir</span>',
                            Url::to('index.php?r=ccppproveedor/admin&id=' . base64_encode($model->id)), [
                                'title' => Yii::t('yii', 'Abrir Compra'),
                            ]);
                    },
                ]
            ],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', 'index.php?r=ccppproveedor/create', [
                        'class' => 'btn btn-success',
                        'title' => ('Agregar Proveedor')
                    ]),
            ],
            '{export}',
            '{toggleData}'
        ],
        'pjax' => false,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]); ?>

</div>
