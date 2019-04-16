<?php

use yii\helpers\Html;
use kartik\detail\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Documents */

$this->title = $model->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documents-view">

    <?= DetailView::widget([
        'model' => $model,
        'condensed'=>false,
        'hover'=>false,
        'enableEditMode'=>false,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            'heading'=>'ETIQUETA: ' . $model->description,
            'type'=>DetailView::TYPE_PRIMARY,
        ],
        'attributes' => [
            'id',
            'filename',
            'filetype',
            'description:ntext',
            'date',
            'external_id',
            'external_type',
            'username',
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
    ]) ?>

    <p>
        <?= Html::a(Yii::t('app', 'Editar'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= \yii2assets\pdfjs\PdfJs::widget([
        'url'=> Url::base().'/uploads/documents/' . $model->filename . '.' . $model->filetype
    ]); ?>

</div>
