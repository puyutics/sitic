<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CcppProveedorContactoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$searchModelCcppProveedorContacto = new \app\models\CcppProveedorContactoSearch();
$searchModelCcppProveedorContacto->ccpp_proveedor_id = $model->id;
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
        'pjax' => false,
        'bordered' => true,
        'responsive' => true,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]); ?>

</div>
