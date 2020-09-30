<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcppProveedorContactoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$modelCcppProveedorCategoria = new \app\models\CcppProveedorCategoria();
$modelCcppProveedorCategoria->ccpp_categoria_id = $model->id;

$searchModelCcppProveedorContacto = new \app\models\CcppProveedorContactoSearch();
$searchModelCcppProveedorContacto->ccpp_proveedor_id = $modelCcppProveedorCategoria->ccpp_proveedor_id;
$dataProviderCcppProveedorContacto = $searchModelCcppProveedorContacto->search(Yii::$app->request->queryParams);

?>
<div class="ccpp-proveedor-contacto-index">

    <?= GridView::widget([
        'dataProvider' => $dataProviderCcppProveedorContacto,
        //'filterModel' => $searchModelCcppProveedorContacto,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'ccpp_proveedor_id',
            [
                'attribute' => 'ccpp_proveedor_id',
                'value' => 'ccppProveedor.razon_social'
            ],
            'nombre',
            'cargo',
            'celular',
            'telefono',
            'extension',
            'email:email',
            //'status',

            //['class' => 'yii\grid\ActionColumn'],
        ],
        'containerOptions' => ['style'=>'overflow: auto'],
        'toolbar' =>  [
            [
                'content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>',
                        ['ccppproveedorcontacto/create', 'ccpp_proveedor_id' => base64_encode($model->id)], [
                            'class' => 'btn btn-success',
                            'title' => ('Agregar Contacto')
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
