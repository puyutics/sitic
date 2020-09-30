<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcppProveedorCategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$searchModelCcppProveedorCategoria = new \app\models\CcppProveedorCategoriaSearch();
$searchModelCcppProveedorCategoria->ccpp_proveedor_id = $model->id;
$dataProviderCcppProveedorCategoria = $searchModelCcppProveedorCategoria->search(Yii::$app->request->queryParams);
?>
<div class="ccpp-proveedor-categoria-index">

    <?= GridView::widget([
        'dataProvider' => $dataProviderCcppProveedorCategoria,
        //'filterModel' => $searchModelCcppProveedorCategoria,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'ccpp_proveedor_id',
            [
                'attribute' => 'ccpp_categoria_id',
                'value' => 'ccppCategoria.categoria'
            ]
            //'status',

            //['class' => 'yii\grid\ActionColumn'],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>',
                        ['ccppproveedorcategoria/create', 'ccpp_proveedor_id' => base64_encode($model->id)], [
                            'class' => 'btn btn-success',
                            'title' => ('Agregar Categoria')
                        ]),
            ],
            '{export}',
            '{toggleData}'
        ],
        'pjax' => true,
        'bordered' => true,
        'responsive' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]); ?>

</div>
