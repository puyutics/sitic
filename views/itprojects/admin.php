<?php

use yii\widgets\Pjax;
use kartik\detail\DetailView;
use yii\helpers\Html;

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\ItProjects */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Gestión TI'), 'url' => ['site/management']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Proyectos TI'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-projects-view">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?php //Pjax::begin(); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'code',
            'project',
            'description:ntext',
            'amount',
            'date_creation',
            'date_closed',
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
            ['itprojectsuser/create', 'it_projects_id' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a('+ Etapa',
            ['itprojectsstages/create', 'it_projects_id' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a('+ Proyecto',
            ['itprojectsparents/create', 'it_projects_id' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a('+ Servicio',
            ['itprojectsservices/create', 'it_projects_id' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a('+ Compra',
            ['itprojectspurchase/create', 'it_projects_id' => $model->id],
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
        <?= Html::a(Yii::t('app', 'Editar Proyecto TI'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> ETAPAS',
                'content' => $this->render('_stages', [
                    'model' => $model,
                ])

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> PROYECTOS',
                'content' => $this->render('_parents', [
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
                'content' => $this->render('_purchase', [
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
