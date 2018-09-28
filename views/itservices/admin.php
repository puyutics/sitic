<?php

use yii\widgets\Pjax;
use kartik\detail\DetailView;
use yii\helpers\Html;

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\ItServices */

$this->title = $model->service;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Servicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-services-view">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'service',
            'description:ntext',
            'type',
            'date_creation',
            'date_renovation',
            'date_closed',
            'stakeholders',
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
        <?= Html::a(Yii::t('app', 'Editar Servicio'),
            ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])
        ?>
        <?= Html::a('+ Usuario',
            ['itservicesuser/create', 'it_services_id' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a('+ Resultado',
            ['itservicesresult/create', 'it_services_id' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a('+ Disponibilidad',
            ['itservicesavailability/create', 'it_services_id' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a('+ Proyecto',
            ['itprojectsservices/create', 'it_services_id' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a('+ Proceso',
            ['itprocessesservices/create', 'it_services_id' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a('+ Incidente',
            ['itservicesaffectations/create', 'it_services_id' => $model->id],
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
                'external_type' => 'itProjects']],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?php /*= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ])*/ ?>
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
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> RESULTADOS',
                'content' => $this->render('_result', [
                    'model' => $model,
                ])
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> DISPONIBILIDAD',
                'content' => ''


            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> PROYECTOS',
                'content' => $this->render('_projects', [
                    'model' => $model,
                ])
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> PROCESOS',
                'content' => $this->render('_processes', [
                    'model' => $model,
                ])
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> INCIDENTES',
                'content' => ''

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

</div>
