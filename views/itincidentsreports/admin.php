<?php

use yii\widgets\Pjax;
use kartik\detail\DetailView;
use yii\helpers\Html;

use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model app\models\ItIncidentsReports */

$this->title = $model->subject;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reportes de Incidentes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="it-incidents-reports-view">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'subject',
            'issue:ntext',
            'date_reported',
            'date_solved',
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
        <?= Html::a(Yii::t('app', 'Editar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?/*= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
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
                'content' => ''
            ],
            [
                'label'=>'<i class="glyphicon glyphicon-list-alt"></i> SERVICIOS AFECTADOS',
                'content' => ''
            ],
        ],
    ]);
    ?>

</div>
