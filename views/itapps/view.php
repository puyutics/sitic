<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\bootstrap\Modal;

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\ItApps */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inventario TI'), 'url' => ['site/inventory']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aplicaciones TI'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-apps-view">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'condensed'=>false,
        'hover'=>false,
        'enableEditMode'=>false,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            'heading'=>'ETIQUETA: ' . $model->title,
            'type'=>DetailView::TYPE_PRIMARY,
        ],
        'attributes' => [
            //'id',
            //'title',
            'description:ntext',
            'username',
            [
                'attribute' => 'password',
                'value' => '**********',
            ],
            //'password',
            'email:email',
            [
                'attribute' => 'url',
                'value' => Html::a(
                    $model->url,
                    $model->url,
                    ['target'=>'_blank', 'class' => 'target-blank']
                ),
                'format' => 'raw',
            ],
            [
                'attribute' => 'it_apps_category_id',
                'value' => $model->itAppsCategory->category,
            ],
            [
                'attribute'=>'status',
                'format'=>'raw',
                'value'=>$model->status ? '<span class="label label-success">ACTIVO</span>' : '<span class="label label-danger">INACTIVO</span>',
                'type'=>DetailView::INPUT_SWITCH,
                'widgetOptions' => [
                    'pluginOptions' => [
                        'onText' => 'Yes',
                        'offText' => 'No',
                    ]
                ],
            ],
        ],
    ])
    ?>


    <p align="left">
        <?= Html::a(Yii::t('app', 'Editar'),
            ['update', 'id' => $model->id],
            ['class' => 'btn btn-success']) ?>
        <?php
        Modal::begin([
            'header' => '<h4 class="modal-title" align="center"> <code>INFORMACIÓN CONFIDENCIAL</code> </h4>',
            'toggleButton' => [
                'label' => '<i class="glyphicon glyphicon-eye-open"></i> Mostrar Contraseña',
                'class' => 'btn btn-primary'],
            'options' => ['tabindex' => false]
        ]);
        echo DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'password',
                    'value' => $model->getPassword($model->password),
                    'format' => 'raw',
                ],
            ],
        ]);
        Modal::end();
        ?>
    </p>


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
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> DOCUMENTOS',
                'content' => $this->render('_documents', [
                    'model' => $model,
                ])
            ],
        ],
    ]);
    ?>

</div>
