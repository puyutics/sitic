<?php

use kartik\detail\DetailView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\CcppProveedor */

$this->title = $model->razon_social;
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['ccppproveedor/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ccpp-proveedor-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'razon_social',
            'ruc',
            'ciudad',
            'direccion',
            'sitio_web',
            [
                'attribute' => 'status',
                'value'=>call_user_func(function($model){
                    if ($model->status == '0') {
                        return "INACTIVO";
                    };
                    if ($model->status == '1') {
                        return "ACTIVO";
                    };
                },$model),
            ],
        ],
        'bordered' => true,
        'condensed'=>true,
        'enableEditMode'=>false,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            //'heading'=>$model->code,
            'type'=>DetailView::TYPE_PRIMARY,
        ],
    ]) ?>

    <?php echo TabsX::widget([
        'position' => TabsX::POS_ABOVE,
        'align' => TabsX::ALIGN_LEFT,
        'encodeLabels'=>false,
        'enableStickyTabs' => true,
        /*'stickyTabsOptions' => [
            'selectorAttribute' => "data-target",
            'backToTop' => true,
        ],*/
        'items' => [
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> CONTACTOS',
                'content' => $this->render('_contacto', [
                    'model' => $model,
                ])

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> CATEGORIAS',
                'content' => $this->render('_categoria', [
                    'model' => $model,
                ])
            ],
        ],
    ]);
    ?>

</div>
