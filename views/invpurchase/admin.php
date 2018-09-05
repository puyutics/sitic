<?php

use yii\widgets\Pjax;
use kartik\detail\DetailView;
use yii\helpers\Html;

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\InvPurchase */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Compras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inv-purchase-view">

    <h1><?php //Html::encode($this->title) ?></h1>

    <?php //Pjax::begin(); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'code',
            'description:ntext',
            'date',
            'username',
            /*[
                'attribute' => 'username',
                'value'=>call_user_func(function($model){
                    $user = Yii::$app->ad->getProvider('default')->search()->findBy('sAMAccountname', $model->username);
                    return $user->getAttribute('cn',0);
                },$model),
            ],*/
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
        <?= Html::a('Agregar bien',
            ['invpurchaseitem/create', 'id_invpurchase' => $model->id],
            [
                'class' => 'btn btn-success grid-button',
                'data' => [
                    'method' => 'post',
                ],
            ]
        ); ?>
        <?= Html::a(Yii::t('app', 'Editar Compra'),
            ['update', 'id' => $model->id],
            ['class' => 'btn btn-primary'])
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
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> BIENES',
                'content' => $this->render('_items', [
                    'model' => $model,
                ])

            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> BIENES ASIGNADOS',
                'content' => $this->render('_items_assigned', [
                    'model' => $model,
                ])
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> BIENES SIN ASIGNAR',
                'content' => $this->render('_items_unassigned', [
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