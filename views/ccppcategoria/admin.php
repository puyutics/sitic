<?php

use kartik\detail\DetailView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\CcppCategoria */

$this->title = $model->categoria;
$this->params['breadcrumbs'][] = ['label' => 'Proveedores', 'url' => ['ccppproveedor/index']];
$this->params['breadcrumbs'][] = ['label' => 'Categorías', 'url' => ['ccppproveedor/categorias']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ccpp-categoria-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'categoria',
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
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> PROVEEDORES',
                'content' => $this->render('_proveedores', [
                    'model' => $model,
                ])

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> CONTACTOS',
                'content' => $this->render('_contacto', [
                    'model' => $model,
                ])

            ],
        ],
    ]);
    ?>

</div>
