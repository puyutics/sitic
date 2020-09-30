<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcppProveedorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista Proveedores';
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['ccppproveedor/index']];
$this->params['breadcrumbs'][] = ['label' => $this->title];

$dataProvider->sort->defaultOrder = [
    'razon_social' => SORT_ASC,
];
?>
<div class="ccpp-proveedor-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                            Url::to(['/ccppproveedor/admin', 'id' => base64_encode($model->id)]), [
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
        'pjax' => true,
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
