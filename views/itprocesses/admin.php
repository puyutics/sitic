<?php

use yii\widgets\Pjax;
use kartik\detail\DetailView;
use yii\helpers\Html;

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\ItProcesses */

$this->title = $model->process;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Procesos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-processes-view">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?php //Pjax::begin(); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'process',
            'description:ntext',
            'metrics:ntext',
            'date_creation',
            'date_closed',
            [
                'attribute' => 'magnitude',
                'value'=>call_user_func(function($model){
                    if ($model->status == '0') {
                        return "BAJO";
                    };
                    if ($model->status == '1') {
                        return "MEDIO";
                    };
                    if ($model->status == '2') {
                        return "ALTO";
                    };
                },$model),
            ],
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

    <p>
        <?= Html::a('+ Usuario',
            ['itprocessesuser/create', 'it_processes_id' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a('+ Proyecto',
            ['itprocessesprojects/create', 'it_processes_id' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a('+ Servicio',
            ['itprocessesservices/create', 'it_processes_id' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a('+ Compra',
            ['itprocessespurchase/create', 'it_processes_id' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a('+ Documento',
            ['documents/create', [
                'external_id' => $model->id,
                'external_type' => 'itProcesses']],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a(Yii::t('app', 'Editar Proceso'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php /*= Html::a(Yii::t('app', 'Borrar'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) */?>
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
                'label'=>'<i class="glyphicon glyphicon-user"></i> USUARIOS',
                'content' => $this->render('_users', [
                    'model' => $model,
                ])
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> PROYECTOS',
                'content' => $this->render('_projects', [
                    'model' => $model,
                ])
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> SERVICIOS',
                'content' => $this->render('_services', [
                    'model' => $model,
                ])
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> COMPRAS',
                'content' => $this->render('_purchases', [
                    'model' => $model,
                ])
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> DOCUMENTOS',
                'content' => $this->render('_documents', [
                    'model' => $model,
                ])
            ],
        ],
    ]);
    ?>

    <?php //Pjax::end(); ?>

</div>
